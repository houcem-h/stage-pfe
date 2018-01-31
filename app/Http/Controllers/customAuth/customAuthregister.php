<?php

namespace App\Http\Controllers\customAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Group;
use App\Registration;
use Carbon\Carbon;
use Mail;
use App\Jobs\sendLoginToStudent;
class customAuthregister extends Controller
{
    /*****SOME TESTS FOR AJAX HERE */
    public function checkEmailExist(Request $request){
        $email = User::whereEmail($request['email'])->get();
        if(count($email) == 0){
            return "done";
        }

        return "false";
    }

    public function checkCinExist(Request $request){
        $cin = User::whereCin($request['cin'])->get();
        if(count($cin) == 0){
            return "done";
        }

        return "false";
    }




    //register now student
    public function registerStudent(Request $request){
       #1: add student to user table 
       $newUser = new User();
       $newUser->firstname = $request['nom'];
       $newUser->lastname = $request['prenom'];
       $newUser->email = $request['email'];
       $newUser->password = bcrypt($request['cin']);
       $newUser->birthdate = $request['dob'];
       $newUser->cin = $request['cin'];
       $newUser->phone = $request['tel'];
       $newUser->role = $request['role'];
        
       if($newUser->save()){
            #2: add student to registration table with state "waiting"
            $user = User::whereEmail($request['email'])->get()->first();
            $registre = new Registration();
            $registre->student = $user->id;
            $registre->group = $request['classe'];
            $registre->state = "waiting";
            $registre->session = strval(Carbon::now()->year)."/".strval(Carbon::now()->year+1);

            if($registre->save()){
                $jobWelcome = (new sendLoginToStudent($user))->delay(Carbon::now()->addSeconds(10));
                dispatch($jobWelcome);
                return "done";
            }else{
                return "error";
            }
       }
       return "error";
    }


    //register now teacher
    public function registersTeacher(Request $request){
       $newUser = new User();
       $newUser->firstname = $request['nom'];
       $newUser->lastname = $request['prenom'];
       $newUser->email = $request['email'];
       $newUser->password = bcrypt($request['password']);
       $newUser->phone = $request['tel'];
       $newUser->role = $request['role'];

       if($newUser->save()){
        // $jobWelcome = (new sendLoginToStudent($newUser))->delay(Carbon::now()->addSeconds(10));
        // dispatch($jobWelcome);
           return "done";
       }
       return "error";
    }

    


}
