<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class VacanciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela antes de inserir novos dados
        DB::table('vacancies')->truncate();

        // Inicializa o Faker
        $faker = Faker::create();

        // Insere 100 vagas com dados aleatórios
        for ($i = 0; $i < 100; $i++) {
            DB::table('vacancies')->insert([
                'title' => $faker->randomElement([
                    'Engenheiro Civil',
                    'Desenvolvedor de Software',
                    'Advogado',
                    'Médico',
                    'Enfermeiro',
                    'Professor',
                    'Contador',
                    'Arquiteto',
                    'Designer Gráfico',
                    'Analista de Marketing',
                    'Piloto',
                    'Farmacêutico',
                    'Analista Financeiro',
                    'Cientista de Dados',
                    'Psicólogo',
                    'Fotógrafo',
                    'Jornalista',
                    'Chef de Cozinha',
                    'Eletricista',
                    'Encanador',
                    'Economista',
                    'Gerente de Recursos Humanos',
                    'Técnico de Informática',
                    'Policial',
                    'Bombeiro',
                    'Ator/Atriz',
                    'Pintor',
                    'Empreendedor',
                    'Terapeuta Ocupacional',
                    'Engenheiro Elétrico',
                    'Geólogo',
                    'Motorista de Entrega',
                    'Nutricionista',
                    'Carpinteiro',
                    'Fisioterapeuta',
                    'Analista de Sistemas',
                    'Designer de Interiores',
                    'Mecânico Automotivo',
                    'Assistente Social',
                    'Biólogo',
                    'Instrutor de Fitness',
                    'Meteorologista',
                    'Recepcionista',
                    'Tradutor',
                    'Técnico de Laboratório',
                    'Piloto de Drone',
                    'Tatuador',
                    'Engenheiro Mecânico',
                ]),
                'company_name' => $faker->company,
                'work_schedule' => $faker->randomElement(['Diurno', 'Noturno', 'Flexível']),
                'workload' => $faker->randomElement(['44', '40']),
                'salary' => $faker->randomFloat(2, 3000, 10000),
                'employment_type' => $faker->randomElement(['CLT', 'PJ']),
                'education_level' => $faker->randomElement(['Ensino Médio', 'Superior Completo', 'Pós-Graduação']),
                'job_type' => $faker->randomElement(['Estágio', 'Trainee', 'Freelance', 'Tempo integral']),
                'description' => $faker->paragraph,
                'days_avaliable' => $faker->dateTimeBetween('-30 days', '+30 days'),
                'choiced_plan' => $faker->randomElement(['Normal', 'Destaque']),
                'max_candidates' => $faker->numberBetween(5, 20),
                'notify_after_candidates' => $faker->numberBetween(1, 10),
                'view_count' => $faker->numberBetween(50, 500),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
