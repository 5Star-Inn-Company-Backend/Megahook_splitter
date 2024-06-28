<?php
namespace App\Actions;
 
use App\Models\Destination;
use App\Models\Webhook;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Validator;

class IncomingWebhookAction
{
    public function execute(Validator $validator, string $id): JsonResponse
    {
        $payload = $validator->validated();

        $webhook = Webhook::where('endpoint', $id)->first();
        if (!$webhook) {
            return response()->json(['message' => 'Message not received!'], 404);
        }

        $destination = Destination::where('webhook_id', $webhook->id)->first();
        if (!$destination) {
            return response()->json(['message' => 'Destination endpoint not found!'], 404);
        }

        $response = Http::post($destination->endpoint_url, $payload);
         
        if (!$response->successful()) {
            return response()->json(['message' => 'Failed to send payload!', 'response' => $response->json()], $response->status());
        } 
         

        return response()->json(['message' => 'Payload sent successfully!', 'response' => $response->json()]);


        
    }
}