<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Request;
use Closure;
use Auth;
use Session;

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
        if(Auth::check()){
            if(Session::has("t") && Session::get('t') == $request->get('t')){
                return $next($request);
            }

            return redirect()->back();
        }
        
    }
}
