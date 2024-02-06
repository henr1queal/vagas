<?php

namespace App\Jobs;

use App\Mail\SendDailyCandidates;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDailyCandidatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $email;
    protected $subday;
    protected $title;
    protected $id;

    public function __construct($email, $subday, $title, $id)
    {
        $this->email = $email;
        $this->subday = $subday;
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SendDailyCandidates($this->subday, $this->title, $this->id));
    }
}
