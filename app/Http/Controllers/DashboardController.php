<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $showPricingModal = request()->get('showPricingModal');
        $destination = Webhook::with('destination')->where('user_id', auth()->id())->count();
        $query = auth()->user()->webhooks();
        $webhooks = $query->count();
        $successResponse = $query
        ->where('response_code', Str::start(Webhook::STATUS_CODES['200'], '200'))->count();
       // 
        $failureResponse = Webhook::with('destination')
        ->where('user_id', auth()->id())
        ->where('response_code', Str::start(Webhook::STATUS_CODES['500'], '500'))->count();
         
        $secondFailureResponse = Webhook::with('destination')
        ->where('user_id', auth()->id())
        ->where('response_code', Str::start(Webhook::STATUS_CODES['400'], '400'))->count();
        
         
        return view('dashboard', compact('showPricingModal', 'destination', 'webhooks', 'successResponse', 'failureResponse', 'secondFailureResponse' ));
    }
}
