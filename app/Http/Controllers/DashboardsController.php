<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use Calendar;
use App\User;
use App\Company;
use App\Internship;



class DashboardsController extends Controller
{

// Teachers Dashbord
  public function index()
  {

    // id for test cause there is a probleme with the auth i think it's coming from the middleware

    $id=22;

    // $id=auth()->user()->id;   a regle !!!!!!!!!!

    $teacher = User::find($id);
// les stage
    $stageencadre =DB::table('internships')
     ->where('framer', $id)->get();

//Les etudient
$stagers = DB::table('internships')
        ->join('users', 'internships.student', '=', 'users.id' )
        ->join('managers', 'internships.student', '=', 'managers.id' )
        ->select('internships.*', 'users.firstname as nom','managers.company as com' , 'users.lastname as pre', 'managers.name as en')
        ->where(['internships.framer'=>$id, 'internships.state'=>'accepted'])
        ->get();
        // reqframer 2 and id != null  Accepter

//Les etudient en attent
$waitting = DB::table('internships')
        ->join('users', 'internships.student', '=', 'users.id' )
        ->join('managers', 'internships.student', '=', 'managers.id' )
        ->select('internships.*', 'users.firstname as nom','managers.company as com', 'users.lastname as pre', 'managers.name as en')
        ->where(['internships.framer'=>null, 'internships.reqframer'=>$id, 'internships.state'=>'accepted'])
        ->get();

        // reqframer 1 en attent

// etudient sans encadremeent

$sans = DB::table('internships')
        ->join('users', 'internships.student', '=', 'users.id' )
        ->join('managers', 'internships.student', '=', 'managers.id' )
        ->select('internships.*', 'users.firstname as nom','managers.company as com', 'users.lastname as pre', 'managers.name as en')
        ->where(['internships.reqframer'=>null,'internships.framer'=>null, 'internships.state'=>'rejected'])
        ->get();

// reqframer 4 rejete


$company =  Company::all();

    return view('dashboards.teachersdash')->with(['teacher'=>$teacher, 'stageencadre'=>$stageencadre, 'stagers'=>$stagers, 'company'=>$company, 'waitting'=>$waitting, 'sans'=>$sans  ]);
  }


//

public function schedule(/*id*/)
{

  $events = [];
     $id=auth()->user()->id;
      $data =  DB::table('internships')
              ->join('users', 'internships.student', '=', 'users.id' )
              ->join('managers', 'internships.student', '=', 'managers.id' )
              ->select('internships.*', 'users.firstname as nom', 'users.lastname as pre', 'managers.name as en')
              ->where('internships.framer', $id)
              ->get();
      if($data->count()) {
          foreach ($data as $key => $value) {
              $events[] = Calendar::event(
                  $value->nom,
                  true,
                  new \DateTime($value->start_date),
                  new \DateTime($value->end_date.' +1 day'),
                  null,
                  // Add color and link on event
                [
                    'color' => '#f05050',
                    'url' => '',
                ]
              );
          }
      }
      $calendar = Calendar::addEvents($events);

    return view('dashboards.schedule')->with(['calendar'=> $calendar,'data'=>$data]);
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

    // $id_framer= auth()->user()->id;
    $id_framer= 22;
    //Accepte l'encadremeent
    $acc = Internship::find($id);
    $acc->framer =$id_framer;
    $acc->save();

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

    //
    // refuse l'encadremeent
    $ref = Internship::find($id);
    $ref->reqframer =null;
    $ref->framer =null;
    $ref->state ='rejected';
    $ref->save();

    return redirect('teacherhome');
}
// encadre un etudient sans encadreur
public function encadre($id)
{
    // $id_framer= auth()->user()->id;
$id_framer=22;
    $encadre = Internship::find($id);
    $encadre->framer =$id_framer;
    $encadre->reqframer =null;
    $encadre->state ='accepted';
    $encadre->save();

    return redirect('teacherhome');
}


//get all sudents
public function internsinfo(Request $request){
  $id_inter = $request['idinter'];

  $info = DB::table('internships')
          ->join('users', 'internships.student', '=', 'users.id' )
          ->join('managers', 'internships.student', '=', 'managers.id' )
          ->select('internships.*', 'users.firstname as nom', 'users.lastname as pre', 'managers.name as en')
          ->where('internships.id', $id_inter)
          ->get();
  return ($info);
}


// I forget the up date withe the password --'

public function Settings()
{
 $id=auth()->user()->id;


   $teacher = User::find($id);
   return view('teachers.settings')->with('teacher',$teacher);


}
public function updatepass(Request $request, $id)
{
  $this->validate($request, [
      'firstname' => 'required',
      'lastname' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'birthdate' => 'nullable',
      'cin' => 'nullable'
      ]);
  $teacher = User::find($id);


if ($request->input('password')!==null) {
  $teacher->firstname = $request->input('firstname');
  $teacher->lastname = $request->input('lastname');
  $teacher->email = $request->input('email');
  $teacher->phone = $request->input('phone');
  $teacher->birthdate = $request->input('birthdate');
  $teacher->cin = $request->input('cin');
  $teacher->save();
  return redirect('teachers')->with('success','Enseignant mis à jour');
}
    //update teacher

}


}
