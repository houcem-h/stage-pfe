<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\Registration;
class groupsController extends Controller
{
    //show the blade
    public function index(){
        $groups = Group::orderBy("id")->simplePaginate(6);
        return view("groupe.groupe")->with('groups',$groups);
    }

    //show form update
    public function showFormUpdate($id_group){
      $groups = Group::where("id",$id_group)->get(["id","name","stream"])->first();
      $stream = Group::getListStream($id_group);
      return view("groupe.update")->with(['group'=> $groups,"stream"=>$stream]);
    }

    //show form delete
    public function showFormDelete($id_group){
      $group = Group::find($id_group);
      return view("groupe.delete")->with('group', $group);
    }

    //show form add
    public function showFormAdd(){
      return view("groupe.add");
    }

    //back to groups
    public function back(){
        return redirect("group");
    }

    //save updated group
    public function saveUpdateGroup(Request $request){
      $name = $request['name'];
      $stream = $request['stream'];
      $id_group = $request['id_group'];
      $group = Group::find($id_group);
      $group['name'] = $name;
      $group['stream'] = $stream;
      $group->save();
      return "true";



    }

    // //save deleted group
    // public function saveDeleteGroup(Request $request,$id_group){
    //   $check_groups = Registration::where("group",$id_group)->count();
    //   if($check_groups == 0){
    //     $group_del = Group::find($id_group)->delete();
    //   }else{
    //     // do some ajax alert
    //   }

    //   return redirect("group");
    // }

    //add group
    public function add_group(Request $request){
        $name = $request['name'];
        $stream = $request['stream'];
        $new_group = new Group();
        $new_group->name = $name;
        $new_group->stream = $stream;
        $new_group->save();

        return "done";
    }

    //check if the group exist in Registration table , if doesn't so we can delete it
    public function check_group(Request $request){
      $id_group = $request['id_group'];
      $result = Registration::where("group",$id_group)->count();
      if($result == 0){
        Group::find($id_group)->delete();
        return "done";
      }

      return "error";
    }

    //get all sudents
    public function get_students(Request $request){
      $id_group = $request['id_group'];
      //$all_students = Registration::where("group",$id_group)->get();
      $all = DB::table("Registrations")
              ->join("groups","groups.id","=","Registrations.group")
              ->join("users","users.id","=","Registrations.student")
              ->select("groups.name","users.firstname","users.lastname","Registrations.created_at")
              ->where("Registrations.group","=",$id_group)
              ->get();
      return ($all);
    }

}
