<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $plans = Plan::get();
        $showPricingModal = request()->get('showPricingModal');
        return view('dashboard', compact('showPricingModal','plans'));
    }
}
