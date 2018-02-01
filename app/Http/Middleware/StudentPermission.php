<?php

namespace App\Http\Middleware;

use Closure;

class StudentPermission
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
        if(auth()->user()->role == 0)
            return redirect()->route('dashboard_student');
            
        return $next($request);
    }
}
