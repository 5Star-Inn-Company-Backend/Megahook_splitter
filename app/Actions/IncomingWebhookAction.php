<?php
namespace App\Actions;

use App\Jobs\SendWebhook;
use App\Models\Destination;
use App\Models\Webhook;
use Illuminate\Http\Response;
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
        $response = SendWebhook::dispatch($destination, $payload, $webhook);  
        if (!$response->successful()) {
            $destination->status = 'failed';
            $destination->save();
            return response(['message' => 'Failed to send payload!', 'response' => $response->json()], $response->status());
        } 
         
        $destination->status = 'success';
        $destination->save();
        return response((['message' => 'Payload sent successfully!', 'response' => $webhook->response_content]), $webhook->response_code)
                  ->header('Content-Type', $webhook->response_content_type);
                  
                  
    }
}