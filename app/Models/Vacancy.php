<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'company_name',
        'work_schedule',
        'workload',
        'salary',
        'employment_type',
        'job_type',
        'description',
        'days_available',
        'choiced_plan',
        'email_receiver',
        'hour_receive_email',
        'limit_candidates',
        'max_candidates',
        'receive_notification',
        'notification_views',
        'view_count',
        'show_company',
        'show_salary',
        'user_id',
        'paid_status',
        'approved_by_admin',
        'paid_value',
        'payment_type'
    ];

    protected $casts = [
        'days_available' => 'datetime',
    ];

    public function candidateFields(): HasMany
    {
        return $this->hasMany(CandidateField::class, 'vacancy_id', 'id');
    }

    public function candidateFiles(): HasMany
    {
        return $this->hasMany(CandidateFile::class, 'vacancy_id', 'id');
    }
}
