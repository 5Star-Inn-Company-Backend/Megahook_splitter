<?php

namespace App\Http\Controllers;

use App\Actions\IncomingWebhookAction;
use App\Models\Webhook;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IncomingWebhookRequest;



class IncomingWebhookController extends Controller
{

    public function __construct(private readonly IncomingWebhookAction $incomingWebhookAction)
    {}
    public function incoming(Request $request, string $id)
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

        return $this->incomingWebhookAction->execute($validator, $id);
    }
}
