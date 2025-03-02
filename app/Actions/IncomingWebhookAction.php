<?php

namespace App\Actions;

use App\Jobs\SendWebhook;
use App\Models\Destination;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IncomingWebhookAction
{
    public function execute(Request $request, string $id): Response
    {
        $payload = $request->toArray();

        $webhook = Webhook::where('endpoint', $id)->first();
        if (!$webhook) {
            return response(['message' => 'Webhook not found!'], 404);
        }

        $destinations = Destination::where('webhook_id', $webhook->id)->get();
        if ($destinations->isEmpty()) {
            return response(['message' => 'Destination endpoint not found!'], 404);
        }

        foreach ($destinations as $destination) {
            SendWebhook::dispatch($destination, $payload, $webhook);
        }

        if ($webhook->response_content_type === 'text/plain') {
            return response($webhook->response_content, $webhook->response_code)
                ->header('Content-Type', $webhook->response_content_type);
        }

        return response(['message' => 'Payload sent successfully!', 'response' => $webhook->response_content], $webhook->response_code)
            ->header('Content-Type', $webhook->response_content_type);
    }
}