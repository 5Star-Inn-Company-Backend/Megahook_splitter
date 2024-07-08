<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return view('plans.index', [
            'plans' => Plan::all()
        ]); 
    } 

}