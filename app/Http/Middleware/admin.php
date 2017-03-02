<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
            $request->session()->flash('alert-danger', "Your account has insufficient permissions to access this page. If you believe this is an error, please let us know!");
            return redirect('/');
        }
        else{
            return redirect('/login');
        }

    }
}
