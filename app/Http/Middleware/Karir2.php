<?php

namespace App\Http\Middleware;

use Closure;

class Karir2
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
        if(auth()->check())
            return $next($request);
        else
            return redirect('/')->with('error', 'Anda tidak mempunyai akses ke halaman ini');
        // if(auth()->check() && (auth()->user()->user_role == 2 || auth()->user()->user_role == 0))
        //     return $next($request);
        // else
        //     return redirect('/')->with('error', 'Anda tidak mempunyai akses ke halaman ini');
    }
}
