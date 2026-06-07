<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\CandidateField;
use App\Models\CandidateFile;
use App\Models\Experience;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DemoSeeder extends Seeder
{
    public const ADMIN_EMAIL = 'admin@vagasmaceio.test';

    public const ADMIN_PASSWORD = 'VagasAdmin@2026';

    public function run(): void
    {
        $this->command?->info('Limpando dados de demonstração...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Experience::query()->delete();
        CandidateField::query()->delete();
        CandidateFile::query()->delete();
        DB::table('candidates_vacancies')->delete();
        Candidate::query()->delete();
        Vacancy::query()->delete();
        User::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $admin = User::factory()->admin()->create([
            'id' => 1,
            'email_verified_at' => now(),
        ]);

        $employer = User::factory()->employer()->create([
            'name' => 'Empresa Exemplo LTDA',
            'email' => 'empresa@vagasmaceio.test',
            'password' => Hash::make('Empresa@2026'),
        ]);

        $activeVacancies = Vacancy::factory()
            ->count(8)
            ->for($admin)
            ->sequence(
                ['choiced_plan' => 'Destaque', 'title' => 'Desenvolvedor PHP Laravel'],
                ['choiced_plan' => 'Destaque', 'title' => 'Analista de Marketing Digital'],
                ['choiced_plan' => 'Normal', 'title' => 'Assistente Administrativo'],
                ['choiced_plan' => 'Normal', 'title' => 'Vendedor Externo'],
                ['choiced_plan' => 'Destaque', 'title' => 'Recepcionista Bilíngue'],
                ['choiced_plan' => 'Normal', 'title' => 'Auxiliar de Cozinha'],
                ['choiced_plan' => 'Normal', 'title' => 'Motorista CNH D'],
                ['choiced_plan' => 'Destaque', 'title' => 'Designer Gráfico'],
            )
            ->create([
                'company_name' => $admin->company_name,
                'paid_status' => 'paid out',
                'approved_by_admin' => true,
            ]);

        Vacancy::factory()
            ->count(2)
            ->for($admin)
            ->pendingApproval()
            ->create([
                'company_name' => $admin->company_name,
                'title' => fake()->randomElement(['Técnico de Enfermagem', 'Engenheiro Civil']),
            ]);

        Vacancy::factory()
            ->count(1)
            ->for($admin)
            ->expired()
            ->create([
                'company_name' => $admin->company_name,
                'title' => 'Estágio em Contabilidade',
            ]);

        Vacancy::factory()
            ->count(2)
            ->for($employer)
            ->create([
                'company_name' => $employer->company_name,
            ]);

        $allVacancies = Vacancy::where('approved_by_admin', true)
            ->where('paid_status', 'paid out')
            ->where('days_available', '>', now())
            ->get();

        Storage::disk('local')->makeDirectory('curriculos');

        foreach ($allVacancies as $vacancy) {
            $candidatesCount = fake()->numberBetween(4, 9);

            for ($i = 0; $i < $candidatesCount; $i++) {
                if ($i % 2 === 0) {
                    $this->createFieldCandidate($vacancy);
                } else {
                    $this->createFileCandidate($vacancy);
                }
            }
        }

        $this->command?->newLine();
        $this->command?->info('=== Credenciais de acesso ===');
        $this->command?->line('Admin (painel + aprovação de vagas):');
        $this->command?->line('  E-mail: ' . self::ADMIN_EMAIL);
        $this->command?->line('  Senha:  ' . self::ADMIN_PASSWORD);
        $this->command?->newLine();
        $this->command?->line('Empresa (vagas de exemplo):');
        $this->command?->line('  E-mail: empresa@vagasmaceio.test');
        $this->command?->line('  Senha:  Empresa@2026');
        $this->command?->newLine();
        $this->command?->info(sprintf(
            'Criados: %d vagas do admin, %d candidaturas no total.',
            Vacancy::where('user_id', $admin->id)->count(),
            CandidateField::count() + CandidateFile::count()
        ));
    }

    private function createFieldCandidate(Vacancy $vacancy): void
    {
        $candidate = Candidate::factory()->create();

        $field = CandidateField::factory()->create([
            'candidate_id' => $candidate->id,
            'vacancy_id' => $vacancy->id,
            'full_name' => $candidate->name,
            'phone' => $candidate->phone,
            'whatsapp' => $candidate->whatsapp,
        ]);

        Experience::create([
            'candidate_fields_id' => $field->id,
            'company_name' => fake()->company(),
            'job_title' => fake()->randomElement(['Assistente', 'Analista', 'Coordenador', 'Técnico']),
            'start_date' => now()->subYears(3)->format('Y-m-d'),
            'end_date' => now()->subYear()->format('Y-m-d'),
            'description' => fake()->sentence(12),
        ]);

        DB::table('candidates_vacancies')->insertOrIgnore([
            'candidate_id' => $candidate->id,
            'vacancy_id' => $vacancy->id,
        ]);
    }

    private function createFileCandidate(Vacancy $vacancy): void
    {
        $candidate = Candidate::factory()->create();
        $filename = 'curriculo_demo_' . $candidate->id . '_' . $vacancy->id . '.pdf';

        Storage::disk('local')->put("curriculos/{$filename}", '%PDF-1.4 demo');

        CandidateFile::factory()->create([
            'candidate_id' => $candidate->id,
            'vacancy_id' => $vacancy->id,
            'filename' => $filename,
        ]);

        DB::table('candidates_vacancies')->insertOrIgnore([
            'candidate_id' => $candidate->id,
            'vacancy_id' => $vacancy->id,
        ]);
    }
}
