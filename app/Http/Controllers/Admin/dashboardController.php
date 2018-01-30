<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Registration;
use Carbon\Carbon;
use DB;
class dashboardController extends Controller
{
    public function showStudentInvit(){
        //$studentsWaiting = Registration::whereState("waiting")->get();
        $studentsWaiting = DB::table("registrations")
                           ->join("users","users.id","=","registrations.student")
                           ->select("users.firstname","users.lastname","registrations.id as registrationId","users.id as userId")
                           ->where("registrations.state","=","waiting")
                           ->where("users.role","=",0)
                           ->get();
        return view("dashboards.admin.invitationsStudent")->with("students",$studentsWaiting);
    }


    public function acceptInvitations(Request $request){
        $registrationId = $request['registrationId']; //id registration
        $userId = $request['userId']; //id user

        $studentFindRegistre = Registration::find($registrationId);
        $studentFindRegistre->state = "accepted";
        if($studentFindRegistre->save()){
            #2: change the state to accepted in user table
            $user = User::find($userId);
            $user->state = "accepted";
            if($user->save()){
                return "done";
            }
                
            else
                return "error";
        }

        return "error";
        
    }



    public function deleteStudent(Request $request){
        $registrationId = $request['registrationId']; //id registration
        $userId = $request['userId']; //id user

        $studentFindRegistre = Registration::find($registrationId);
        $studentFindRegistre->state = "rejected";
        if($studentFindRegistre->save()){
            #2: change the state to accepted in user table
            $user = User::find($userId);
            $user->state = "rejected";
            if($user->save())
                return "done";
            else
                return "error";
        }

        return "error";
    }




    /******* FOR TEACHERS **********/
    public function showTeacherInvit(){
        //$TeachersWaiting = User::whereRole(1)->whereState("waiting")->get();
        $TeachersWaiting = User::where(function($query){
            $query->whereRole('1')->orWhere('role',2);
        })->whereState('waiting')->get();
        return view("dashboards.admin.invitationsTeacher")->with("teachers",$TeachersWaiting);
    }



    public function acceptInvitationsTeacher(Request $request){
        $userId = $request['userId']; //id user

        #2: change the state to accepted in user table
        $user = User::find($userId);
        $user->state = "accepted";
        if($user->save())
            return "done";
        else
            return "error";
        
    }


    public function deleteTeacher(Request $request){
        $userId = $request['userId']; //id user


        $user = User::find($userId);
        $user->state = "rejected";
        if($user->save())
            return "done";
        else
            return "error";


    }
}
