<?php

namespace App\Http\Middleware;

use Closure;

class RolesMiddleware
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
            if($request->user()->role->roles == '1')
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
