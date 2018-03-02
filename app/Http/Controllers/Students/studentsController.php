<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rules\check_code_email;
use App\User;
use App\Registration;
use App\Internship;
use App\Defense;
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
        //variables
        $defenseInfo = null;
        $minuteInfo = null;
        $AcceptedDefense = true;
        $DateDefensePassed = false;


        //display the activity table
        $check_result = Internship::getCurrentInternships(auth()->user()->id);
        if(!empty($check_result)){
            // check if state of internship is accepted
            if($check_result[0]->state == "accepted"){

                //search in defense table
                $defenseChecked = $this->getDefenses($check_result[0]->id);
                if($defenseChecked[0] != null){
                    $defenseInfo = $defenseChecked[0];

                    // check of date system is greater than end date of defense
                    if($this->checkDateDefense($defenseChecked[0]->date_d) == true){
                        $DateDefensePassed = true;
                        //now check minute data
                        if($this->checkMinute($defenseChecked[0]->id_defense)[0] != null){
                            $minuteInfo = $this->checkMinute($defenseChecked[0]->id_defense);
                            // return $this->checkMinute($defenseChecked[0]->id_defense);
                        }else{
                            // minute not avaible

                        }

                    }else{
                        // dnt do nothing
                    }

                }else{
                    // defense are not availble means defenseInfo = null

                }
            }else{
                // nothing to do
                $AcceptedDefense = false;
            }

        }

        return view("For_students/dashboard")->with([
            "InternshipResult" => $check_result,
            "AcceptedDefense" => $AcceptedDefense,
            "DefenseInfo" => $defenseInfo,
            "DateDefensePassed" => $DateDefensePassed,
            "minuteInfo" => $minuteInfo

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


    // get Notifications (javascript toast)
    public function Notifications(){
        $results = FramingRequest::getNotificationsForToast();
        return $results;
    }

    // change Seen Notif
    public function changeSeenNotif(){
      $id_notif = $this::Notifications()->first()->id;
      $req = FramingRequest::find($id_notif);
      $req->seen = "true";
      $req->save();
    }

    //show notifications in page "notifcation"
    public function displayNotification(){
      $req = FramingRequest::getNotificationsForBlade();
        return view("For_students/show_notifications")->with("framing",$req);
    }


    public function show_history(){
        $user_id = auth()->user()->id;

        #1: check if student has realy passed an internship and have a defense, if it's true then search his note in "minutes" table
        #if it doesn't exist in "minutes" table then the students didn"t passe the defense
        $Defenses = $this->Defenses($user_id);
        $hasDefense = true;
        $result = [];
        if(count($Defenses) == 0){
            $hasDefense = false;
        }else{
            $result = $this->hasMinute($user_id);
        }

        //  return $result;
        return view("For_students/history")->with([
            "has_defense" => $hasDefense,
            "result" => $result
        ]);
    }




    /***************************POST FORMS****************************/

    //post form edit profile
    public function save_informations(Request $request){

      //required fields
      $this->validate($request,
      [
          "firstname" => "required|string",
          "lastname" => "required|string",
          "phone" => "required|string",
          "date_naissance" => "required|date"
      ],
      [
          // required messages
          "date_naissance.required" => "Date de naissance est obligatoire",
          "firstname.required" => "Le nom est obligatoire",
          "lastname.required" => "Le prenom est obligatoire",
          "phone.required" => "Le numero de telephone est obligatoire",

          //string messages
          "firstname.string" => "Le nom est invalid",
          "lastname.string" => "Le prenom est invalid",
          "phone.string" => "Le numero de telephone est invalid", // ready to be changed

          //date messages
          "date_naissance.date" => "Date de naissance est invalid",

           //email exist
           "email.unique" => "Adresse email existe deja",

           //email format
           "email.email" => "Email est invalid"

      ]);


      $user_id = auth()->user()->id;
      $student = User::find($user_id);

      $student->firstname = $request['firstname'];
      $student->lastname = $request['lastname'];
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




/******************PRIVATE METHODS **************************/
  private function getDefenses($id_internship){
      $check = Defense::getInfoDefense($id_internship);
      return $check;
  }

  private function checkMinute($id_defense){
      $check = Minute::check($id_defense);
      return $check;
   }

  private function checkDateDefense($endDate){
      $parsedEndDateDefense = Carbon::parse($endDate);
      if(Carbon::now()->gt($parsedEndDateDefense)){
          return true;
      }
  }




private function hasMinute($user_id){
    $tab = $this->Defenses($user_id);
        foreach($tab as $t){
            if(!Minute::whereDefense($t->id_defense)->get()->first()){
                $t->has_minute = "false";
            }else{
                $t->has_minute = "true";
                $minute = Minute::whereDefense($t->id_defense)->get()->first();
                $t->final_note = $minute->final_note;
                $t->mention = $minute->mention;
                $t->notes = $minute->notes;
            }


        }
     return $tab;
}
private function Defenses($user_id){
    $check = DB::table("defenses")
            ->join("internships","internships.id","=","defenses.internship")
            ->join("registrations","registrations.id","=","internships.student")
            ->join("users as reporter","reporter.id","=","defenses.reporter")
            ->join("users as president","president.id","=","defenses.president")
            ->join("users as framer","framer.id","=","internships.framer")
            ->join("managers","managers.id","=","internships.company_framer")
            ->join("companies","companies.id","=","managers.company")
            ->where("registrations.student","=",$user_id)
            ->where("internships.state","=","accepted")
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
            ->get();

    return $check;
}



}
