<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\WebhookBucket;

class WebhookBucketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $webhookBuckets = WebhookBucket::where('user_id', auth()->user()->id)->get();
            return view('webhooks_buckets.index', compact('webhookBuckets'));
        } catch (\Exception $e) {
           return redirect()->back()->with('error', $e->getMessage());
        }
        
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
         $user = new User();
        if ($user->WebhookBuckets()->create($data)) {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebhookBucket $webhookBucket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebhookBucket $webhookBucket)
    {
        //
    }
}
