<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestLogController extends Controller
{
    public function index(){
        return view('request-log.index');
    }
}
