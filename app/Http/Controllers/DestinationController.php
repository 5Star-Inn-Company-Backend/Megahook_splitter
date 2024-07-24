<?php

namespace App\Http\Controllers;

use App\Enums\Plan;
use App\Models\Destination;
use App\Models\Webhook;
use Illuminate\Http\Request;

class DestinationController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $webhookId)
    {
         
        $data =  $request->validate(
            [
                'destination_name' => ['required', 'string'],
                'endpoint_url' => ['required', 'string'],
                'retry_policy' => ['required', 'string'],
                'authentication_type' => ['required', 'string'],
                'alert_on_failure' => ['nullable', 'string'],
            ]
        );

        $destination = Destination::whereHas('webhook.user', function ($query) {
            $query->where('id', auth()->id());
        })->count();
        $plan = Plan::from(auth()->user()->plans[0]->name)->createPlan();


        if($destination > $plan->maxDestinations()){
            return;
        }
        if (Destination::create(array_merge($data, ['webhook_id' => $webhookId]))) {
            return response()->json(['message' => 'success', 'status' => true]);
        };

        return response()->json(['message' => 'failed', 'status' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $destinationId)
    {
        $data =  $request->validate(
            [
                'destination_name' => ['required', 'string'],
                'endpoint_url' => ['required', 'string'],
                'retry_policy' => ['required', 'string'],
                'authentication_type' => ['required', 'string'],
                'alert_on_failure' => ['nullable', 'string'],
            ]
        );

        $destination = Destination::findOrFail($destinationId);

        if ($destination->update($data)) {
            return response()->json(['message' => 'success', 'status' => true]);
        };

        return response()->json(['message' => 'failed', 'status' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        if($destination->delete()){
            return redirect()->back()->with(['succes' => 'success']);
        }
        return redirect()->back()->with(['failure' => 'failed']);
    }
}
