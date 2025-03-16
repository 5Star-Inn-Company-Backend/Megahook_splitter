<?php

namespace App\Http\Controllers;

use App\Models\RequestLog;
use Illuminate\Http\Request;

class RequestLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $request_logs = RequestLog::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('bucket', 'like', "%{$search}%");
             })
            ->get();
    
        return view('request-log.index', [
            'request_logs' => $request_logs,
        ]);
    }

    public function show(RequestLog $requestLog)
    {
        return view('request-log.show', [
            'request_log' => $requestLog 
        ]);
    }
}
