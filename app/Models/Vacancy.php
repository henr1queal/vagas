<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_name',
        'workload',
        'work_schedule',
        'salary',
        'employment_type',
        'education_level',
        'job_type',
        'description',
        'days_avaliable',
        'choiced_plan',
        'max_candidates',
        'notify_after_candidates',
        'view_count',
    ];

    protected $casts = [
        'days_avaliable' => 'datetime',
    ];
}
