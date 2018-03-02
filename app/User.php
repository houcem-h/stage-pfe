<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Registration;
use DB;
use Auth;
use App\Traits\CommonTasks;


class User extends Authenticatable
{
    //Trait pour des methodes utiles pour la tache internships management
    use CommonTasks;


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'birthdate', 'cin', 'phone', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPhoneNumberAttribute(){
        return $this->attributes['phone'];
    }

    public function getFaxNumberAttribute(){
        return $this->attributes['fax'];
    }

    public function registrations()
    {
        return $this->hasMany('App\Registration','id');
    }

    public function internships()
    {
        return $this->hasMany('App\Internship');
    }

    public function framingRequests(){
        return $this->hasMany('App\FramingRequest','teacher');
    }


    public static function studentLevel($ch){
        for($i=0;$i<strlen($ch);$i++){
            if(ctype_digit(substr($ch,$i,1)))
              return substr($ch,$i,1);
        }
        return -1;
     }

    public  function getFormattedSessionAttribute(){
         $month=date('m');
         if((int)$month>=9)
            return date('Y').'/'.((int)date('Y')+1);
        return ((int)date('Y')-1).'/'.date('Y');
    }

    public function getBuddyAttribute(){
        $session=$this->getFormattedSessionAttribute();
        $legal=[];
        $legalBuddies=Registration::with('studentRecord')->where('registrations.session','=',$session)->get();
        foreach($legalBuddies->all() as $l){
            if(self::studentLevel($l->groupRecord->name)=='3')
               $legal[$l->student]=$l->studentRecord->firstname.' '.$l->studentRecord->lastname;
        }
        return $legal;
    }

    //Methode(getter) qui retourne la route du dashboard de l'utilisatuer connecté
    public function getDashboardAttribute(){
        if($this->role==1)
          return "/dashboard";
        else if($this->role==2)
          return "/managerteacherdashboard";
        else
          return "/student/dashboard";
    }

    //Methode qui renvoi un tableau contenant les types des internships qu'ils peuvent etres passés par l etudiant
    //Cette Methode est Utile pour le dashboard du l'etudiant
    // Methode qui fait appelle a des methodes du Trait CommonTasks


     public function getLegalIntershipsTypesAttribute(){
        $formattedYear=$this->getFormattedSessionAttribute();
        $registrations=Registration::where('student',auth()->user()->id)->get();
        $internships=[];
        if($registrations!=null)
            foreach($registrations as $r)
                $internships[]=$r->internships->toArray();

        $registration=Registration::where('student',auth()->user()->id)->latest()->first();
        if($registration!=null){
        $stages=$this->arrayOfSimpleArrays($internships);
        $patternInit='/^[a-zA-Z]{2,}1{1}[0-9]+$/';
        $patternPerf='/^[a-zA-Z]{2,}2{1}[0-9]+$/';
        $patternPFE='/^[a-zA-Z]{2,}3{1}[0-9]+$/';
        $LegalInternships=[];
        if($stages==null){
            if($registration!=null){
                if(preg_match($patternInit,$registration->groupRecord->name)){
                        $LegalInternships['init']='init';
                }else if(preg_match($patternPerf,$registration->groupRecord->name)){
                        $LegalInternships['perf']='perf';
                        $LegalInternships['init']='init';
                }else{
                        $LegalInternships['perf']='perf';
                        $LegalInternships['init']='init';
                        $LegalInternships['pfe']='pfe';
                }
            }
        }else{
            if($registration!=null){
                if(preg_match($patternInit,$registration->groupRecord->name)){
                    if($this->DoesHaveThisInternshipToPass('init',$stages))
                         $LegalInternships['init']='init';
                }else if(preg_match($patternPerf,$registration->groupRecord->name)){
                    if($this->DoesHaveThisInternshipToPass('init',$stages))
                         $LegalInternships['init']='init';
                    if($this->DoesHaveThisInternshipToPass('perf',$stages))
                         $LegalInternships['perf']='perf';
                }else{
                    if($this->DoesHaveThisInternshipToPass('init',$stages))
                          $LegalInternships['init']='init';
                    if($this->DoesHaveThisInternshipToPass('perf',$stages))
                          $LegalInternships['perf']='perf';
                    if($this->DoesHaveThisInternshipToPass('pfe',$stages))
                          $LegalInternships['pfe']='pfe';
                }
            }
        }
         return $LegalInternships;
        }
        return ["null"=>"vous n'avez pas une inscription"];
    }

    public function getLegalInternshipsToUpdateAttribute(){
         $registrationlist=Registration::where('student',auth()->user()->id)->get()->toArray();
         $tabInternships=[];
            if(count($registrationlist) ==0)
              $lastregistration=null;
            else
              $lastregistration=$registrationlist[count($registrationlist)-1];
         if($lastregistration!=null){
                $internships=Internship::where('student',$lastregistration['id'])->get();
                 foreach ($internships as $internship) {
                     if($internship->state=='waiting')
                         $tabInternships[]=$internship;
                 }
                 return $tabInternships;
         }
             return null;
    }

    //Methode qui permet de rechercher un utilisateur par son nom - prenom - email - cin - phone
    //Cette Methode est Utile pour le dashboard Admin

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("firstname", "LIKE","%$keyword%")
                    ->orWhere("lastname", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("cin", "LIKE", "%$keyword%")
                    ->orWhere("phone", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }


    /************AMINE BEJAOUI WORK ****************/
    public function tryToConnect($password){
      if(Auth::attempt(["email"=>$this->email, "password"=>$password]))
            return true;
    }

    public function getFirstNameAttribute(){
      return $this->attributes['firstname'] = ucfirst($this->attributes['firstname']);
    }

    public function getLastNameAttribute(){
      return $this->attributes['lastname'] = ucfirst($this->attributes['lastname']);
    }


}
