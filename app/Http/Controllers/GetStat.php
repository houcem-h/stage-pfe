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



}
