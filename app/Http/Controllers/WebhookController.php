<?php

namespace App\Http\Controllers;

use App\Models\Webhook;
use App\Models\WebhookBucket;
use Exception;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(WebhookBucket $webhookBucket)
    {
        $authenticationTypes = Webhook::AUTHENTICATION_TYPES;
        $statusCodes = Webhook::STATUS_CODES;
        return view('buckets.create', compact('webhookBucket', 'authenticationTypes', 'statusCodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $webhookId)
    {

        $data =  $request->validate([
            'input_name' => ['required', 'string'],
            'authentication_type' => ['required', 'string', 'in:' . implode(",", Webhook::AUTHENTICATION_TYPES)],
            'response_code' => ['required', 'string', 'in:' . implode(",", Webhook::STATUS_CODES)],
            'response_content_type' => ['required', 'string'],
            'response_content' => ['required', 'string']
        ]);

        $mergedData = array_merge($data, ['webhook_bucket_id' => $webhookId]);
        if (Webhook::create($mergedData)) {
            return redirect()->route('webhook-buckets.show',$webhookId, 201)->with(['succes' => 'success']);
        }

        return redirect()->route('webhook-buckets.show', $webhookId)->withFailure('Failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(Webhook $webhook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Webhook $webhook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Webhook $webhook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Webhook $webhook)
    {
        //
    }
}
