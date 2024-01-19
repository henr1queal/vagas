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
        //
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
