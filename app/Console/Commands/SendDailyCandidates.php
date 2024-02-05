<?php

namespace App\Console\Commands;

use App\Jobs\SendDailyCandidatesJob;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDailyCandidates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-candidates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $currentHour = Carbon::now();

        $startMargin = $currentHour->copy()->subMinutes(10)->format('H:i:s');
        $endMargin = $currentHour->copy()->addMinutes(10)->format('H:i:s');

        // Buscar vagas que atendem aos critérios
        $vacancies = Vacancy::whereHas('candidateFields', function (Builder $query) {
            $query->where('created_at', '>=', now()->subDay())->where('created_at', '<=', now());
        })
        ->orWhereHas('candidateFiles', function (Builder $query) {
            $query->where('created_at', '>=', now()->subDay())->where('created_at', '<=', now());
        })
        ->where('days_available', '>', now())
        ->where('approved_by_admin', 1)
        ->where('paid_status', 'paid out')
        ->where('email_receiver', 1)
        ->whereTime('hour_receive_email', '>=', $startMargin)
        ->whereTime('hour_receive_email', '<=', $endMargin)
        ->get();
        
        if ($vacancies->count() > 0) {
            foreach ($vacancies as $vacancy) {
                Log::info('success-cron', ['success-cron' => 'success-cron kkk! ' . $currentHour]);
                dispatch(new SendDailyCandidatesJob($vacancy->user->email));
            }
        }

        $this->info('Cronjob executado com sucesso!');
    }
}
