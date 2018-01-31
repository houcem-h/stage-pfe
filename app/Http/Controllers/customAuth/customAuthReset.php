<?php

namespace App\Http\Controllers\customAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use Carbon\Carbon;
use App\Jobs\sendResetPasswordJob;
class customAuthReset extends Controller
{
    public function sendCode(Request $request){
        $email = $request['email'];
        $code = uniqid();
        $generetToken = str_random(10)."-".$code."-".$request['email'];
        $newJob = (new sendResetPasswordJob($email,$code))->delay(Carbon::now()->addSeconds(10));
        dispatch($newJob);
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
