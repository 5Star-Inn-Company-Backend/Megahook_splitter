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
use Illuminate\Support\Facades\Log;

class SendWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = [20, 60];

    public function __construct(
        public readonly Destination $destination,
        public readonly array $payload,
        public readonly Webhook $webhook
    ) {}

    public function handle(): void
    {
        $response = Http::timeout(5)->post($this->destination->endpoint_url, $this->payload);

        RequestLog::create([
            'user_id' => $this->webhook->user_id,
            'bucket' => $this->webhook->input_name,
            'destination' => $this->destination->destination_name,
            'status' => $response->successful() ? 'success' : 'failed',
            'input' => $this->payload,
            'response_code' => $response->status(),
        ]);

        if (!$response->successful()) {
            Log::info('Failed to send webhook payload to '.$this->destination->endpoint_url." :Body: ".$response->status());
            // $this->fail(new Exception('Failed to send webhook payload.'));
            $this->failed(new Exception('Failed to send webhook payload.'));
        }else{
            Log::info('Successfully sent webhook payload to '.$this->destination->endpoint_url);
        }
    }

    public function retryUntil()
    {
        return now()->addDay();
    }

    public function failed(Exception $exception)
    {
        SendWebhookFailedWarning::dispatch($this->destination);
    }
}
