<?php

namespace App\Listeners;

use App\Events\ViewedVacancy;
use App\Mail\SendNotificationTotalVacancyViews;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNotificationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ViewedVacancy $event): void
    {
        $views_count = $event->views_count;
        $email = $event->email;

        // Log::info('success', ['success' => 'Com sucesso!', 'email' => $email, 'views_count' => $views_count]);

        Mail::to($email)->send(new SendNotificationTotalVacancyViews($views_count));
    }
}
