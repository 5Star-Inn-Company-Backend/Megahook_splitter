<?php

namespace App\Http\Controllers;

use App\Models\RequestLog;
use Illuminate\Http\Request;

class RequestLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $requestLogs = RequestLog::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('bucket', 'like', "%{$search}%");
             })
            ->latest()
            ->paginate(10);
        return view('request-log.index', [
            'request_logs' => $requestLogs
        ]);
    }

    public function show(RequestLog $requestLog)
    {
        return view('request-log.show', [
            'request_log' => $requestLog
        ]);
    }
}
