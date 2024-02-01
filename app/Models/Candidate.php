<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    
    protected $fillable = [
        'name',
        'phone',
        'vacancy_id',
    ];

    public function vacancies(): BelongsToMany
    {
        return $this->belongsToMany(Vacancy::class, 'candidates_vacancies', 'candidate_id', 'vacancy_id');
    }

    public function candidateFields(): HasMany
    {
        return $this->hasMany(CandidateField::class, 'candidate_id', 'id');
    }
    
    public function candidateFiles(): HasMany
    {
        return $this->hasMany(CandidateFile::class, 'candidate_id', 'id');
    }
}
