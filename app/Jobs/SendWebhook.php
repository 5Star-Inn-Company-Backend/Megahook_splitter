<?php

namespace App\Jobs;

use App\Models\Destination;
use App\Models\RequestLog;
use App\Models\Webhook;
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
        public readonly array $payload,
        public readonly Webhook $webhook
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::timeout(5)->post($this->destination->endpoint_url, $this->payload);
        RequestLog::create([
            'user_id' => $this->webhook->user_id,
            'bucket' => $this->webhook->input_name,
            'destination' => $this->destination->destination_name,
            'status' => 'success',
            'response_code' => $this->webhook->response_code
        ]);
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
