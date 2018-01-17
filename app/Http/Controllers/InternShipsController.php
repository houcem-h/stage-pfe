<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use Illuminate\Support\Facades\Schema;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Internship;
use DB;

class InternShipsController extends Controller
{
   public function __construct(){
      $this->middleware('StudentAccessRights')->except('index','show');
      $this->middleware('AdminAccessRights')->only('index','show');
   }

   public function getFormattedSession(){
        $year=date('Y');
        $afterString=(int)$year+1;
       return $year.'/'.$afterString;
   }

    public function generateDesiredArray(array $baseArray){
        $resultArray=[];
        foreach($baseArray as $key=>$value)
            $resultArray[$value['id']]=$value['firstname']." ".$value['lastname'];
    
        return $resultArray;
    }

     public function studentLevel($ch){
        for($i=0;$i<strlen($ch);$i++){
            if(ctype_digit(substr($ch,$i,1)))
              return substr($ch,$i,1);
        }
        return -1;
     }

   public function create(){
       $teachers=User::where('role',1)->get()->toArray();
       $arrayTeachers=$this->generateDesiredArray($teachers);
       return view('internships.create')->with('teachers',$arrayTeachers);
   }


    public function store(Request $request,$companyFramer=null){
        $this->validate($request,[
          'start_date'=>'required|date',
          'end_date'=>'required|date',
          'type'=>'required',
          'framer'=>'required|numeric',
          'cm'=>'required|numeric'
        ]);

        $year=date('Y');
        $fullYearString=$this->getFormattedSession();
        $formattedYear=(int)((int)$year-1).'/'.$year;
        $internship=new Internship();
        $registration=Registration::where('student',auth()->user()->id)->where(function ($query) use($fullYearString,$formattedYear){
            return $query->where('session',$fullYearString)->orWhere('session',$formattedYear);
        })->first();

        $internship->student=$registration->id;
        $internship->start_date=$request->input('start_date');
        $internship->end_date=$request->input('end_date');
        $internship->framer=$request->input('framer');
        $internship->company_framer=$request->input('cm');
        $internship->type=$request->input('type');
        $internship->created_by=auth()->user()->id;
        if($internship->save()){
        if($request->ajax())
             return response(['demande enregistré','200']);

          return redirect(auth()->user()->Dashboard)->with('success','demande enregistré');
        }
        return  back();
    }


    public function edit(Request $request,$id){
        $internship=Internship::find($id); 
        $managerTeachers=User::where('role',1)->get(['id','firstname','lastname'])->toArray();
        $managerTeachers=$this->generateDesiredArray($managerTeachers);
        $framerRecord=$internship->framer;
        Session::put('framerRecord',$framerRecord);
        return view('internships.edit')->with('internship',$internship)->with('managerTeachers',$managerTeachers);
    }

    public function update(Request $request,$id){
            $this->validate($request,[
                'start_date'=>'required|date',
                'end_date'=>'required|date',
                'framer'=>'required'
             ]);
                $internship=Internship::find($id);
                $internship->updated_by=auth()->user()->id;
                $internship->start_date=$request->input('start_date');
                $internship->end_date=$request->input('end_date'); 
                $internship->framer=$request->input('framer');   
                $companyManager=$internship->company_framer;       
                $internship->save();
                if($request->ajax()){

                }
        return redirect('/companiesmanagers/'.$companyManager.'/edit');
    }


    public function index(Request $request){
       $internships=Internship::whereYear('created_at','>=',date('Y'))->paginate(10);
       return view('internships.index')->with('internships',$internships);
    }


    public function show($id,Request $request){
          $internship=Internship::find($id);
          return view('internships.show')->with('internship',$internship);
    }
}
