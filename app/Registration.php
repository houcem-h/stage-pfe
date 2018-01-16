<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Registration extends Model
{
    public function student()
    {
        return $this->belongsTo('App\User','foreign_key');
    }

    public function group()
    {
        return $this->belongsTo('App\Group','foreign_key');
    }

    public function internship()
    {
        return $this->hasMany('App\Internship');
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
      $user_session = Self::where("student",$id_user)->get(['session'])->first();
      return $user_session['session'];
    }

    //group name for that session and user id
    public static function get_group_name($id_user){
        //$group = self::where("student",$id_user)->where("session",self::get_session($id_user))->get(['group'])->first();
        $group = DB::table("registrations")
                ->join("groups","groups.id","=","registrations.group")
                ->select("groups.name")
                ->where("registrations.student","=",$id_user)
                ->where("registrations.session","=",self::get_session($id_user))
                ->get()->first();

      if(!empty($group->name))
          return $group->name;
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
