<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vacancy>
 */
class VacancyFactory extends Factory
{
    protected $model = Vacancy::class;

    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'Desenvolvedor PHP',
                'Analista de Marketing',
                'Assistente Administrativo',
                'Vendedor Externo',
                'Recepcionista',
                'Engenheiro Civil',
                'Auxiliar de Cozinha',
                'Motorista',
                'Designer Gráfico',
                'Técnico de Enfermagem',
            ]),
            'company_name' => fake()->company(),
            'work_schedule' => fake()->randomElement(['Diurno', 'Noturno', 'Flexível']),
            'workload' => fake()->randomElement(['40', '44']),
            'salary' => fake()->numberBetween(1500, 8000) . ',00',
            'employment_type' => fake()->randomElement(['CLT', 'PJ']),
            'job_type' => fake()->randomElement(['Tempo integral', 'Estágio', 'Freelance', 'Trainee']),
            'description' => fake()->paragraphs(2, true),
            'days_available' => fake()->dateTimeBetween('+15 days', '+60 days'),
            'choiced_plan' => fake()->randomElement(['Destaque', 'Normal']),
            'email_receiver' => fake()->boolean(40),
            'hour_receive_email' => fake()->randomElement(['08:00', '12:00', '18:00']),
            'limit_candidates' => true,
            'max_candidates' => fake()->numberBetween(10, 30),
            'receive_notification' => fake()->boolean(30),
            'notification_views' => fake()->randomElement([100, 150, 200]),
            'view_count' => fake()->numberBetween(20, 500),
            'show_company' => true,
            'show_salary' => fake()->boolean(70),
            'user_id' => User::factory(),
            'paid_status' => 'paid out',
            'approved_by_admin' => true,
            'paid_value' => fake()->randomElement([79.90, 99.90, 129.90]),
            'payment_type' => 'credit_card',
        ];
    }

    public function pendingApproval(): static
    {
        return $this->state(fn () => [
            'approved_by_admin' => false,
            'paid_status' => 'paid out',
            'days_available' => fake()->dateTimeBetween('+20 days', '+45 days'),
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn () => [
            'approved_by_admin' => true,
            'paid_status' => 'paid out',
            'days_available' => fake()->dateTimeBetween('-30 days', '-1 day'),
        ]);
    }

    public function paymentPending(): static
    {
        return $this->state(fn () => [
            'paid_status' => 'in process',
            'approved_by_admin' => false,
        ]);
    }

    public function highlighted(): static
    {
        return $this->state(fn () => ['choiced_plan' => 'Destaque']);
    }
}
