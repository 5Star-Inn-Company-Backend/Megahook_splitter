<?php
namespace App\Actions;

use App\Jobs\SendWebhook;
use App\Models\Destination;
use App\Models\RequestLog;
use App\Models\Webhook;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Validator;

class IncomingWebhookAction
{
    public function execute(Validator $validator, string $id): Response
    {
        $payload = $validator->validated();

        $webhook = Webhook::where('endpoint', $id)->first();
        if (!$webhook) {
            return response(['message' => 'Message not received!'], 404);
        }

        $destination = Destination::where('webhook_id', $webhook->id)->first();
        if (!$destination) {
            return response(['message' => 'Destination endpoint not found!'], 404);
        }

        $response = SendWebhook::dispatch($destination, $payload);
        //$response = Http::post($destination->endpoint_url, $payload);

         
        if (!$response->successful()) {
            return response(['message' => 'Failed to send payload!', 'response' => $response->json()], $response->status());

        } 
        RequestLog::create([
            'user_id' => $webhook->user_id,
            'bucket' => $webhook->input_name,
            'destination' => $destination->destination_name,
            'status' => 'success',
            'response_code' => $webhook->response_code
        ]);
         
        return response((['message' => 'Payload sent successfully!', 'response' => $webhook->response_content]), $webhook->response_code)
                  ->header('Content-Type', $webhook->response_content_type);
               

                  

        
    }
}