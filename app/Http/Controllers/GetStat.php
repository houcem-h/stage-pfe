<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;


class GetStat extends Controller
{
      //Number of students @return int
    public static function getNumberofStudents() {
       $nbusers = DB::table('users')->where('role', '=', '0')->get();
       return count($nbusers);
    }

      //Number of Teachers @return int
    public static function getNumberofTeachers() {
        $nbusers = DB::table('users')->where('role', '=', '1')->get();
        return count($nbusers);
     }

       //Number of Admins @return int
     public static function getNumberofAdmins() {
        $nbusers = DB::table('users')->where('role', '=', '2')->get();
        return count($nbusers);
     }

       //Number ofCompanies @return int
     public static function getNumberofCompanies() {
        $nbusers = DB::table('companies')->get();
        return count($nbusers);
     }

       //Number of Interships @return int
     public static function getNumberofInternships() {
        $nbusers = DB::table('companies')->get();
        return count($nbusers);
     }

       //Number of Defences @return int
     public static function getNumberofdefences() {
        $nbusers = DB::table('defenses')->get();
        return count($nbusers);
     }

       //Number of Groups @return int
     public static  function getNumberofgroups() {
        $nbusers = DB::table('groups')->get();
        return count($nbusers);
     }

       //Number of Managers @return int
     public static function getNumberofManagers() {
        $nbusers = DB::table('managers')->get();
        return count($nbusers);
     }

      //Number of Registration @return int
     public static function getNumberofregistrations() {
        $nbusers = DB::table('registrations')->get();
        return count($nbusers);
     }

     //Array of students
     public static function getAllstudents() {
        $users = DB::table('users')->where('role', '=', '0')->get();
        return $users;
     }

      //Array of Teachers
     public static function getAllTeachers() {
        $users = DB::table('users')->where('role', '=', '1')->get();
        return $users;
     }

     //Export students list as PDF
     public static function ExportStudentsAsPDF() {
         $students = \App\Http\Controllers\GetStat::getAllstudents();
        $pdf = PDF::loadView('pdfs.studentlist', ['students' => $students]);
        return $pdf->stream();
     }

     //Export Teacher list as PDF
     public  static function ExportTeachersAsPDF() {
        $teachers = \App\Http\Controllers\GetStat::getAllTeachers();
       $pdf = PDF::loadView('pdfs.teacherlist', ['teachers' => $teachers]);
       return $pdf->stream();
    }     


    //Export Student List As Excel
    public static function ExportStudentsAsExcel() {
        $students = \App\User::where('role', '=', '0')->get()->toArray();

        
		return \Excel::create('Students_iset', function($excel) use ($students) {
            $excel->getDefaultStyle()
            ->getAlignment()
            ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $excel->setTitle('Liste Des étudiants');
            $excel->setCreator('ISET Bizerte');
			$excel->sheet('Page1', function($sheet) use ($students)
	        {
                $sheet->fromArray($students, null, 'A6', true);
                $sheet->row(6, array('ID', 'Nom', 'Prénom','Email', 'Date De Naissance' , 'CIN' , 'Tel', 'Role', 'Date De Création'));
                $sheet->row(6, function($row) {
                        $row->setBackground('#4288CE'); //blue
                        $row->setFontColor('#ffffff'); 
                        $row->setFontSize(14);    
                });
                $sheet->cell('D3', function($cell) {
                    // titre
                    $cell->setValue('Liste Des étudiants');
                    $cell->setFontSize(22);   
                    $cell->setBackground('#ffffff'); //blue
                    $cell->setFontColor('#4288CEf');  
                   
                });
                $sheet->mergeCells('D3:J3');
                $sheet->getStyle('D3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );
            });
		})->download('xls');

    }











    //Export Teacher List As Excel
    public static function ExportTeachersAsExcel() {
        $teachers = \App\User::where('role', '=', '1')->get()->toArray();

        
		return \Excel::create('teachers_iset', function($excel) use ($teachers) {
            $excel->getDefaultStyle()
            ->getAlignment()
            ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $excel->setTitle('Liste Des Enseignants');
            $excel->setCreator('ISET Bizerte');
			$excel->sheet('Page1', function($sheet) use ($teachers)
	        {
                $sheet->fromArray($teachers, null, 'A6', true);
                $sheet->row(6, array('ID', 'Nom', 'Prénom','Email', 'Date De Naissance' , 'CIN' , 'Tel', 'Role', 'Date De Création'));
                $sheet->row(6, function($row) {
                        $row->setBackground('#4288CE'); //blue
                        $row->setFontColor('#ffffff'); 
                        $row->setFontSize(14);    
                });
                $sheet->cell('D3', function($cell) {
                    // titre
                    $cell->setValue('Liste Des Enseignants');
                    $cell->setFontSize(22);   
                    $cell->setBackground('#ffffff'); //blue
                    $cell->setFontColor('#4288CEf');  
                   
                });
                $sheet->mergeCells('D3:J3');
                $sheet->getStyle('D3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );
            });
		})->download('xls');

    }




/********************* Useful for Javascript ******************************/

    public static function javascriptchart() {

                  $groups_array = \App\Http\Controllers\GetStat::getEnumValues("groups", "stream"); //names of groups
                  $groups_nb = array(); //number of students in groups (same)
                  
                  foreach ($groups_array as $group) {
                      $val_array =  DB::table('groups')->where('stream', '=', "$group")->get();
                      $val_count = count($val_array);
                      array_push($groups_nb, $val_count); // push number of students in group
                  }

                  $s1 = '[';
                  $s2 = '[';

                
                foreach($groups_array as $group) {
                    $s1 .= "'" .$group ."'" . " , ";
                }
                $s1 .= "]";
                foreach($groups_nb as $nb) {
                    $s2 .= $nb . ' , ';
                }
                $s2 .= ']';

                
                    if ($groups_nb[0] > 0) {
                        $final_string = ' labels: '.$s1.',
                        datasets: [{
                            data: '.$s2.',';
                    }

                  else { //fake data
                    $final_string = ' labels: '.$s1.',
                    datasets: [{
                        data: '.'[300, 220, 100, 130, 70]'.',';
                  }

                        return   $final_string ;

        }




    //return enum Values from table
    public static function getEnumValues($table, $column) {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
          $v = trim( $value, "'" );
          $enum = array_add($enum, $v, $v);
        }
        return array_keys($enum);
      }




      public static function destroyuser($id) {
              $user =  \App\User::find($id); 
              $user->delete();
              return "User $id Deleted"; 
      }


      public static function getuserdata($id) {
          $user = \App\User::find($id);
           return $user; 
      }

      public static function updateinfousers(Request $request) {
        $id = $request->input('id');
        $user =  \App\User::find($id); 
        $user->firstname = $request->input('firstname'); 
        $user->lastname = $request->input('lastname'); 
        $user->email = $request->input('email'); 
        $user->cin = $request->input('cin'); 
        $user->phone = $request->input('phone'); 
        $user->save();
        return "Done ! User info Updated";
    }

        public function getalldefences () {
            $alldefences = \App\Defense::orderBy('created_at')->get();
            $array_of_internship = array();
            $array_of_students = array();

            foreach ($alldefences as $defense) {
                $x = $defense->internship;
                //return $x;
                array_push($array_of_internship, $x);
            }

            foreach($array_of_internship as $internship){
                $x1 = DB::table('internships')->where('id', '=', "$internship")->pluck('student')->first();
               array_push($array_of_students, $x1);
            }


            return  $array_of_students;
        }
        


        public function AcceptSingleUser($id) {
            $user = \App\User::find($id);
            $user->state = "accepted";
            $user->save();
            return "Done! User Accepted";
        }

        public function RejectSingleUser($id){
            $user = \App\User::find($id);
            $user->state = "rejected";
            $user->save();
            return "Done! User Rejected";
        }

        public function AcceptSelectedUser(Request $request) {
                    $alldata = $request;
                    $ids = $request->only(['ids']);
                    $ids = $ids['ids'];
                    $ids = str_replace('[', '', $ids);
                    $ids = str_replace(']', '', $ids);    
                    $ids = str_replace('"', '', $ids);
                    $ids_array  = explode(",", $ids);
                    foreach ($ids_array as $id ){
                        $userX = \App\User::find($id);
                        $userX->state = "accepted";
                        $userX->save();
                    }

        }

        public function RejectSelectedUser(Request $request) {
            $alldata = $request;
            $ids = $request->only(['ids']);
            $ids = $ids['ids'];
            $ids = str_replace('[', '', $ids);
            $ids = str_replace(']', '', $ids);    
            $ids = str_replace('"', '', $ids);
            $ids_array  = explode(",", $ids);
            foreach ($ids_array as $id ){
                $userX = \App\User::find($id);
                $userX->state = "rejected";
                $userX->save();
            }
            

        }

        public static function getNBwaitingUsers() {
            $Waitingusers = \App\User::where('state' , '=',  'waiting')->get();
            return count($Waitingusers);
        }

        public static function getNBacceptedUsers() {
            $Waitingusers = \App\User::where('state' , '=',  'accepted')->get();
            return count($Waitingusers);
        }

        public static function getNBrejectedUsers() {
            $Waitingusers = \App\User::where('state' , '=',  'rejected')->get();
            return count($Waitingusers);
        }



       /* public static function pdf_note($annee , $niveau , $note) {
               
                $students = \App\Http\Controllers\GetStat::getAllstudents();
                $pdf = PDF::loadView('pdfs.studentlist', ['students' => $students]);
                return $pdf->stream();
            
        }*/

        public function get_defenses_with_note($year, $egal, $type, $note  ) {
            $year = str_replace("-" , '/' , $year) ; // replace '-' with '/' (ROUTE Problem)       
           
                $alldata1 = DB::table('minutes')
                ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->where('session' , '=' , "$year")
                ->where('final_note' , '>' , "$note")
                ->where('type' , "=" , "$type")
                ->get(); 

                $alldata2 = DB::table('minutes')
                ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->where('session' , '=' , "$year")
                ->where('final_note' , '>' , "$note")
                ->where('type' , "<>" , "$type") /* ! important  */
                ->get(); 

               
                if($egal == "egal") {
                    $pdf = PDF::loadView('pdfs.pdf_custom1', ['alldata' => $alldata1]);
                    return $pdf->stream();
                }

               /* noteq */
               else {
                $pdf = PDF::loadView('pdfs.pdf_custom1', ['alldata' => $alldata2]);
                return $pdf->stream();
                }

        }
        
        public function get_defenses_by_teacher() {
            // $year = "2017/2018";
            // $type = "init";
            // $teacher = "Polly Berge";

            $alldata1 = DB::table('minutes')
            ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
            ->join('internships' , 'defenses.internship', '=' , 'internships.id')
            ->join('users' , 'internships.reporter', '=' , 'users.id')
            ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
            
            ->get(); 
            return $alldata1;
        }


        public static function showResultPage() {
            $allteachers = \App\User::where('role', '=', '1')->orderBy('firstname')->get();
            return View('dashboards.admin.reports' , ['Teachers' => $allteachers ]);
        }

        public function internships_all() {
            $alldata1 = DB::table('internships')
                        ->join('users', 'internships.student', '=' , 'users.id')
                        ->join('companies', 'internships.company_framer', '=' , 'companies.id')
                        ->get();
                        return View('dashboards.admin.interships_all' , ['alldata' => $alldata1]);
            
        }

        public function internships_init() {
            $alldata1 = DB::table('internships')
                        ->join('users', 'internships.student', '=' , 'users.id')
                        ->join('companies', 'internships.company_framer', '=' , 'companies.id')
                        ->where('type', '=' , 'init')
                        ->get();
                        return View('dashboards.admin.interships_init' , ['alldata' => $alldata1]);
            
        }

        public function internships_perf() {
            $alldata1 = DB::table('internships')
                        ->join('users', 'internships.student', '=' , 'users.id')
                        ->join('companies', 'internships.company_framer', '=' , 'companies.id')
                        ->where('type', '=' , 'perf')
                        ->get();
                        return View('dashboards.admin.interships_perf' , ['alldata' => $alldata1]);
            
        }

        public function internships_pfe() {
            $alldata1 = DB::table('internships')
                        ->join('users', 'internships.student', '=' , 'users.id')
                        ->join('companies', 'internships.company_framer', '=' , 'companies.id')
                        ->where('type', '=' , 'pfe')
                        ->get();
                        return View('dashboards.admin.interships_pfe' , ['alldata' => $alldata1]);
            
        }

        public static function get_teacher_fullname($id) {
            $firstname = DB::table('users')->where('id', '=', "$id")->pluck('firstname')->first();
            $lastname = DB::table('users')->where('id', '=', "$id")->pluck('lastname')->first();
            return $firstname . " " . $lastname ;
        }



        public static function soutenance_all(){
            $alldata = DB::table('minutes')
                ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->join('groups', 'registrations.group' , 'groups.id')
                ->get(); 
               // return $alldata;
                return View('dashboards.admin.soutenance_all' , ['alldata' => $alldata]);
                
        }

       
        public static function soutenance_accepted(){
            $alldata = DB::table('minutes')
                ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->join('groups', 'registrations.group' , 'groups.id')
                ->where('internships.state' , '=' , 'accepted')
                ->get(); 
               // return $alldata;
                return View('dashboards.admin.soutenance_all' , ['alldata' => $alldata]);
                
        }

        public static function soutenance_waiting(){
            $alldata = DB::table('minutes')
                ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->join('groups', 'registrations.group' , 'groups.id')
                ->where('internships.state' , '=' , 'waiting')
                ->get(); 
               // return $alldata;
                return View('dashboards.admin.soutenance_all' , ['alldata' => $alldata]);
                
        }

        public static function soutenance_rejected(){
            $alldata = DB::table('minutes')
                ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->join('groups', 'registrations.group' , 'groups.id')
                ->where('internships.state' , '=' , 'rejected')
                ->get(); 
               // return $alldata;
                return View('dashboards.admin.soutenance_all' , ['alldata' => $alldata]);
                
        }

        public function get_teachers_data_pdf($teacher_type, $year, $type , $id){
            $year = str_replace("-" , '/' , $year) ; // replace '-' with '/' (ROUTE Problem)       
         


            if ($teacher_type == "reporter") {
                 //as reporter
                     $alldata = DB::table('minutes')
                     ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                     ->join('users as teacher' , 'defenses.reporter', '=' , 'teacher.id')
                     ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                     ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                     ->join('users as student' , 'registrations.student' , '=' , 'student.id')
                     ->select('teacher.id as teacher_id',
                             'teacher.firstname as teacher_firstname',
                             'teacher.lastname as teacher_lastname',
                             'student.id as std_id',
                             'student.firstname as std_firstname',
                             'student.lastname as std_lastname' ,
                             'minutes.final_note' ,
                             'internships.type' ,
                             'registrations.session',
                             'defenses.date_d',
                             'defenses.start_time',
                             'minutes.notes')      
                     ->where('teacher.id' , '=' , $id)
                     ->where('internships.type', '=' , $type)
                     ->where('registrations.session' , '=' , $year)
                     ->get(); 

                     $pdf = PDF::loadView('pdfs.teachers', ['alldata' => $alldata]);
                     return $pdf->stream();
            }
           

            else {
                //as president
                $alldata = DB::table('minutes')
                     ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                     ->join('users as teacher' , 'defenses.president', '=' , 'teacher.id')
                     ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                     ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                     ->join('users as student' , 'registrations.student' , '=' , 'student.id')
                     ->select('teacher.id as teacher_id',
                             'teacher.firstname as teacher_firstname',
                             'teacher.lastname as teacher_lastname',
                             'student.id as std_id',
                             'student.firstname as std_firstname',
                             'student.lastname as std_lastname' ,
                             'minutes.final_note' ,
                             'internships.type' ,
                             'registrations.session',
                             'defenses.date_d',
                             'defenses.start_time',
                             'minutes.notes')      
                             ->where('teacher.id' , '=' , $id)
                             ->where('internships.type', '=' , $type)
                             ->where('registrations.session' , '=' , $year)
                     ->get(); 

                     $pdf = PDF::loadView('pdfs.teachers', ['alldata' => $alldata]);
                     return $pdf->stream();
            }










        }




        public static function companystat($id){
            $alldata = DB::table('minutes')
                ->join('defenses', 'minutes.defense', '=', 'defenses.id' )
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('companies' , 'internships.company_framer', '=' , 'companies.id')
                ->select('companies.id',
                         'companies.name',
                         'companies.activity',
                         'companies.phone',
                         'companies.fax',
                         'companies.address',
                         'minutes.final_note'
                )
                
                ->get();
                
                $counter = 0;
                $somme = 0;

                foreach ($alldata as $data) {
                    if ($data->id == $id) {
                        $counter++;
                        $somme = $somme + $data->final_note; 
                    }
                        

                }

                if($counter > 0)
                     return round($somme/$counter , 2) .'/20' ;
                else {
                    return "?";
                }
        }

        public function companiesview() {
            $allcompanies = DB::table("companies")->get();
             return View('dashboards.admin.companies' , ['companies' => $allcompanies]);
        }



        public function test() {
            $pdf = PDF::loadView('pdfs.s');
            return $pdf->stream();
        }

}
