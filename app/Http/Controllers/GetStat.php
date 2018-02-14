<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;

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
            $alldata = DB::table('defenses')
                
            ->join('internships' , 'defenses.internship', '=' , 'internships.id')
            ->join('users' , 'internships.student', '=' , 'users.id')
            ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
            ->join('groups', 'registrations.group' , 'groups.id')
            ->select("users.id as userid", "defenses.*" , "internships.*" , "registrations.*" , "groups.*" , "users.*")
                ->get(); 
                //return $alldata;
                return View('dashboards.admin.soutenance_all' , ['alldata' => $alldata]);
                
        }

        public static function soutenance_cette_annee(){
            $alldata = DB::table('defenses')
                
                


                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->join('groups', 'registrations.group' , 'groups.id')
                ->select("users.id as userid", "defenses.*" , "internships.*" , "registrations.*" , "groups.*" , "users.*")
                ->where('session' , "=" , GetStat::thisYearSession())
                ->get(); 
                //return $alldata;
                return View('dashboards.admin.soutenance_cette_annee' , ['alldata' => $alldata]);
                
        }

        public static function soutenance_historique(){

           
                $alldata = DB::table('defenses')
                
                ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->join('groups', 'registrations.group' , 'groups.id')
                ->select("users.id as userid", "defenses.*" , "internships.*" , "registrations.*" , "groups.*" , "users.*")
                ->where('session' , "=" , GetStat::thisYearSession())
                ->get(); 
                //return $alldata;
                return View('dashboards.admin.soutenance_historique' , ['alldata' => $alldata]);
            
                
        }


        public static function soutenance_historique_by_years($years){

            $years  = str_replace('-' , '/' , $years);
            $alldata = DB::table('defenses')
            
            ->join('internships' , 'defenses.internship', '=' , 'internships.id')
                ->join('users' , 'internships.student', '=' , 'users.id')
                ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
                ->join('groups', 'registrations.group' , 'groups.id')
                ->select("users.id as userid", "defenses.*" , "internships.*" , "registrations.*" , "groups.*" , "users.*")
            ->where('session' , "=" , "$years")
            ->get(); 
            //return $alldata;
            return View('dashboards.admin.soutenance_historique' , ['alldata' => $alldata]);
        
            
    }
       
        public static function soutenance_accepted(){
            $alldata = DB::table('defenses')
                
            ->join('internships' , 'defenses.internship', '=' , 'internships.id')
            ->join('users' , 'internships.student', '=' , 'users.id')
            ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
            ->join('groups', 'registrations.group' , 'groups.id')
            
            ->get(); 


            $f_data = $alldata->filter(function ($customer) {
                return $customer->state == 'accepted';
            });
            

               
                return View('dashboards.admin.soutenance_verified' , ['alldata' => $f_data]);
                
        }

        public static function soutenance_waiting(){
            $alldata = DB::table('defenses')
                
            ->join('internships' , 'defenses.internship', '=' , 'internships.id')
            ->join('users' , 'internships.student', '=' , 'users.id')
            ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
            ->join('groups', 'registrations.group' , 'groups.id')
            
            ->get(); 


            $f_data = $alldata->filter(function ($customer) {
                return $customer->state == 'waiting';
            });
            

               
                return View('dashboards.admin.soutenance_verified' , ['alldata' => $f_data]);
                
        }

        public static function soutenance_rejected(){
            $alldata = DB::table('defenses')
                
            ->join('internships' , 'defenses.internship', '=' , 'internships.id')
            ->join('users' , 'internships.student', '=' , 'users.id')
            ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
            ->join('groups', 'registrations.group' , 'groups.id')
            
            ->get(); 

            //return $alldata;
            $f_data = $alldata->filter(function ($customer) {
                return $customer->state == 'rejected';
            });
            

               
                return View('dashboards.admin.soutenance_verified' , ['alldata' => $f_data]);
                
        }

        public static function soutenance_by_id($id){
            $alldata = DB::table('defenses')
                
            ->join('internships' , 'defenses.internship', '=' , 'internships.id')
            ->join('users' , 'internships.student', '=' , 'users.id')
            ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
            ->join('groups', 'registrations.group' , 'groups.id')
            
            ->get(); 
            $f_data = $alldata->filter(function ($customer) {
                return $customer->id == "$id";
            });
            return $f_data;


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

        public static function getstream_by_student_id($id) {
            $alldata = DB::table('registrations')
            ->join('groups', 'registrations.group', '=' ,'groups.id')
            ->where('registrations.student' , '=' , $id)
            ->pluck('stream')
            ->first();
            return $alldata;
        }


        public function testingPDF($datesign) {
            $alldata = DB::table("internships")
                            ->join('specifications' , "internships.specifications" , '=' , "specifications.id")
                            ->join('registrations' , "internships.student" , '=' , "registrations.student")
                            ->join('groups', 'registrations.group', '=', "groups.id")
                            ->join('users' , 'internships.student' , '=' , "users.id")
                            ->get();
                            
            //return $alldata;
            $pdf = PDF::loadView('pdfs.s',  ['alldata' => $alldata , 'datesign' => $datesign]);
            return $pdf->download('document.pdf');
        }


        public function invitation($date) {
           
            $alldata = DB::table('defenses')
                        ->join('internships', 'defenses.internship' , '=' , 'internships.id')
                        ->join('managers', 'internships.company_framer' , "=" , "managers.company")
                        ->select('defenses.date_d', 'defenses.start_time' , 'defenses.classroom' , 'managers.name' ,'managers.email' )
                        ->where('internships.type' , '=' ,'pfe')
                        ->get();
            //return $alldata;
            $pdf = PDF::loadView('pdfs.invit' , ['alldata' => $alldata , 'date' => $date]);
            
            return View('pdfs.invit' , ['alldata' => $alldata , 'date' => $date]);
        }


        public function upgrade_teacher() {
            $alldata = DB::table('users')
                        ->where('users.role' , '!=' , '0')
                        ->get();
                return View('dashboards.admin.upgradeuser' , ['alldata' => $alldata]);
                   
        }



        public static function upgrade_by_id($id) {
           $x =  DB::table('users')->where('id', '=', $id)
	                ->update(array('role' => '2'));
                        return "done!";      
        }

        public static function downgrade_by_id($id) {
            $x =  DB::table('users')->where('id', '=', $id)
                     ->update(array('role' => '1'));
                         return "done!";      
         }

        public static function color_by_type($type) {
            if($type == "init")
                return "#27ae60";
            if($type == "perf")
                return "#2980b9";
            if ($type== "pfe")
                return "#e74c3c";
        }


        public static function get_calendar_dates() {
                $x = DB::table('internships')
                        ->join('registrations' , 'internships.student', '=', 'registrations.student')
                        ->join('users', 'internships.student' , "=" , 'users.id')
                        ->join('defenses' , 'internships.id' , '=' , 'defenses.internship')
                        ->select('date_d', 'firstname' , 'lastname' , 'start_time' , 'classroom' , 'type')
                        ->get();
                //return $x;
                $jscode = '';
                foreach($x as $def) {
                    

                    /**Fix Probleme Javascript */
                    $first_name = $def->firstname;
                    $last_name = $def->lastname;
                    $firstname = str_replace("'" , "" , $first_name);
                    $last_name = str_replace("'", "" ,$last_name);
                    /**Fix Probleme Javascript */



                    $jscode .= "{
                        title: '" . $first_name . ' ' . $last_name . " (". $def->classroom ." )". "',
                        start: '" . $def->date_d . "T". $def->start_time .  "',
                        color  : '". \App\Http\Controllers\GetStat::color_by_type($def->type)."',
                        textColor: 'white'
                      },";
                }
                return $jscode;
                //init = green
                //perf = blue
                //pfe = red

        }


        public static function pdf_calendar() {
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
                        ->get();
                       // return $x;
            //return View('pdfs.calendar', ['alldata' => $x]);


                     $pdf = PDF::loadView('pdfs.calendar', ['alldata' => $x]);
                     $pdf->setPaper('A4', 'landscape');
                     return $pdf->stream('test_pdf.pdf');
        }






        public static function encadrement_waiting() {

            $alldata = DB::table('framing_requests')
                        ->join('users as teachers' , 'framing_requests.teacher' , "=" , "teachers.id")
                        ->join('internships' , "framing_requests.internship" , "=" , "internships.id")
                        ->join('users as students' , "internships.student", "=" , "students.id")
                        ->join('specifications' , 'internships.specifications' , "=" , "specifications.id")
                        ->select(
                        'framing_requests.id',
                         'framing_requests.request_type as request_type ',
                         'framing_requests.status as status' ,
                         'teachers.firstname as teacher_firstname' ,
                         'teachers.lastname as teacher_lastname' ,
                         'students.firstname as student_firstname' ,
                         'students.lastname as student_lastname',
                         'specifications.title',
                         'specifications.project_type',
                         'specifications.existing_desc',
                         'specifications.requirement_spec',
                         'specifications.hardware_env',
                         'specifications.software_env',
                         'specifications.provisional_planning'

                       )
                         ->where('framing_requests.request_type' , "=" , "wish")
                         ->where('framing_requests.status', '=' , 'waiting')
                         ->get();
            
            return View('dashboards.admin.encadrement_waiting')->with('alldata' , $alldata);
        }



        public static function encadrement_accepted() {

            $alldata = DB::table('framing_requests')
                        ->join('users as teachers' , 'framing_requests.teacher' , "=" , "teachers.id")
                        ->join('internships' , "framing_requests.internship" , "=" , "internships.id")
                        ->join('users as students' , "internships.student", "=" , "students.id")
                        ->join('specifications' , 'internships.specifications' , "=" , "specifications.id")
                        ->select(
                        'framing_requests.id',
                         'framing_requests.request_type as request_type ',
                         'framing_requests.status as status' ,
                         'teachers.firstname as teacher_firstname' ,
                         'teachers.lastname as teacher_lastname' ,
                         'students.firstname as student_firstname' ,
                         'students.lastname as student_lastname',
                         'specifications.title',
                         'specifications.project_type',
                         'specifications.existing_desc',
                         'specifications.requirement_spec',
                         'specifications.hardware_env',
                         'specifications.software_env',
                         'specifications.provisional_planning'

                       )
                         ->where('framing_requests.request_type' , "=" , "wish")
                         ->where('framing_requests.status', '=' , 'accepeted')
                         ->get();
            
            return View('dashboards.admin.encadrement_verified')->with('alldata' , $alldata);
        }




        public static function encadrement_rejected() {

            $alldata = DB::table('framing_requests')
                        ->join('users as teachers' , 'framing_requests.teacher' , "=" , "teachers.id")
                        ->join('internships' , "framing_requests.internship" , "=" , "internships.id")
                        ->join('users as students' , "internships.student", "=" , "students.id")
                        ->join('specifications' , 'internships.specifications' , "=" , "specifications.id")
                        ->select(
                        'framing_requests.id',
                         'framing_requests.request_type as request_type ',
                         'framing_requests.status as status' ,
                         'teachers.firstname as teacher_firstname' ,
                         'teachers.lastname as teacher_lastname' ,
                         'students.firstname as student_firstname' ,
                         'students.lastname as student_lastname',
                         'specifications.title',
                         'specifications.project_type',
                         'specifications.existing_desc',
                         'specifications.requirement_spec',
                         'specifications.hardware_env',
                         'specifications.software_env',
                         'specifications.provisional_planning'

                       )
                         ->where('framing_requests.request_type' , "=" , "wish")
                         ->where('framing_requests.status', '=' , 'rejected')
                         ->get();
            
            return View('dashboards.admin.encadrement_rejected')->with('alldata' , $alldata);
        }






      
        public function getframingreq_by_id($id) {

                        $alldata = DB::table('framing_requests')
                        ->join('users as teachers' , 'framing_requests.teacher' , "=" , "teachers.id")
                        ->join('internships' , "framing_requests.internship" , "=" , "internships.id")
                        ->join('users as students' , "internships.student", "=" , "students.id")
                        ->join('specifications' , 'internships.specifications' , "=" , "specifications.id")
                        ->select(
                        'framing_requests.id',
                        'framing_requests.request_type as request_type ',
                        'framing_requests.status as status' ,
                        'teachers.firstname as teacher_firstname' ,
                        'teachers.lastname as teacher_lastname' ,
                        'students.firstname as student_firstname' ,
                        'students.lastname as student_lastname',
                        'specifications.title',
                         'specifications.project_type',
                         'specifications.existing_desc',
                         'specifications.requirement_spec',
                         'specifications.hardware_env',
                         'specifications.software_env',
                         'specifications.provisional_planning'
                        )
                   
                        ->where("framing_requests.id" , "=" , "$id")
                        ->get();

                    return $alldata;
        }


        public function accept_framing($id) {

            $alldata = DB::table('framing_requests')
           
       
            ->where("id" , "=" , "$id")
            ->update(['status' => 'accepeted']);

        return "Framing Accepted!";
    }

    public function reject_framing($id) {

        $alldata = DB::table('framing_requests')
       
   
        ->where("id" , "=" , "$id")
        ->update(['status' => 'rejected']);

    return "Framing Rejected!";
}

public function waiting_framing($id) {

    $alldata = DB::table('framing_requests')
   

    ->where("id" , "=" , "$id")
    ->update(['status' => 'waiting']);

return "Framing is waiting!";
}


public static function get_jobs_nb(){
    //return jobs count
    $alldata = DB::table('jobs')->get();
            return count($alldata);
}




public static function thisYearSession(){
     //if date between 01 and 09 (jan to sept) return 'this_year' session else return 'this_year_+1'
    if(Carbon::now()->between(
        Carbon::create(Carbon::now()->year,1,1,0,0,0),
        Carbon::create(Carbon::now()->year,9,1,0,0,0)
    )){
        return strval(Carbon::now()->year-1)."/".strval(Carbon::now()->year);
    }

    return strval(Carbon::now()->year)."/".strval(Carbon::now()->year+1);
}

public static function soutenance_pdf_id($id) {
    $alldata = DB::table('defenses')
                
    ->join('internships' , 'defenses.internship', '=' , 'internships.id')
    ->join('users' , 'internships.student', '=' , 'users.id')
    ->join('registrations' , 'internships.student' , '=' , 'registrations.student')
    ->join('groups', 'registrations.group' , 'groups.id')
    ->select("users.id as userid", "defenses.*" , "internships.*" , "registrations.*" , "groups.*" , "users.*")
    ->get();
    $f_data =  $alldata->where('userid' , "=" , "$id")->take(1);
   
    $pdf = PDF::loadView('pdfs.fiche', ['fiche' => $f_data]);
    return $pdf->stream();

   
}


}
