<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class TeacherAccessRights
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
      if(auth()->user()->role==1 or auth()->user()->role==2)
        return $next($request);

        return back();
    }
}
