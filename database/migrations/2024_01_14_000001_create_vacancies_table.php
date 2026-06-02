<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('company_name')->nullable();
            $table->string('work_schedule')->nullable();
            $table->string('workload')->nullable();
            $table->string('salary')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('job_type')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('days_available')->nullable();
            $table->string('choiced_plan')->nullable();
            $table->boolean('email_receiver')->default(false);
            $table->string('hour_receive_email')->nullable();
            $table->boolean('limit_candidates')->default(false);
            $table->unsignedInteger('max_candidates')->nullable();
            $table->boolean('receive_notification')->default(false);
            $table->unsignedInteger('notification_views')->nullable();
            $table->unsignedInteger('view_count')->default(0);
            $table->boolean('show_company')->default(false);
            $table->boolean('show_salary')->default(false);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('paid_status')->nullable();
            $table->boolean('approved_by_admin')->default(false);
            $table->decimal('paid_value', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
