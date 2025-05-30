<?php

namespace App\Jobs;

use App\Mail\NotifyUserOnFailedWebhook;
use App\Models\Destination;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWebhookFailedWarning implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $retries = 3;
    public $backoff = [20, 60];
    public function __construct(public readonly Destination $destination)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
     
        Mail::to(
            $this->destination->alert_on_failure
        )->send(new NotifyUserOnFailedWebhook());
    }
}
