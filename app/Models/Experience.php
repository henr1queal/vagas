<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'company_name',
        'job_title',
        'start_date',
        'end_date',
        'description',
        'candidate_fields_id'
    ];

    public function candidateField()
    {
        return $this->belongsTo(CandidateField::class);
    }
}
