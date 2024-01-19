<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VacanciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vacancy::select([
            'id',
            'title',
            'employment_type',
            'job_type',
            'workload',
            'salary',
            'company_name',
            'choiced_plan',
            'created_at',
        ])
            ->whereIn('choiced_plan', ['Destaque', 'Normal'])
            ->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        $vacancies = $query->get();

        $count_vacancies = $vacancies->count();

        $grouped_vacancies = $vacancies->groupBy([
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

        return view('home', [
            'highlighted_vacancies' => $highlighted_vacancies,
            'normal_vacancies' => $normal_vacancies,
            'count_vacancies' => $count_vacancies,
            'last_search' => $request->search
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:70',
                'salary' => 'nullable|string|max:50',
                'employment_type' => 'in:CLT,PJ',
                'workload' => 'nullable|integer|max_digits:2',
                'work_shedule' => 'required|in:Diurno,Noturno,Flexível',
                'job_type' => 'required|in:Tempo integral,Estágio,Freelance,Trainee',
                'description' => 'required',
                'show_company' => 'in:on',
                'show_salary' => 'in:on',
                'email_receiver' => 'in:on',
                'hour_receive_email' => 'required_if:email_receiver,on|in:00:00,00:30,01:00,01:30,02:00,02:30,03:00,03:30,04:00,04:30,05:00,05:30,06:00,06:30,07:00,07:30,08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,18:30,19:00,19:30,20:00,20:30,21:00,21:30,22:00,22:30,23:00,23:30,00:00',
                'limit_candidates' => 'in:on',
                'number_limit_candidates' => 'nullable|required_if:limit_candidates,on|integer',
                'receive_notification' => 'in:on',
                'notifications_views' => 'required_if:receive_notification,on|in:100,150,200,300,500,1000',
            ],
            [],
            [
                'title' => 'Título da vaga',
                'salary' => 'Salário (R$)',
                'employment_type' => 'Regime de contratação',
                'workload' => 'Carga horária',
                'work_shedule' => 'Horário de trabalho',
                'job_type' => 'Tipo de trabalho',
                'description' => 'Mais detalhes sobre a vaga',
                'show_company' => 'Exibir nome da empresa',
                'show_salary' => 'Exibir salário',
                'email_receiver' => 'Receber currículos no meu e-mail cadastrado',
                'hour_receive_email' => 'Todo dia às',
                'limit_candidates' => 'Limite de candidatos',
                'number_limit_candidates' => 'Quantidade limite de candidatos',
                'receive_notification' => 'Receber notificação de visualizações',
                'notifications_views' => 'Receber notificações a cada',
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        return view('vacancy', ['vacancy' => $vacancy]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        //
    }
}
