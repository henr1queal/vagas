<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CandidateField extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    
    protected $fillable = [
        'full_name',
        'district',
        'phone',
        'whatsapp',
        'experience_years',
        'married',
        'has_children',
        'availability',
        'birth_date',
        'vacancy_id'
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
    
    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id', 'id');
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class, 'candidate_fields_id', 'id');
    }
}
