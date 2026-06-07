<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\CandidateField;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CandidateField>
 */
class CandidateFieldFactory extends Factory
{
    protected $model = CandidateField::class;

    public function definition(): array
    {
        $ddd = '82';

        return [
            'candidate_id' => Candidate::factory(),
            'vacancy_id' => Vacancy::factory(),
            'full_name' => fake()->name(),
            'district' => fake()->randomElement([
                'Ponta Verde', 'Cruz das Almas', 'Farol', 'Pajuçara', 'Benedito Bentes',
            ]),
            'phone' => "({$ddd}) 9" . fake()->numerify('####-####'),
            'whatsapp' => "({$ddd}) 9" . fake()->numerify('####-####'),
            'experience_years' => fake()->randomElement([
                'Não tenho experiência', 'Menos de 1 ano', '1 ano', '3 anos', '5 anos', '10 anos ou mais',
            ]),
            'marital_status' => fake()->randomElement(['solteiro(a)', 'casado(a)', 'divorciado(a)']),
            'has_children' => fake()->randomElement(['sim', 'não']),
            'availability' => fake()->randomElement(['dia', 'noite', 'qualquer horário']),
            'birth_date' => fake()->dateTimeBetween('-45 years', '-18 years')->format('Y-m-d'),
            'created_at' => fake()->dateTimeBetween('-14 days', 'now'),
        ];
    }
}
