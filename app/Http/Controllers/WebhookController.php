<?php

namespace App\Http\Controllers;

use App\Enums\Plan;
use App\Http\Requests\WebhookRequest;
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
        $webhooks = Webhook::with('destinations')->where('user_id', auth()->user()->id)->get();
        return view('webhooks_buckets.index', compact('webhooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // $authenticationTypes = Webhook::AUTHENTICATION_TYPES;
        $statusCodes = Webhook::STATUS_CODES;
        return view('buckets.create', compact('statusCodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WebhookRequest $request)
    {
       
        $webhook = Webhook::where('user_id', auth()->id())->count();
        $plan = Plan::from(auth()->user()->plans[0]->name)->createPlan();

        if($webhook > $plan->maxWebhookBucket()){
            session()->flash('failed_message', 'You have exceeded your limit, kindly upgrade your plan to create more buckets!');
            return redirect()->route('webhook-buckets.index');
        }
         
        
        if (auth()->user()->webhooks()->create($request->validated())) {
            session()->flash('success_message', 'You have successfully created a bucket!');
            return redirect()->route('webhook-buckets.index');
            
        }

        return redirect()->route('webhook-buckets.show')->withFailure('Failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(Webhook $webhook)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebhookBucket $webhookBucket, Webhook $webhook)
    {
        $statusCodes = Webhook::STATUS_CODES;
        return view('buckets.edit', compact('webhook', 'webhookBucket', 'statusCodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WebhookRequest $request, Webhook $webhook)
    {
        // $data = $request->validate([
        //     'input_name' => ['required', 'string'],
        //     'authentication_type' => ['required', 'string'],
        //     'response_code' => ['required', 'string'],
        //     'response_content_type' => ['required', 'string'],
        //     'response_content' => ['required', 'string']
        // ], [
        //     'input_name.required' => 'The input name is required.',
        //     'authentication_type.required' => 'The authentication type is required.',
        //     'authentication_type.in' => 'Invalid authentication type.',
        //     'response_code.required' => 'The response code is required.',
        //     'response_code.in' => 'Invalid response code.',
        //     'response_content_type.required' => 'The response content type is required.',
        //     'response_content.required' => 'The response content is required.'
        // ]);

        

        //dd($request->validated());
        if ($webhook->update($request->validated())) {
            return redirect()->route('webhook-buckets.index')->with(['success' => 'Webhook updated successfully.']);
        }

        return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update webhook.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Webhook $webhook)
    {
        $webhook->destinations->each(function ($destination) {
            $destination->delete();
        });


        if ($webhook->delete()) {
            return redirect()->route('webhook-buckets.index')->with(['succes' => 'success']);
        }

        return redirect()->route('webhook-buckets.index')->with(['failure' => 'failed']);;
    }
}
