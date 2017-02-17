<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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
        if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return $next($request);
        }
        elseif(Auth::check())
        {
            return redirect('/dashboard')->with('error','Your account has insufficient permissions to access this page. If you believe this is an error, please let us know!');
        }
        else{
            return redirect('/login');
        }

    }
}
