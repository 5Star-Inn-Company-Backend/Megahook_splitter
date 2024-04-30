<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Plan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->latestPlan() && $request->user()->latestPlan()->pivot->status == Plan::ACTIVE ) {
            return $next($request);
        }

        $showPricingModal = true;
        $request->merge(['showPricingModal' => $showPricingModal]);
        return $next($request);
    }
}
