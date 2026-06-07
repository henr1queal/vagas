<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\CandidateFile;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CandidateFile>
 */
class CandidateFileFactory extends Factory
{
    protected $model = CandidateFile::class;

    public function definition(): array
    {
        $name = fake()->lastName() . '_' . fake()->date('d_m_Y_H_i_s');

        return [
            'candidate_id' => Candidate::factory(),
            'vacancy_id' => Vacancy::factory(),
            'filename' => "curriculo_{$name}.pdf",
            'created_at' => fake()->dateTimeBetween('-14 days', 'now'),
        ];
    }
}
