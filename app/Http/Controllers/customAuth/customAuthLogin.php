<?php

namespace App\Http\Controllers\customAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;
class customAuthLogin extends Controller
{
    function __construct(){
        // $this->middleware('redirectDependingRole');
        // $this->middleware('guest')->except('logout');
        Session::put("t",uniqid().time());

    }
    public function checkEmailExist(Request $request){
        $user = User::whereEmail($request['email'])->get();

        if(count($user) == 1)
            return "true";

        return "false";
    }


    public function checkConnection(Request $request){ 
        //remember password is CIN       
        if(Auth::attempt([
            "email"=>$request['email'], "password"=>$request['password']]) == true){
            $user = User::whereEmail($request['email'])->get()->first();
            if($user->state == "waiting"){
                Auth::logout();
                return "waiting";
            }else if($user->state == "rejected"){
                Auth::logout();
                return "rejected";
            }else{
                return "accepted";
            }
        }else{
            return "login error";
        }

        // $user = User::whereEmail($request['email'])->whereCin($request['password'])->get()->first();
        // if(count($user) == 1){
        //     if($user->state == "waiting"){
        //         return "waiting";
        //     }else if($user->state == "rejected"){
        //         return "rejected";
        //     }else{
        //         Auth::login($user);
        //         return "accepted";
        //     }
        // }else{
        //     return "login error";
        // }

    }
}
