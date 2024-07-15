<?php

namespace App\Http\Middleware;
use App\Models\Webhook;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $endpoint = request()->route()->parameters()['id'];
        $webhook = Webhook::where('endpoint', $endpoint)->first();
        //dd($request->header('Authorization'));
        if($request->header('Authorization')){
            if ($webhook->authentication_type === Webhook::TOKEN) {
                if ($webhook->token_value !== $request->header('Authorization')) {
                    return response(['Unauthenticated' => 'You are not authenticated'], 401);
                }
                return $next($request);
            }  
        }
        if($request->header('Authorization')){
            if ($webhook->authentication_type === Webhook::BASIC) {
                if (
                    !hash_equals($webhook->username, $request->header('php-auth-user')) ||
                    !hash_equals($request->header('php-auth-pw'), $webhook->password)
                )
                {
                    return response(['Unauthenticated' => 'You are not authenticated'], 401);
                }            
                return $next($request);  
         } 
    }

        // if ($webhook->authentication_type === 'basic') {
        //     if (
        //         !hash_equals($webhook->username, $request->header('php-auth-user')) ||
        //         !hash_equals($request->header('php-auth-pw'), $webhook->password)
        //     )
        //     {
        //         return response(['Unauthenticated' => 'You are not authenticated'], 401);
        //     }            
        //     return $next($request);
        // } 

        if($request->header('Authorization') === null){
            if ($webhook->authentication_type === Webhook::NO_AUTH) {          
                return $next($request);
            } 
            else{
                return response(['Unauthenticated' => 'You need to be authenticated'], 401);
            }
        }
        return response(['Unauthenticated' => 'You need to be authenticated'], 401);


        //return $next($request);
    }
}
