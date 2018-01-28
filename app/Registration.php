<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Registration extends Model
{
    public function studentRecord()
    {
        return $this->belongsTo('App\User','student');
    }

    public function groupRecord()
    {
        return $this->belongsTo('App\Group','group');
    }

    public function internships()
    {
        return $this->hasMany('App\Internship','student');
    }




    /********************************* AMINE BEJAOUI WORK *********************************/

    //return true if user has groups, means exist in registration table
      public static function hasGroup($id_user){
        if(self::where("student",$id_user)->count() == 0)
            return false;

        return true;
      }
    //get the current year of session, means 2018/2019 ==> 2018
    public static function get_year_session($id_user){
      $user_session = Self::where("student",$id_user)->get(['session'])->first();
      $year = explode("/",$user_session['session'])[0];
      return $year;
    }

    //get session
    public static function get_session($id_user){
      $user_session = Self::where("student",$id_user)->get(['session']); // return an object
      foreach($user_session as $s){
          if(Carbon::now()->year -1 == $s['session'])
            return $s['session'];
      }

      return false;
      
    }

    //group name for that session and user id
    public static function get_group_name($id_user){
        //$group = self::where("student",$id_user)->where("session",self::get_session($id_user))->get(['group'])->first();
        if(self::get_session($id_user) != false){
            $group = DB::table("registrations")
                ->join("groups","groups.id","=","registrations.group")
                ->select("groups.name")
                ->where("registrations.student","=",$id_user)
                ->where("registrations.session","=",self::get_session($id_user))
                ->get()->first();
                return $group->name;
        }
         return false;
    }

    //get valid group name choice, means if ancian group of a user is TI11, so the choice are TI15,TI14
    //all availble group name with prefix TI
    public static function getAllGroupOptions($id_user){
      $group_name = self::get_group_name($id_user);
      $chaine = substr($group_name,0,strlen($group_name)-2); //DSI or TI (exemple)
      $all_choices = Group::where("name","like","%$chaine%")->distinct()->get(['name']);
      return ($all_choices);
    }
}
