<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Schema;
use Calendar;
use PDF;
use Mail;
use App\Mail\TeacherAcc;
use App\Mail\TeacherRef;
use App\User;
use App\FramingRequest;
use App\Company;
use App\Defense;
use App\Internship;
use App\Registration;
use auth;



class DashboardsController extends Controller
{
  public function __construct(){
     $this->middleware('TeacherAccessRights');
  }
// Teachers Dashbord
  public function index()
  {



    $id=Auth::user()->id;
    $teacher = User::find($id);
// les stage
  $stageencadres = Internship::where(['framer'=>$id,'state'=>'accepted'])->get();
  // Les etudient en attent eloquent
  $waiting = FramingRequest::where(['teacher'=>$id, 'status'=>'waiting','request_type'=>'request'])->get();
  //Les etudient demendé avec eloquent
   $wishing = FramingRequest::where(['teacher'=>$id, 'status'=>'waiting','request_type'=>'wish'])->get();
  // etudient sans encadremeent
   $sans = Internship::where(['framer'=>null,'state'=>'accepted', 'type'=>'pfe'])->get();

     return view('dashboards.teachersdash')->with(['teacher'=>$teacher, 'stageencadres'=>$stageencadres,   'waiting'=>$waiting, 'wishing'=>$wishing, 'sans'=>$sans  ]);
  }


//




















public  function calendar()
{
     $id=Auth::user()->id;
  // $x = DB::table('internships')
  //                       ->join('registrations' , 'internships.student', '=', 'registrations.student')
  //                       ->join('users', 'internships.student' , "=" , 'users.id')
  //                       ->join('defenses' , 'internships.id' , '=' , 'defenses.internship')
  //                       ->select('date_d', 'firstname' , 'lastname' , 'start_time' , 'classroom' , 'type')
  //                       ->get();

  $x= Defense::where('reporter', $id)->get()->toArray();
  $y= Defense::where('president', $id)->get()->toArray();
  $xy = array_merge($x,$y);







                //return $x;
                $jscode = '';
                foreach($xy as $day) {


                    /**Fix Probleme Javascript */
                    $first_name = Internship::find($day['internship'])->registration->studentRecord->firstname;
                    $last_name =  Internship::find($day['internship'])->registration->studentRecord->lastname;
                    // $first_name = Internship::find($day->internships)->first()->registration->studentRecord->firstname;
                    // $last_name =  Internship::find($day->internships)->first()->registration->studentRecord->lastname;
                    $first_name = str_replace("'" , "" , $first_name);
                    $last_name = str_replace("'", "" ,$last_name);
                    /**Fix Probleme Javascript */



                    $jscode .= "{
                        title: '" . $first_name . ' ' . $last_name . " (". $day['classroom'] ." )". "',
                        start: '" . $day['date_d'] . "T". $day['start_time'] .  "',
                        end: '" . $day['date_d'] . "T". $day['end_time'] .  "',

                      },";

                }

                $first=$xy[0]['date_d'];
                //init = green
                //perf = blue
                //pfe = red

    return view('dashboards.admin.Teacherscalendar')->with(['jscode'=>$jscode,'first'=>$first]);
}

public  function pdf_defensescalendar() {

     $id=Auth::user()->id;

  $x = DB::table('internships')
              ->join('registrations' , 'internships.student', '=', 'registrations.student')
              ->join('users', 'internships.student' , "=" , 'users.id')
              ->join('defenses' , 'internships.id' , '=' , 'defenses.internship')
              ->join('groups' , 'registrations.group' , '=' , 'groups.id')
              ->join('companies as comp' , 'internships.company_framer' , '=' , 'comp.id')
              ->select(
                  'comp.name as company_name',
                  'defenses.date_d',
                  'defenses.start_time',
                  'defenses.classroom',
                  'groups.name as group_name',
                  'internships.type',
                  'users.firstname',
                  'users.lastname',
                  'users.email',
                  'users.cin',
                  'users.phone',
                  'defenses.reporter',
                  'defenses.president'
                  )
                  ->where(function($q) use ($id) {
                    $q->where('defenses.reporter', $id)
                    ->orWhere('defenses.president', $id);
                  })
              ->get();



           $pdf = PDF::loadView('pdfs.defensescalendar', ['alldata' => $x]);
           $pdf->setPaper('A4', 'landscape');
           return $pdf->stream('soutenance.pdf');
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function acc($id)
{


  //

  $id_framer= Auth::user()->id;
    $framer=User::find($id_framer);
    //Accepte l'encadremeent
    $acc = Internship::find($id);
    $acc->framer=$id_framer;
    $acc->save();
    FramingRequest::where('internship', $id)->delete();




    $stagers = DB::table('internships')
            ->join('users', 'internships.student', '=', 'users.id' )
            ->join('managers', 'internships.student', '=', 'managers.id' )
            ->join('framing_requests', 'internships.id', '=', 'framing_requests.internship' )
            ->select('internships.*', 'users.firstname as nom','managers.company as com' , 'users.lastname as pre', 'managers.name as en')
            ->where(['internships.framer'=>$id_framer,'internships.framer'=>$id_framer ,'internships.state'=>'accepted'])
            ->get();
           //  $student=User::find($acc->student);
           // Mail::to($student->email)->send(new TeacherAcc($framer,$acc,$student));

    return redirect('teacherhome');
}
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function ref($id)
{

  $id_framer= Auth::user()->id;
       $framer=User::find($id_framer);
       // refuse l'encadremeent
     $req_id= FramingRequest::where(['internship'=>$id,'teacher'=>$id_framer])->delete();

    return redirect('teacherhome');
}
// encadre un etudient sans encadreur
public function encadre($id)
{
  $id_framer= Auth::user()->id;
       $framer=User::find($id_framer);

     $req = new FramingRequest;
     $req->internship=$id;
     $req->teacher=$id_framer;
     $req->request_type='wish';
     $req->save();

    return redirect('teacherhome');
    //  $student=User::find($encadre->student);
    // Mail::to($student->email)->send(new TeacherAcc($teacher,$encadre,$student));
   $encadre->save();

     return redirect('teacherhome');
}


// student contact and internship information
public function information($id){


  $info = Internship::find($id);
  $student = $info->registration->studentRecord;
  $manger = $info->companyFramer;
  $spec = $info->specification;

   return ([$student,$manger,$spec]);
}


// I forget the up date withe the password --'

public function Settings()
{
 $id=Auth::user()->id;

   $teacher = User::find($id);
   return view('teachers.settings')->with('teacher',$teacher);


}
public function Settingspass()
{
 $id=Auth::user()->id;

   $teacher = User::find($id);
   return view('teachers.settingspass')->with('teacher',$teacher);


}

    // public function edit_pass(Request $request){
    //     $password_actuel = $request['password_actuel'];
    //     $password_nouv = $request['password_nouv'];
    //     $password_confirm = $request['password_confirm'];
    //
    //     //check if the actuel password is correct
    //     if(auth()->user()->tryToConnect($password_actuel)){
    //         //length of new password must be >=8
    //         if(strlen($password_nouv)>=8){
    //             //check if password == password confirmation
    //             if($password_nouv == $password_confirm){
    //                 //update
    //                 User::where("email",auth()->user()->email)->update(['password'=>bcrypt($password_nouv)]);
    //                 //delete session, that user must be login with new password
    //
    //
    //
    //
    //
    //                 $request->session()->flush();
    //
    //
    //                 return "done";
    //             }else{
    //                 return "wrong password confirmation";
    //             }
    //
    //         }else{
    //             return "length";
    //         }
    //
    //
    //     }
    //
    //     return "wrong password";
    // }


}
