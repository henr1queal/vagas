<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        $request->validate([
            'curriculum' => 'required|mimes:pdf,doc,docx|max:5120',
            'vacancy' => 'required|string|size:36',
        ]);

        try {
            DB::beginTransaction();
            $file = $request->file('curriculum');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = $originalName . '_' . date('d_m_Y_H_i_s') . '.' . $extension;
            $file->storeAs('curriculos', $filename);
            $candidate = new Candidate();
            $candidate->filename = $filename;
            $candidate->vacancy_id = $request->vacancy;
            $candidate->save();
            DB::commit();
            return redirect()->back()->with('success-candidate', 'Agora você está na disputa! Aguarde um retorno do recrutador. Boa sorte!');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($path)) {
                Storage::delete($path);
            }
            return redirect()->back()->with('error-candidate', 'Erro ao enviar currículo. Tente novamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
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
