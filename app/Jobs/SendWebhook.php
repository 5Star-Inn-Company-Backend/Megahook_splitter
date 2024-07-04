<?php

namespace App\Jobs;

use App\Models\Destination;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SendWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $tries = 0;
    public function __construct(
        public readonly Destination $destination,
        public readonly array $payload
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::post($this->destination->endpoint_url, $this->payload);

        // if($response->failed()){
        //     $this->release(
        //         now()->addMinutes(15 * $this->attempts())
        //     );
        // }
    }

    public function retryUntil()
    {
        return now()->addDay();
    }

    public function failed()
    {
         SendWebhookFailedWarning::dispatch($this->destination);
    }

    public function successful()
    {
         return;
    }
}
