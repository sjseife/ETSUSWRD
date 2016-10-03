<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class GAAccessMiddleware
{
    /**
     * Handle an incoming request.
     * Rejects if regular User, accepts if GA or Admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            if($request->user()->role == 'GA' || $request->user()->role == 'Admin')
            {
                return $next($request);
            }
            else
            {
                return redirect()->action('HomeController@errorGA');
            }
        }
        catch(\Exception $e)
        {
            return redirect()->guest('login');
        }
    }
}
