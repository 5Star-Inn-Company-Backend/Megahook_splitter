<?php

namespace App\Http\Controllers;

use App\Models\RequestLog;
use Illuminate\Http\Request;

class RequestLogController extends Controller
{
    public function index(){
        return view('request-log.index', [
            'request_logs' => RequestLog::with('user')->get()
        ]);
    }
}
