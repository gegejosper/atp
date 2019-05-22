<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;


class AdminAuth
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
        if(Auth::check()){
            if(Auth::user()->usertype == 'admin'){       
                return $next($request);
            }
            else {
                //return back();
                return redirect('/');
            }
        }
        //return back();
        return redirect('/');
    }
}
