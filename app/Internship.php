<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class Internship extends Model
{
    //j ai changé le nom des méthodes(nom_table_relation."Record") a cause de la confusion entre l attribut du modele qui va etre cree apres le chargement des donnees et le nom de la methode qui effectue la relation avec l'autre table
    public function companyFramer()
    {
        return $this->belongsTo('App\Manager','company_framer');
    }

    public function framerRecord()
    {
        return $this->belongsTo('App\User','framer');
    }

    public function registration()
    {
        return $this->belongsTo('App\Registration','student');
    }

    public function defense()
    {
        return $this->hasOne('App\Defense');
    }

        //retourne le createur de l'enregistrement dans la BD (created_by)
    public function adminCreator(){
        return $this->belongsTo('App\User','created_by');
    }

	//retourne le modificateur de l'enregistrement dans la BD (updated_by)
    public function adminUpdator(){
        return $this->belongsTo('App\User','updated_by');
    }

    public function requestsFraming(){
        return $this->hasMany('App\FramingRequest','internship');
    }


    /*********** AMINE BEJAOUI WORK ***********/
    //get all  "internships" of a student (reference by id_student)
    public static function getCurrentInternships($student_id){
        #1:
        $results = DB::table("internships")
                   ->join("users","users.id","=","internships.framer")
                   ->join("managers","managers.id","=","internships.company_framer")
                   ->join("companies","managers.company","=","companies.id")
                   ->join("registrations","registrations.id","=","internships.student")
                   ->join("users as students","students.id","=","registrations.student")
                   ->where("students.id","=",$student_id)
                   ->select("users.firstname","users.lastname","internships.start_date","end_date","managers.name","internships.state","internships.type","companies.name as company_name","internships.id")
                   ->get();
        
        
        $Intern = array();
        foreach($results as  $res){
            $startYearIntern = explode("-",$res->start_date)[0]; 
            if($startYearIntern == Carbon::now()->year)
                array_push($Intern,$res);
        }
        return $Intern;
    }

    //get details for one intership
    public static function getDetails($id_internship){
        $result = DB::table("internships")
                    ->join("users","users.id","=","internships.framer")
                    ->join("managers","managers.id","=","internships.company_framer")
                    ->join("companies","managers.company","=","companies.id")
                    ->where("internships.id","=",$id_internship)
                    ->select("users.firstname","users.lastname","internships.start_date","end_date","managers.name","internships.state","internships.type","companies.name as company_name","internships.id")
                    ->get()->first();

        return $result;
    }
    
    
    //get info defense, of the current year," reference by id
    public static function getInfoDefense($id_internship){
        $myDefenses = DB::table("defenses")
                      ->join("users as reporter","reporter.id","=","defenses.reporter")
                      ->join("users as president","president.id","=","defenses.president")
                      ->join("internships","internships.id","=","defenses.internship")
                      ->where("defenses.internship","=",$id_internship)
                      ->select(
                          "date_d",
                          "start_time",
                          "end_time",
                          "classroom",
                          "reporter.firstname as repo_name",
                          "reporter.lastname as repo_last",
                          "president.firstname as pres_name",
                          "president.lastname as pres_last",
                          "internships.type"

                      )
                      ->get()->first();
        #3 : filter the result of the query to get the defenses of this year, means 2018
        //this methode maybe , it will be changed
        $result = [];
        if(empty($myDefenses))
            return null;
        $current_year = Carbon::now()->year;
        $yearDefense = explode("-",$myDefenses->date_d)[0];
        if($yearDefense == $current_year){
            return $myDefenses;
        }


    }

}
