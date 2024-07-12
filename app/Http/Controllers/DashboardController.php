<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Plan;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $showPricingModal = request()->get('showPricingModal');
        $destination = Destination::whereHas('webhook.user', function ($query) {
            $query->where('id', auth()->user()->id);
        })->count();
        $query = auth()->user()->webhooks()->get();
        $webhooks = $query->count();
        $status2xx = $query->filter(function ($item) {
            return Str::startsWith($item['response_code'], '2');
        })->count();

        $status4xx = $query->filter(function ($item) {
            return Str::startsWith($item['response_code'], '4');
        })->count();

        $status5xx = $query->filter(function ($item) {
            return Str::startsWith($item['response_code'], '5');
        })->count();
             
        return view('dashboard', compact('showPricingModal', 'destination', 'webhooks', 'status2xx', 'status4xx', 'status5xx' ));
    }
}
