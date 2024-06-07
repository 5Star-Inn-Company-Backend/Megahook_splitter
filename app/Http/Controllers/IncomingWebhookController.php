<?php

namespace App\Http\Controllers;

use App\Models\Webhook;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IncomingWebhookRequest;



class IncomingWebhookController extends Controller
{
    public function incoming(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'reference' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()]);
        }

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

        if ($response->successful()) {
            return response()->json(['message' => 'Payload sent successfully!', 'response' => $response->json()]);
        } else {
            return response()->json(['message' => 'Failed to send payload!', 'response' => $response->json()], $response->status());
        }
    }
}
