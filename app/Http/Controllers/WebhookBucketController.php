<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\RequestLog;
use App\Models\Webhook;
use Illuminate\Http\Request;
use App\Models\WebhookBucket;

class WebhookBucketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $webhooks = Webhook::with('destinations')
        ->where('user_id', auth()->user()->id)
        ->get();
    
    $requestLog = RequestLog::where('user_id', auth()->user()->id)
        ->where('status', 'success')
        ->whereIn('bucket', $webhooks->pluck('input_name')->toArray())
        ->whereIn('destination', $webhooks->pluck('destinations.*.destination_name')->flatten()->toArray())
        ->get();
    
    $successResponseCode = $requestLog->count();
    $failedResponseCode = Webhook::where('user_id', auth()->user()->id)
        ->with(['destinations' => function ($query) {
            $query->where('status', '!=', 'success'); 
        }])
        ->get()
        ->pluck('destinations')
        ->flatten()
        ->count();
    
    return view('webhooks_buckets.index', compact('webhooks', 'successResponseCode', 'failedResponseCode'));  
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string']]);

        if (auth()->user()->WebhookBuckets()->create($data)) {
            return response()->json(['message' => 'success', 'status' => true]);
        };

        return response()->json(['message' => 'failed', 'status' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(WebhookBucket $webhookBucket)
    {
        return view('webhooks_buckets.show', compact('webhookBucket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebhookBucket $webhookBucket)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebhookBucket $webhookBucket)
    {
        $data = $request->validate(['name' => ['required', 'string']]);

        if ($webhookBucket->update($data)) {
            return response()->json(['message' => 'success', 'status' => true]);
        };

        return response()->json(['message' => 'failed', 'status' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebhookBucket $webhookBucket)
    {
        if ($webhookBucket->webhooks) {
            $webhookBucket->webhooks->each(function ($webhook) {
                $webhook->destinations->each(function ($destination) {
                    $destination->delete();
                });
                $webhook->delete();
            });
        }

        if ($webhookBucket->delete()) {
            return redirect()->route('webhook-buckets.index')->with(['succes' => 'success']);
        }

        return redirect()->route('webhook-buckets.index')->with(['failure' => 'failed']);;
    }
}
