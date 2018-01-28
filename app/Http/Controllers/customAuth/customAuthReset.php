<?php

namespace App\Http\Controllers\customAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Session;
use App\User;
use App\Mail\ResetPassword;
class customAuthReset extends Controller
{
    public function sendCode(Request $request){
        $email = $request['email'];
        $code = uniqid();
        $generetToken = str_random(10)."-".$code."-".$request['email'];
        //send email
        Mail::to($email)->send(new ResetPassword($code));
        $request->session()->put('p', $request['password']);
        return redirect("/confirm?token=".$generetToken);
    }

    public function StoreNewPassword(Request $request){
        $passReset = Session::get("p");
        $email = $request['email'];
        $user = User::whereEmail($email)->get()->first();
        $user->password = bcrypt($passReset);

        if($user->save()){
            return "done";
        }
        return "error";
    }
}
