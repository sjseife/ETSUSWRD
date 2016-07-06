<?php

namespace App\Http\Middleware;

use Closure;

class GAMiddleware
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
        try
        {
            if($request->user()->role == 'GA' || $request->user()->role == 'Admin')
            {
                return $next($request);
            }
            else
            {
                return response('Unauthorized! Please contact a GA or Admin to access this page.', 401);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->guest('login');
        }
    }
}
