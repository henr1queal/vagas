<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Candidate>
 */
class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition(): array
    {
        $ddd = '82';

        return [
            'name' => fake()->name(),
            'phone' => "({$ddd}) 9" . fake()->numerify('####-####'),
            'whatsapp' => "({$ddd}) 9" . fake()->numerify('####-####'),
        ];
    }
}
