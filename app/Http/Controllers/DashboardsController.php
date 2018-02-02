<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Schema;
use Calendar;
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
     // $this->middleware('TeachersAccessRights');
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
// still working on
// public  function calendar()
// {
//      $id=Auth::user()->id;
//   // $x = DB::table('internships')
//   //                       ->join('registrations' , 'internships.student', '=', 'registrations.student')
//   //                       ->join('users', 'internships.student' , "=" , 'users.id')
//   //                       ->join('defenses' , 'internships.id' , '=' , 'defenses.internship')
//   //                       ->select('date_d', 'firstname' , 'lastname' , 'start_time' , 'classroom' , 'type')
//   //                       ->get();
//
//   $x= Defense::where('reporter', $id)->get()->toArray();
//   $y= Defense::where('president', $id)->get()->toArray();
//   $xy = array_merge($x,$y);
//                 //return $x;
//                 $jscode = '';
//                 foreach($x as $def) {
//
//
//                     /**Fix Probleme Javascript */
//                     $first_name = $def->firstname;
//                     $last_name = $def->lastname;
//                     $firstname = str_replace("'" , "" , $first_name);
//                     $last_name = str_replace("'", "" ,$last_name);
//                     /**Fix Probleme Javascript */
//
//
//
//                     $jscode .= "{
//                         title: '" . $first_name . ' ' . $last_name . " (". $def->classroom ." )". "',
//                         start: '" . $def->date_d . "T". $def->start_time .  "',
//
//                         textColor: 'white'
//                       },";
//                 }
//
//                 //init = green
//                 //perf = blue
//                 //pfe = red
//
//     return view('dashboards.admin.Teacherscalendar')->with('jscode', $jscode);
// }

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
// public function info(Request $request, $id)
// {
//     in first it was to update the teacher
//   $this->validate($request, [
//       'firstname' => 'required',
//       'lastname' => 'required',
//       'email' => 'required',
//       'phone' => 'required',
//       'birthdate' => 'nullable',
//       'cin' => 'nullable'
//   ]);
//
//     //update teacher
//     $teacher = User::find($id);
//     $teacher->firstname = $request->input('firstname');
//     $teacher->lastname = $request->input('lastname');
//     $teacher->email = $request->input('email');
//     $teacher->phone = $request->input('phone');
//     $teacher->birthdate = $request->input('birthdate');
//     $teacher->cin = $request->input('cin');
//     $teacher->save();
//
//     return redirect('teacherhome')->with('success','information mis à jour');
//
//
//
// }
// //     //update teacher

}
