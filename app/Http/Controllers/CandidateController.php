<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateField;
use App\Models\CandidateFile;
use App\Models\Experience;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use LaravelLegends\PtBrValidator\Rules\CelularComDdd;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function storeFile(Request $request)
    {
        $vacancy = Vacancy::withCount(['candidateFiles', 'candidateFields'])->find('9b29f616-d347-439e-b8e0-6746392224e2');
        if ($vacancy->max_candidates === null || $vacancy->max_candidates > $vacancy->candidate_files_count + $vacancy->candidate_fields_count) {
            try {
                $request->validateWithBag(
                    'post',
                    [
                        'name_form_file' => 'required|string|max:255',
                        'curriculum' => 'required|mimes:pdf,doc,docx|max:5120',
                        'phone_form_file' => [new CelularComDdd, 'required', 'string', 'max:15'],
                        'whatsapp_form_file' => [new CelularComDdd, 'required', 'string', 'max:15'],
                        'vacancy' => 'required|string|size:36',
                    ],
                    [],
                    [
                        'curriculum' => 'Adicionar arquivo',
                        'name_form_file' => 'Nome completo',
                        'phone_form_file' => 'Telefone/celular',
                        'whatsapp_form_file' => 'Whatsapp',
                        'vacancy' => 'Vaga (não burle).'
                    ]
                );
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors($th->validator->errors(), 'fileErrors')->withInput();
            }

            try {
                DB::beginTransaction();
                $file = $request->file('curriculum');
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = $originalName . '_' . date('d_m_Y_H_i_s') . '.' . $extension;
                $file->storeAs('curriculos', $filename);

                $candidate = Candidate::firstOrNew(
                    ['phone' => $request->phone_form_file, 'name' => $request->name_form_file]
                );
                $candidate->name = $request->name_form_file;
                $candidate->phone = $request->phone_form_file;
                $candidate->whatsapp = $request->whatsapp_form_file;
                $candidate->save();

                $candidate_file = CandidateFile::firstOrNew(
                    ['candidate_id' => $candidate->id, 'vacancy_id' => $request->vacancy]
                );

                if ($candidate_file->exists) {
                    Storage::delete('/app/curriculos/' . $candidate_file->filename);
                }

                $candidate_file->filename = $filename;
                $candidate_file->vacancy_id = $request->vacancy;
                $candidate_file->candidate_id = $candidate->id;
                $candidate_file->save();
                DB::commit();
                return redirect()->back()->with('success-candidate-file', 'Agora você está na disputa! Aguarde um retorno do recrutador. Boa sorte!');
            } catch (\Exception $e) {
                DB::rollBack();
                if (isset($candidate_file->filename)) {
                    Storage::delete('curriculos/' . $candidate_file->filename);
                }
                return redirect()->back()->with('error-candidate-file', 'Houve um erro. Envie novamente seu currículo.');
            }
        }
        return redirect()->route('home')->with('error', 'Candidatura indisponível para esta vaga.');
    }

    public function storeFields(Request $request)
    {
        $vacancy = Vacancy::withCount(['candidateFiles', 'candidateFields'])->find('9b29f616-d347-439e-b8e0-6746392224e2');
        if ($vacancy->max_candidates === null || $vacancy->max_candidates > $vacancy->candidate_files_count + $vacancy->candidate_fields_count) {
            try {
                $request->validateWithBag(
                    'post',
                    [
                        'full_name' => 'required|string|max:255',
                        'birth_date' => 'required|date',
                        'phone' => [new CelularComDdd, 'required', 'string', 'max:15'],
                        'whatsapp' => [new CelularComDdd, 'required', 'string', 'max:15'],
                        'district' => 'required|string|max:255',
                        'experience_years' => 'required|in:Não tenho experiência,Menos de 1 ano,1 ano,2 anos,3 anos,4 anos,5 anos,6 anos,7 anos,8 anos,9 anos,10 anos ou mais',
                        'marital_status' => 'required|in:solteiro(a),casado(a),divorciado(a),viúvo(a)',
                        'has_children' => 'required|in:sim,não',
                        'availability' => 'required|in:dia,noite,qualquer horário',
                        'experiences' => 'array',
                        'experiences.*.company_name' => 'nullable|string|max:150',
                        'experiences.*.job_title' => 'nullable|string|max:255',
                        'experiences.*.start_date' => 'nullable|date',
                        'experiences.*.end_date' => 'nullable|date',
                        'experiences.*.description' => 'nullable|string',
                        'vacancy' => 'required|string|size:36',
                    ],
                    [],
                    [
                        'full_name' => 'Nome completo',
                        'birth_date' => 'Data de nascimento',
                        'phone' => 'Telefone/celular',
                        'whatsapp' => 'Whatsapp',
                        'district' => 'Bairro',
                        'experience_years' => 'Tempo de experiência na função',
                        'marital_status' => 'Estado civil',
                        'has_children' => 'Filhos',
                        'availability' => 'Horário Disponível',
                        'experiences' => 'Experiencias',
                        'experiences.*.company_name' => 'Nome da empresa',
                        'experiences.*.job_title' => 'Função exercida',
                        'experiences.*.start_date' => 'Data de admissão',
                        'experiences.*.end_date' => 'Data de revisão',
                        'experiences.*.description' => 'Conte sobre sua experiência',
                        'vacancy' => 'Vaga (não burle).',
                    ]
                );
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors($th->validator->errors(), 'postErrors')->withInput();
            }

            try {
                DB::beginTransaction();
                $candidate = Candidate::firstOrNew(
                    ['phone' => $request->phone, 'name' => $request->full_name]
                );

                $candidate->name = $request->full_name;
                $candidate->phone = $request->phone;
                $candidate->whatsapp = $request->whatsapp;
                $candidate->save();

                $candidate_fields = CandidateField::firstOrNew(
                    ['candidate_id' => $candidate->id, 'vacancy_id' => $request->vacancy]
                );

                $candidate_fields->birth_date = $request->birth_date;
                $candidate_fields->district = $request->district;
                $candidate_fields->experience_years = $request->experience_years;
                $candidate_fields->marital_status = $request->marital_status;
                $candidate_fields->has_children = $request->has_children;
                $candidate_fields->availability = $request->availability;
                $candidate_fields->candidate_id = $candidate->id;
                $candidate_fields->vacancy_id = $request->vacancy;
                $candidate_fields->save();

                $experiences = $request->input('experiences', []);
                foreach ($experiences as $experience_data) {
                    if ($experience_data['company_name'] !== null && $experience_data['job_title'] !== null) {
                        $experience = new Experience($experience_data);
                        $candidate_fields->experiences()->save($experience);
                    }
                }
                DB::commit();
                return redirect()->back()->with('success-candidate-fields', 'Agora você está na disputa! Aguarde um retorno do recrutador. Boa sorte!');
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->back()->with('error-candidate-fields', 'Houve um erro. Envie novamente seu currículo.');
            }
        }

        return redirect()->route('home')->with('error', 'Candidatura indisponível para esta vaga.');
    }

    /**
     * Display the specified resource.
     */
    public function show($vacancy_id)
    {
        $perPage = 20;
        $candidates = Candidate::with([
            'candidateFiles',
            'candidateFields.experiences' => function ($query) {
                $query->orderBy('start_date', 'desc'); // Ordena as experiências por start_date mais recentes
            },
        ])
            ->where(function ($query) use ($vacancy_id) {
                $query->whereHas('candidateFiles', function ($q) use ($vacancy_id) {
                    $q->where('vacancy_id', $vacancy_id)->orderBy('created_at', 'asc');
                })->orWhereHas('candidateFields', function ($q) use ($vacancy_id) {
                    $q->where('vacancy_id', $vacancy_id);
                });
            })
            ->paginate($perPage);


        return view('candidates-vacancy', ['candidates' => $candidates]);
    }

    public function showCurriculum($filename)
    {
        $candidate_file = CandidateFile::where('filename', $filename)->firstOrFail();
        if (auth()->id() === $candidate_file->vacancy->user_id) {
            $caminhoArquivo = storage_path('app/curriculos/' . $filename);
            return response()->file($caminhoArquivo);
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para acessar este arquivo.');
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
