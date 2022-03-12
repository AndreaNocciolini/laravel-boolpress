<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if ($request->header('Authorization') != 'Bearer ' . config('app.apiKey')) {
            return response()->json([
                'success' => false,
                'error' => 'Authorization failed'
            ]);
        }
        
        return $next($request);
    }
}
