<?php

namespace App\Http\Controllers;

use App\Events\ViewedVacancy;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VacanciesController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $vacancies = Vacancy::where('user_id', $user->id)
            ->withCount(['candidateFiles', 'candidateFields'])
            ->get();

        $now_datetime = now();
        return view('dashboard', ['vacancies' => $vacancies, 'now_datetime' => $now_datetime]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cacheKey = 'index_cache_' . md5(json_encode($request->all()));

        // Check if the cache exists
        if (Cache::has($cacheKey)) {
            // If it exists, return the cached content
            return Cache::get($cacheKey);
        }

        $query = Vacancy::select([
            'id',
            'title',
            'employment_type',
            'job_type',
            'workload',
            'salary',
            'company_name',
            'show_company',
            'show_salary',
            'choiced_plan',
            'created_at',
            'days_available',
        ])
        ->whereIn('choiced_plan', ['Destaque', 'Normal'])
        ->where('paid_status', 'paid out')
        ->where('approved_by_admin', 1)
        ->where('days_available', '>', now())
        ->when($request->has('search') && $request->search !== null, function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%');
        })
        ->when($request->has('contract_type'), function ($query) use ($request) {
            $query->where('employment_type', $request->contract_type);
        })
        ->when($request->has('journey_hour'), function ($query) use ($request) {
            $query->where('work_schedule', $request->journey_hour);
        })
        ->when($request->has('work_type'), function ($query) use ($request) {
            $query->where('job_type', $request->work_type);
        })
        ->where(function ($query) {
            $query->whereNull('max_candidates')
                ->orWhere(function ($query) {
                    $query->whereRaw('(SELECT COUNT(*) FROM candidate_files WHERE vacancy_id = vacancies.id) + 
                                      (SELECT COUNT(*) FROM candidate_fields WHERE vacancy_id = vacancies.id) < max_candidates');
                });
        })
        ->orderBy('created_at', 'desc')
        ->get();
    

        $count_vacancies = $query->count();

        $grouped_vacancies = $query->groupBy([
            'choiced_plan',
            function ($vacancy) {
                return $vacancy->created_at->toDateString();
            },
        ]);

        $highlighted_vacancies = $grouped_vacancies['Destaque'] ?? collect();
        $normal_vacancies = $grouped_vacancies['Normal'] ?? collect();

        $highlighted_vacancies->map(function ($vacancies) {
            return $vacancies->map(function ($vacancy) {
                $date = Carbon::parse($vacancy->created_at)->locale('pt_BR');
                $vacancy->formatted_created_at = [
                    'month' => substr($date->translatedFormat('F'), 0, 3),
                    'day' => $date->day,
                    'year' => $date->year,
                ];
                return $vacancy;
            });
        });

        $normal_vacancies->map(function ($vacancies) {
            return $vacancies->map(function ($vacancy) {
                $date = Carbon::parse($vacancy->created_at)->locale('pt_BR');
                $vacancy->formatted_created_at = [
                    'month' => substr($date->translatedFormat('F'), 0, 3),
                    'day' => $date->day,
                    'year' => $date->year,
                ];
                return $vacancy;
            });
        });

        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;
        } else {
            $search = false;
        }

        if ($request->has('contract_type')) {
            $contract_type = $request->contract_type;
        } else {
            $contract_type = false;
        }

        if ($request->has('journey_hour')) {
            $journey_hour = $request->journey_hour;
        } else {
            $journey_hour = false;
        }

        if ($request->has('work_type')) {
            $work_type = $request->work_type;
        } else {
            $work_type = false;
        }

        // Render the view
        $view = view('home', [
            'highlighted_vacancies' => $highlighted_vacancies,
            'normal_vacancies' => $normal_vacancies,
            'count_vacancies' => $count_vacancies,
            'last_search' => [
                'search' => $search,
                'contract_type' => $contract_type,
                'journey_hour' => $journey_hour,
                'work_type' => $work_type
            ]
        ])->render();

        // Cache the entire response for 30 minutes
        Cache::put($cacheKey, $view, now()->addMinutes(30));

        // Return the view
        return $view;
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('new-vacancy');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'choiced_plan' => 'required|string|in:Destaque,Normal',
                'title' => 'required|string|max:70',
                'salary' => 'nullable|string|max:50',
                'employment_type' => 'in:CLT,PJ',
                'workload' => 'nullable|integer|max_digits:2',
                'work_schedule' => 'required|in:Diurno,Noturno,Flexível',
                'job_type' => 'required|in:Tempo integral,Estágio,Freelance,Trainee',
                'description' => 'required',
                'show_company' => 'in:on',
                'show_salary' => 'in:on',
                'email_receiver' => 'in:on',
                'hour_receive_email' => 'nullable|required_if:email_receiver,on|in:00:00,00:30,01:00,01:30,02:00,02:30,03:00,03:30,04:00,04:30,05:00,05:30,06:00,06:30,07:00,07:30,08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,18:30,19:00,19:30,20:00,20:30,21:00,21:30,22:00,22:30,23:00,23:30,00:00',
                'limit_candidates' => 'in:on',
                'max_candidates' => 'nullable|required_if:limit_candidates,on|integer',
                'receive_notification' => 'in:on',
                'notifications_views' => 'required_if:receive_notification,on|in:100,150,200,300,500,1000',
            ],
            [],
            [
                'choiced_plan' => 'Plano',
                'title' => 'Título da vaga',
                'salary' => 'Salário (R$)',
                'employment_type' => 'Regime de contratação',
                'workload' => 'Carga horária',
                'work_schedule' => 'Horário de trabalho',
                'job_type' => 'Tipo de trabalho',
                'description' => 'Mais detalhes sobre a vaga',
                'show_company' => 'Exibir nome da empresa',
                'show_salary' => 'Exibir salário',
                'email_receiver' => 'Receber currículos no meu e-mail cadastrado',
                'hour_receive_email' => 'Todo dia às',
                'limit_candidates' => 'Limite de candidatos',
                'max_candidates' => 'Quantidade limite de candidatos',
                'receive_notification' => 'Receber notificação de visualizações',
                'notifications_views' => 'Receber notificações a cada',
            ]
        );

        $user = Auth::user();

        $vacancy = new Vacancy();
        $vacancy->title = $validated['title'];
        $vacancy->company_name = $user->company_name;
        $vacancy->work_schedule = $validated['work_schedule'];
        $vacancy->workload = $validated['workload'];
        $vacancy->salary = $validated['salary'];
        $vacancy->employment_type = $validated['employment_type'];
        $vacancy->job_type = $validated['job_type'];
        $vacancy->description = $validated['description'];
        $vacancy->choiced_plan = $validated['choiced_plan'];

        function verifySingleFields(string $field_name, array $validated, Vacancy $vacancy)
        {
            if (isset($validated[$field_name])) {
                $vacancy->$field_name = 1;
            } else {
                $vacancy->$field_name = 0;
            }
        };

        function verifyDoubleFields(string $first_field_name, string $second_field_name, array $validated, Vacancy $vacancy)
        {
            if (isset($validated[$first_field_name])) {
                $vacancy->$first_field_name = 1;
                $vacancy->$second_field_name = $validated[$second_field_name];
            } else {
                $vacancy->$first_field_name = 0;
            }
        }

        $this->verifySingleFields('show_company', $validated, $vacancy);
        $this->verifySingleFields('show_salary', $validated, $vacancy);

        $this->verifyDoubleFields('email_receiver', 'hour_receive_email', $validated, $vacancy);
        $this->verifyDoubleFields('limit_candidates', 'max_candidates', $validated, $vacancy);
        $this->verifyDoubleFields('receive_notification', 'notifications_views', $validated, $vacancy);

        $vacancy->user_id = $user->id;
        $vacancy->save();

        return redirect()->route('payment.checkout', ['vacancy' => $vacancy]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        $cacheKey = 'vacancy_' . $vacancy->id;

        $cachedVacancy = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($vacancy) {
            return $vacancy;
        });

        if ($cachedVacancy->paid_status === 'paid out') {
            return view('vacancy', ['vacancy' => $cachedVacancy]);
        } else {
            return redirect()->route('home');
        }
    }

    public function updateViews(Vacancy $vacancy)
    {
        $vacancy->views_count++;
        $vacancy->save();

        if($vacancy->views_count % $vacancy->notification_views == 0) {
            return event(new ViewedVacancy($vacancy->views_count, $vacancy->user->email));
        };
    }

    public function preview(Vacancy $vacancy)
    {
        $user = auth()->user();
        if ($vacancy->paid_status === 'in process' || $user && $user->id === 1 || $user && $user->id === $vacancy->user_id) {
            return view('vacancy', ['vacancy' => $vacancy, 'preview_mode' => true]);
        }

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        $have_days = $vacancy->days_available > now();
        return view('edit-vacancy', ['vacancy' => $vacancy, 'have_days' => $have_days]);
    }

    public function makePayment(Vacancy $vacancy)
    {
        return view('preview-and-payment', ['vacancy' => $vacancy]);
    }

    public function pendentVacancies()
    {
        if (auth()->user()->id === 1) {
            $vacancies = Vacancy::where('paid_status', 'paid out')->where('approved_by_admin', 0)->where('days_available', '>', now())->get();
            return view('vacancies-not-approved', ['vacancies' => $vacancies]);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function singlePendentVacancy($id)
    {
        if (auth()->user()->id === 1) {
            $vacancy = Vacancy::find($id);
            return view('single-vacancy-not-approved', ['vacancy' => $vacancy]);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function approvePendentVacancy(Vacancy $vacancy)
    {
        if (auth()->user()->id === 1) {
            $vacancy->approved_by_admin = 1;
            $vacancy->save();
            return redirect()->route('home')->with('success', 'Vaga aprovada e já disponível no site.');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        // Descomentar abaixo caso veja que sistema tem muitas edições sem mudanças:
        // $request['email_receiver'] = $request->has('email_receiver') ? 1 : 0;
        // $request['limit_candidates'] = $request->has('limit_candidates') ? 1 : 0;
        // $request['receive_notification'] = $request->has('receive_notification') ? 1 : 0;
        // $request['show_company'] = $request->has('show_company') ? 1 : 0;
        // $request['show_salary'] = $request->has('show_salary') ? 1 : 0;
        // $request['show_salary'] = $request->has('show_salary') ? 1 : 0;
        // $hourReceiveEmail = $request->input('hour_receive_email');
        // $carbonTime = Carbon::parse($hourReceiveEmail);
        // $request->merge(['hour_receive_email' => $carbonTime->toTimeString()]);
        // $vacancy->fill($request->all());

        // if ($vacancy->isDirty()) {
        //     dd($vacancy->getDirty());
        //     dd('algo mudou');
        // } else {
        //     dd('nada mudou');
        // }

        if ($vacancy->paid_status !== 'paid out' && $vacancy->days_available < now()) {
            $required_if = 'required';
        } else {
            $required_if = '';
        }

        $validated = $request->validate(
            [
                'choiced_plan' => $required_if . '|string|in:Destaque,Normal',
                'title' => 'required|string|max:70',
                'salary' => 'nullable|string|max:50',
                'employment_type' => 'in:CLT,PJ',
                'workload' => 'nullable|integer|max_digits:2',
                'work_schedule' => 'required|in:Diurno,Noturno,Flexível',
                'job_type' => 'required|in:Tempo integral,Estágio,Freelance,Trainee',
                'description' => 'required',
                'show_company' => 'in:on',
                'show_salary' => 'in:on',
                'email_receiver' => 'in:on',
                'hour_receive_email' => 'nullable|required_if:email_receiver,on|in:00:00,00:30,01:00,01:30,02:00,02:30,03:00,03:30,04:00,04:30,05:00,05:30,06:00,06:30,07:00,07:30,08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,18:30,19:00,19:30,20:00,20:30,21:00,21:30,22:00,22:30,23:00,23:30,00:00',
                'limit_candidates' => 'in:on',
                'max_candidates' => 'nullable|required_if:limit_candidates,on|integer',
                'receive_notification' => 'in:on',
                'notifications_views' => 'required_if:receive_notification,on|in:100,150,200,300,500,1000',
            ],
            [],
            [
                'choiced_plan' => 'Plano',
                'title' => 'Título da vaga',
                'salary' => 'Salário (R$)',
                'employment_type' => 'Regime de contratação',
                'workload' => 'Carga horária',
                'work_schedule' => 'Horário de trabalho',
                'job_type' => 'Tipo de trabalho',
                'description' => 'Mais detalhes sobre a vaga',
                'show_company' => 'Exibir nome da empresa',
                'show_salary' => 'Exibir salário',
                'email_receiver' => 'Receber currículos no meu e-mail cadastrado',
                'hour_receive_email' => 'Todo dia às',
                'limit_candidates' => 'Limite de candidatos',
                'max_candidates' => 'Quantidade limite de candidatos',
                'receive_notification' => 'Receber notificação de visualizações',
                'notifications_views' => 'Receber notificações a cada',
            ]
        );

        $this->verifySingleFields('show_company', $validated, $vacancy);
        $this->verifySingleFields('show_salary', $validated, $vacancy);

        $this->verifyDoubleFields('email_receiver', 'hour_receive_email', $validated, $vacancy);
        $this->verifyDoubleFields('limit_candidates', 'max_candidates', $validated, $vacancy);
        $this->verifyDoubleFields('receive_notification', 'notifications_views', $validated, $vacancy);

        if (isset($validated['choiced_plan'])) {
            $vacancy->choiced_plan = $validated['choiced_plan'];
        }
        $vacancy->title = $validated['title'];
        $vacancy->work_schedule = $validated['work_schedule'];
        $vacancy->workload = $validated['workload'];
        $vacancy->salary = $validated['salary'];
        $vacancy->user_id = $request->user()->id;
        $vacancy->company_name = $request->user()->company_name;
        $vacancy->employment_type = $validated['employment_type'];
        $vacancy->job_type = $validated['job_type'];
        $vacancy->description = $validated['description'];

        $vacancy->save();

        return redirect()->route('payment.checkout', [
            'vacancy' => $vacancy
        ]);
    }

    private function verifySingleFields(string $field_name, array $validated, Vacancy $vacancy)
    {
        if (isset($validated[$field_name])) {
            $vacancy->$field_name = 1;
        } else {
            $vacancy->$field_name = 0;
        }
    }

    private function verifyDoubleFields(string $first_field_name, string $second_field_name, array $validated, Vacancy $vacancy)
    {
        if (isset($validated[$first_field_name])) {
            $vacancy->$first_field_name = 1;
            $vacancy->$second_field_name = $validated[$second_field_name];
        } else {
            $vacancy->$first_field_name = 0;
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        //
    }
}
