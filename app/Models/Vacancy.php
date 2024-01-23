<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'paid_value',
        'approved_by_admin'
    ];

    protected $casts = [
        'days_available' => 'datetime',
    ];
}
