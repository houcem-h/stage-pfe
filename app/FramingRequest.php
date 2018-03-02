<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;


class FramingRequest extends Model
{
    public function internshipRecord(){
        return $this->belongsTo('App\Internship','internship');
    }

    public function teacherRecord(){
        return $this->belongsTo('App\User','teacher');
    }

    public function adminCreator(){
        return $this->belongsTo('App\User','created_by');
    }

    public function adminUpdator(){
        return $this->belongsTo('App\User','updated_by');
    }



    //get notifications
    public static function getNotificationsForToast(){
        $myNotif = DB::table("framing_requests")
                   ->join("internships","internships.id","=","framing_requests.internship")
                   ->join("registrations","registrations.id","=","internships.student")
                   ->join("users as student","student.id","=","registrations.student")
                   ->join("users as teacher","teacher.id","=","framing_requests.teacher")
                   ->where("student.id","=",auth()->user()->id)
                   ->where("status","=","accepeted")
                   ->where("seen","=","false")
                   ->where("request_type","=","wish")
                   ->select(
                        "teacher.firstname",
                        "teacher.lastname",
                        "internships.type",
                        "framing_requests.id",
                        "framing_requests.internship",
                        "framing_requests.teacher",
                        "framing_requests.id"
                    )
                   ->get();
        return $myNotif;
    }

    public static  function getNotificationsForBlade(){
      $myNotif = DB::table("framing_requests")
                 ->join("internships","internships.id","=","framing_requests.internship")
                 ->join("registrations","registrations.id","=","internships.student")
                 ->join("users as student","student.id","=","registrations.student")
                 ->join("users as teacher","teacher.id","=","framing_requests.teacher")
                 ->where("student.id","=",auth()->user()->id)
                 ->where("status","=","accepeted")
                 ->where("request_type","=","wish")
                 ->select(
                      "teacher.firstname",
                      "teacher.lastname",
                      "internships.type",
                      "framing_requests.id",
                      "framing_requests.internship",
                      "framing_requests.teacher",
                      "framing_requests.id",
                      "framing_requests.created_at"
                  )
                 ->get();
      return $myNotif;
    }
}
