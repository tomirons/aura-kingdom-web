<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsStaff
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
        if ( !Auth::user()->hasRole( 'admin' ) && !Auth::user()->hasRole( 'mod' ) )
        {
            return redirect( '/' );
        }
        return $next($request);
    }
}
