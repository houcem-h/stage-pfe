<?php

namespace App\Http\Middleware;

use Closure;
class RedirectDependingToRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $response=$next($request);
        if(!auth()->user())
                return $response;

            if(auth()->user()->role==0)
                return redirect('student/dashboard');
            else if(auth()->user()->role==1)
                return redirect('teacherhome');
            else
               return redirect()->route('dash');
    }

}
