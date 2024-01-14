<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacanciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vacancies = Vacancy::select([
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
            ->orderBy('created_at', 'desc')
            ->get();

        // Mapeia as datas formatadas para português abreviado em 3 letras
        // Mapeia as datas formatadas para português abreviado em 3 letras
        $formattedVacancies = $vacancies->map(function ($vacancy) {
            $formattedDate = $vacancy->created_at->translatedFormat('M, d Y'); // Formata a data para "M, d Y"
            [$month, $day, $year] = explode(' ', $formattedDate);

            // Adiciona as propriedades de dia, mês e ano diretamente no objeto Eloquent
            $vacancy->formatted_created_at = [
                'month' => ucfirst(rtrim($month, ',')),
                'day' => $day,
                'year' => $year,
            ];

            return $vacancy;
        });

        $highlightedVacancies = $formattedVacancies->filter(function ($vacancy) {
            return $vacancy->choiced_plan === 'Destaque';
        });

        $normalVacancies = $formattedVacancies->filter(function ($vacancy) {
            return $vacancy->choiced_plan === 'Normal';
        });

        return view('home', [
            'highlighted_vacancies' => $highlightedVacancies,
            'normal_vacancies' => $normalVacancies,
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
        dd('xd');
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
