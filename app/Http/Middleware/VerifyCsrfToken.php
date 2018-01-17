<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

   public function tokensMatch($request){
        $token=($request->ajax())?$request->header('X-CSRF-Token'):$request->input('_token');
        return $request->session()->token() == $token;
    }
}
