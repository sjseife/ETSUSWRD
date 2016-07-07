<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
            if($request->user()->role == 'Admin')
            {
                return $next($request);
            }
            else
            {
                return response('Unauthorized! Please contact an Admin to access this page.', 401);
            }
        }
        catch(\Exception $e)
        {
            return redirect()->guest('login');
        }
    }
}
