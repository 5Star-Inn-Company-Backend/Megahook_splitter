<?php

namespace App\Http\Controllers;

use App\Models\WebhookBucket;
use Illuminate\Http\Request;

class WebhookBucketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $webhookBuckets = WebhookBucket::where('user_id',auth()->user()->id)->get();
        return view('webhooks_buckets.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WebhookBucket $webhookBucket)
    {
        //
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
