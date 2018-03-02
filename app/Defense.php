<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Defense extends Model
{
    public function internships()
    {
        return $this->belongsTo('App\Internship','internship');
    }

    public function minute()
    {
        return $this->hasOne('App\Minute');
    }


     //get info defense, of the current year," reference by id
     public static function getInfoDefense($id_internship){
        $myDefenses = DB::table("defenses")
            ->join("internships","internships.id","=","defenses.internship")
            ->join("registrations","registrations.id","=","internships.student")
            ->join("users as reporter","reporter.id","=","defenses.reporter")
            ->join("users as president","president.id","=","defenses.president")
            ->join("users as framer","framer.id","=","internships.framer")
            ->join("managers","managers.id","=","internships.company_framer")
            ->join("companies","companies.id","=","managers.company")
            ->where("internships.id","=",$id_internship)
            ->select(
                "defenses.id as id_defense",
                "date_d",
                "start_time",
                "end_time",
                "classroom",
                "reporter.firstname as repo_name",
                "reporter.lastname as repo_last",
                "president.firstname as pres_name",
                "president.lastname as pres_last",
                "start_date",
                "end_date",
                "type",
                "framer.firstname as framer_firstname",
                "framer.lastname as framer_lastname",
                "managers.name  as manager_name",
                "companies.name as company_name"
            )
            ->get()->first();
        #3 : filter the result of the query to get the defenses of this year, means 2018
        //this methode maybe , it will be changed
        // $result = [];
        // if(empty($myDefenses))
        //     return null;
        // $current_year = Carbon::now()->year;
        // $yearDefense = explode("-",$myDefenses->date_d)[0];
        // if($yearDefense == $current_year){
        //     return $myDefenses;
        // }
            
        return array($myDefenses);
    }
}
