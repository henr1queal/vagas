<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'company_name' => fake()->company(),
            'cnpj' => fake()->numerify('##.###.###/####-##'),
            'phone' => '(82) 9' . fake()->numerify('####-####'),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn () => [
            'name' => 'Administrador Vagas Maceió',
            'email' => 'admin@vagasmaceio.test',
            'company_name' => 'Vagas Maceió',
            'cnpj' => '00.000.000/0001-00',
            'phone' => '(82) 98765-4321',
            'password' => Hash::make('VagasAdmin@2026'),
        ]);
    }

    public function employer(): static
    {
        return $this->state(fn () => [
            'name' => fake()->name(),
            'company_name' => fake()->company(),
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
