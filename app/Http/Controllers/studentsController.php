<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Registration;
use App\Group;
use Session;
use Carbon\Carbon;
class studentsController extends Controller
{
    //show list of all students
    public function show_students(){
        $all_students = User::where("role",0)->simplePaginate(6);

        return view("student.student")->with("students",$all_students);
    }

    //return the student that has a group
    public function check_groupName(Request $request){
        //get all the group name from registration table
        $students = DB::table("registrations")
                        ->join("groups","registrations.group","=","groups.id")
                        ->join("users","registrations.student","=","users.id")
                        ->select("registrations.student")
                        ->where("users.role","=",0)
                        ->get();

        return  json_encode($students);

    }

    // return the groups of a student
    public function get_groupName(Request $request){
        $group = DB::table("registrations")
                ->join('users',"users.id","=","registrations.student")
                ->join("groups","groups.id","=","registrations.group")
                ->where("users.id","=",$request['id_student'])
                ->select("registrations.session","users.firstname","groups.name")
                ->get();
        return json_encode($group);
    }



    //return the form update view
    public function show_update($id_student){
      $student = User::find($id_student);

      //student has group
      $hasGroup = Registration::hasGroup($id_student);
      //get Session
      $session = Registration::get_session($id_student);
      //get group name
      $group_name = Registration::get_group_name($id_student);
      //get all group choice
      $groups_choice = Registration::getAllGroupOptions($id_student);

      //// the part "group edit" should be availble before February
      $Current_month = Carbon::now();

      return view("student.update")->with([
        "student" => $student,
        "hasGroup" => $hasGroup,
        "session" => $session,
        "group_name" => $group_name,
        "groups_choice" => $groups_choice
      ]);
    }


    //save update
    public function save_updates(Request $request,$id_student){
      $this->validate($request, [
                'name' =>"required|String",
                'last_name'=>"required|string",
                'email' => 'required|string|email|max:255',
                "cin" => "required|digits:8",
                "phone" => "required|string",
                "dob" => 'required|date'
            ]
        );

      $student = User::find($id_student);
      $student->firstname = $request->input("name");
      $student->lastname = $request->input("last_name");
      $student->email = $request->input("email");
      $student->cin = $request->input("cin");
      $student->birthdate = $request->input("dob");
      $student->phone = $request->input("phone");
      $student->save();

      Session::flash("success_update","success");
      return redirect()->back();

    }

    //delete student
    public function delete_student(Request $request){
        $id_student = $request['id_student'];
        User::find(2)->delete();
        //return "done";
    }

    //save group save_updated_group
    public function save_updated_group(Request $request){
         //get group id to that group name
         $group_id = Group::where("name",$request['groupe_name'])->get(['id'])->first();
         if($group_id){
           //search the student who was affected to that group id and in a session
           $s = Registration::where("student",$request['id_student'])->where("session",$request['session'])->get()->first();
           $s->group = $group_id['id'];
           $s->save();
           return "done";
         }

         return "error";

    }
}
