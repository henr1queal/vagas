<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('candidates_vacancies', function (Blueprint $table) {
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->uuid('vacancy_id');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->cascadeOnDelete();
            $table->primary(['candidate_id', 'vacancy_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates_vacancies');
        Schema::dropIfExists('candidates');
    }
};
