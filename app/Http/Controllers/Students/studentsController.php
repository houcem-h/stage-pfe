<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rules\check_code_email;
use App\User;
use App\Registration;
use App\Internship;
use App\FramingRequest;
use App\Minute;
use Session;
use Mail;
use Auth;
use App\Mail\edit_email;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DB;
class studentsController extends Controller
{
    public function __construct(){
        $this->middleware("AdminPermission")->except(
            "edit_profile",
            "edit_email",
            "edit_password",
            "show_newEmail_form",
            "dashboard_student",
            "demande_stage",
            "notifications",
            "showAllTeachers"

            
        );
        $this->middleware("VerifyPreviousLocation")->only("demande");
    }


    //show dashboard
    public function show_dashboard(){
        //display the activity table
        $check_result = Internship::getCurrentInternships(auth()->user()->id);
        
        //if state is accepted, we should load the defense calender for that student
        $defense = $this->getDefenses($check_result);
        
        if(count($defense) == 0 && $this->getState($check_result) == true)
            $defense = "no soutenance";

        // return $defense;
        return view("For_students/dashboard")->with([
            "check_demandes" => $check_result,
            "defense" => $defense 
        ]); 
    }


    //show edit profile form
    public function show_edit_profile(){
        $user_id = auth()->user()->id;
        $student = User::find($user_id);
        return view("For_students/edit_profile")->with("informations",$student);
    }

    //show edit email form
    public function show_edit_email(){
      $user_id = auth()->user()->id;
      $student = User::find($user_id);
      return view("For_students/edit-email")->with("email",$student->email);
    }
    // show edit password form
    public function show_edit_password(){
      return view("For_students/edit_password");
    }

    //show new email form
    public function show_newEmail_form(){
      return view("For_students/newEmailSet");
    }

    //show student information
    public function display_informations(){
        //student informations
        $student = auth()->user();
        //check if he has a group in current session
        $group = Registration::get_group_name($student->id);
        $group_found=false;
        $session="";
        if($group != false){
            $group_found = true;
            $session = Registration::get_session($student->id);
        }
        return view("For_students/show_student_information")->with([
            "student"=>$student,
            "group_found" => $group_found,
            "group" => $group,
            "session" => $session
        ]);
    }

    //show form "demande internship"
    public function demande(){

        return view("For_students/demandeStage");
    }

    //show students news
    public function show_news(){
        return view("For_students/nouveaute");
    }

    //show student's intership details
    public function show_internship_details($id_internship){
        $result = Internship::getDetails($id_internship);
        return view('For_students/internship_details')->with("details",$result);
    }

    //show all teachers
    public function display_teacher(){
        $teachers = User::where(function($query){
            $query->whereRole(1)->orwhere("role","=",2);
        })->get();

        return view("For_students/AllTeachers")->with("teachers",$teachers);
    }

    
    // get Notifications
    public function Notifications(){
        $student_id = auth()->user()->id;
        $results = FramingRequest::getNotifications();
        return $results;
    }
    
    
    //show notifications
    public function displayNotification(){
        return view("For_students/show_notifications")->with("teachers",$this->Notifications());
    }


    public function show_history(){
        $user_id = auth()->user()->id;

        #1: check if student has realy passed an internship and have a defense, if it's true then search his note in "minutes" table
        #if it doesn't exist in "minutes" table then the students didn"t passe the defense
        $hasDefenses = $this->hasDefenses($user_id);
        $this->hasNote($user_id);
        // return $hasDefenses;
       
       
         return view("For_students/history");
    }

    private function hasNote($user_id){
        $tab = $this->hasDefenses($user_id);
        $result = [];
        foreach($tab as $t){ 
            $table = (array)$t;
            if(count(Minute::whereDefense($t->id)->get()) == 0 ){
                $t->hasNote = "false";
                echo "false <br>";
                echo json_encode($t);
                //array_push($result,$table);
            }else {
                echo "true<br>";
                echo json_encode($t);
            }
            
        }
    }
    private function hasDefenses($user_id){
        $check = DB::table("defenses")
                ->join("internships","internships.id","=","defenses.internship")
                ->join("registrations","registrations.id","=","internships.student")
                ->where("registrations.student","=",$user_id)
                ->get(['defenses.id']);

        return $check;

    }
    private function getAllHistory($user_id){
        $histories = DB::table("minutes")
                    ->join("defenses","defenses.id","=","minutes.defense")
                    ->join("internships","internships.id","=","defenses.internship")
                    ->join("registrations","registrations.id","=","internships.student")
                    ->join("users as reporter","reporter.id","=","defenses.reporter")
                    ->join("users as president","president.id","=","defenses.president")
                    ->join("users as framer","framer.id","=","internships.framer")
                    ->join("companies","companies.id","=","internships.company_framer")
                    ->where("registrations.student","=",$user_id)
                    ->select(
                        "final_note",
                        "mention",
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
                        "companies.name"   
                    )
                    ->get();
        return $histories;
    }


    /***************************POST FORMS****************************/

    //post form edit profile
    public function save_informations(Request $request){
      //required fields
      $this->validate($request,
      [
          "firstname" => "required|string",
          "lastname" => "required|string",
          "cin" => "required|integer|digits:8|unique:users",
          "phone" => "required|string",
          "date_naissance" => "required|date",
          "email" => "required|string|email|unique:users"
      ],
      [
          // required messages
          "date_naissance.required" => "Date de naissance est obligatoire",
          "firstname.required" => "Le nom est obligatoire",
          "lastname.required" => "Le prenom est obligatoire",
          "cin.required" => "Le numero CIN est obligatoire",
          "phone.required" => "Le numero de telephone est obligatoire",

          //string messages
          "firstname.string" => "Le nom est invalid",
          "lastname.string" => "Le prenom est invalid",
          "phone.string" => "Le numero de telephone est invalid", // ready to be changed

          //date messages
          "date_naissance.date" => "Date de naissance est invalid",

          //integer,digits messages
          "cin.integer" => "Le numero CIN est numeric",
          "cin.digits" => "Le numero CIN est composé de 8 chiffres",

          //exist
          "cin.unique" => "Cin est deja existe",

           //email exist
           "email.unique" => "Adresse email existe deja",

           //email format
           "email.email" => "Email est invalid"

      ]);

      $user_id = auth()->user()->id;
      $student = User::find($user_id);
      $student->firstname = $request['firstname'];
      $student->lastname = $request['lastname'];
      $student->cin = $request['cin'];
      $student->phone = $request['phone'];
      $student->birthdate = $request['date_naissance'];

      $student->save();
      Session::flash("success-update");
      return redirect()->back();
    }


    //send email config
    public function send_email(Request $request){
      //create session to store the new url generated
      $token = Session::get("_token");
      $email = auth()->user()->email;
      Session::flash("url",$token);
      //send email
      $date  = Carbon::now();
      $dateMail =  $date->formatLocalized('%A %d %B %Y');
      Mail::to($email)->send(new edit_email($dateMail));
      return view("For_students/EmailSentSuccess");
    }

    public function save_newEmail(Request $request){
        $password = $request['password'];
        $password_confirmation = $request['password_confirmation'];
        //check if email is a real email, ==> email@exemple.com
        if(filter_var($request->email,FILTER_VALIDATE_EMAIL)){
            //email must be unique
            if($request->email != auth()->user()->email && User::whereEmail($request->email)->count() == 0){
                //to check if the password is correct,
                // try to make "a connection with that password" and check if its true or not
                if(auth()->user()->tryToConnect($password) == true){
                        //check if the password #1 field if equal to passwor-confirmation #2 field
                        if($password == $password_confirmation){
                            //save the new email in user table
                            $email = auth()->user()->email;
                            $new_email = $request['email'];
                            $user = User::where("email",$email)->update(["email"=>$new_email]);
                            //destroy session, that make the user login with new email
                            $request->session()->flush();
                            return "true";
                        }else{
                            return "wrong password confirmation";
                        }
                
                }else{
                    return "wrong password";
                }
        
            }else{
                return "email exist";
            }
        
        }else{
            return "wrong email";
        }
        
         
    }

    public function edit_pass(Request $request){
        $password_actuel = $request['password_actuel'];
        $password_nouv = $request['password_nouv'];
        $password_confirm = $request['password_confirm'];

        //check if the actuel password is correct
        if(auth()->user()->tryToConnect($password_actuel)){
            //length of new password must be >=8
            if(strlen($password_nouv)>=8){
                //check if password == password confirmation
                if($password_nouv == $password_confirm){
                    //update 
                    User::where("email",auth()->user()->email)->update(['password'=>bcrypt($password_nouv)]);
                    //delete session, that user must be login with new password
                    $request->session()->flush();
                    return "done";
                }else{
                    return "wrong password confirmation";
                }
            
            }else{
                return "length";
            }
            
        }

        return "wrong password";
    }


    //when student accept the teacher's demande
    public function acceptDemande(Request $request){
        #1: change the statu of request to accepted
        $requestFind = FramingRequest::find($request['id_frame']);
        $requestFind->status = "accepeted";
        if($requestFind->save()){
            #2: make the rest of the request to rejected
            $restWish = FramingRequest::whereStatus("waiting")
            ->whereRequestType("wish")
            ->whereInternship($requestFind->internship)
            ->update(["status"=>"rejected"]);

            if($restWish > 0){
                return "done";
            }
            return "error";
        }
        return "error";
        
                
    }

    //when student reject the teacher's demande
    public function rejectDemande(Request $request){
        $requestFind = FramingRequest::find($request['id_frame']);
        $requestFind->status = "rejected";
        if($requestFind->save()){
            return "done";
        }else{
            return "error";
        }
    }


/******************PRIVATE METHODS **************************/
   //get all the internships of a student as a parametre
   private function getDefenses($array){
    $defenses = array();
    foreach($array as $arr){
        if($arr->state == "accepted"){
            $check = Internship::getInfoDefense($arr->id);
            if($check != null)
                array_push($defenses,Internship::getInfoDefense($arr->id));
            
        }
    }

    return $defenses;

}

private function getState($array){
    foreach($array as $arr){
        if($arr->state == "accepted")
            return true;
    }
}






}
