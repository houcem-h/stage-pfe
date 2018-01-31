<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\Registration;
class groupsController extends Controller
{
    public function __construct(){
        $this->middleware("StudentPermission")->except("group","Show_blade_update","show_blade_add");
    }


    //show the blade
    public function index(){
        $groups = Group::orderBy("id")->get();
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
      $group['updated_by'] = auth()->user()->id;
      $group->save();
      return "true";



    }


    //add group
    public function add_group(Request $request){
        $name = $request['name'];
        $stream = $request['stream'];
        $new_group = new Group();
        $new_group->name = $name;
        $new_group->stream = $stream;
        $new_group->created_by = auth()->user()->id;
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
