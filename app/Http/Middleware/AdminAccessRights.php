<?php

namespace App\Http\Middleware;

use Closure;

class AdminAccessRights
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
         // $request->merge(['role'=>auth()->user()->role]); // $request->merge(['role'=>auth()->user()->role]);
        if(auth()->user()->role==2)
          return $next($request);
       
        return back();
    }
}
