<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class VerifyPreviousLocation
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
       if(auth()->user()->role==0){
            if(Session::has('t') &&  $request->get('t')==Session::get('t'))
                return $next($request);
            else 
                return back();
         }
        return $next($request);
    }
}
