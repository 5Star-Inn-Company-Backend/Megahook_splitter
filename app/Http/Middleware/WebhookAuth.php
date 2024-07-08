<?php

namespace App\Http\Middleware;

use App\Http\Requests\IncomingWebhookRequest;
use App\Models\Webhook;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPSTORM_META\map;

class WebhookAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedTypes = ['hmac', 'basic', 'token'];

        $webhook = Webhook::where('endpoint', 'WXCaDbh9gXY6zcBQ')->first();
        if (!$webhook) {
            return response(['message' => 'Message not received!'], 404);
        }

        

        $authType = 'token';
        dd($request->header('Authorization'));

        if (!in_array($authType, $allowedTypes)) {
            return response()->json(['error' => 'Invalid authentication type'], 401);
        }

        if ($authType === 'token') {
            // if ($request->input('token') !== 'my-secret-token') {
            //     return redirect('home');
            // }
            dd('token');
        } elseif ($authType === 'basic') {
            dd('basic');
        } elseif ($authType === 'hmac') {
            dd('hmac');
        }
    
    


        return $next($request);
    }
}
