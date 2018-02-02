<?php

namespace App\Http\Controllers;
use App\Internship;
use App\Registration;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

   public function getFormattedSession(){
        $year=date('Y');
        $afterString=(int)$year+1;
       return $year.'/'.$afterString;
   }


    public function studentDashboard(){
        // $registration=Registration::where('session',$this->getFormattedSession())->where('student',auth()->user()->id)->first();
        // $internships=Internship::where('student',$registration->id)->where('start_date','>',date('Y-m-d'))->get();

        // return view('/studentDashboard')->with('internships',$internships);
         return view('/studentDashboard');
    }

    public function ordinaryTeacherDashboard(){
        return view('teacherhome');
    }

    public function managerTeacherDashboard(){
        return view('/managerTeacherDashboard');
    }
}
