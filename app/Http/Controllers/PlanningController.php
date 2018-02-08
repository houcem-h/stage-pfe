<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PlanningControllerCore as PlanningCore;
use Carbon\Carbon;
use DB;
use App\User;
use App\Defense;
use App\Manager;
use App\Company;
class PlanningController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('AdminAccessRights');
  }

    public function restrictions(Request $request){
        $this->validate($request,[
            'startdate'=>'required|date',
            'starttime'=>'required',
            'endtime'=>'required',
            'defenceduration'=>'required',
            'startdate2'=>'required',
            'starttimesecondday'=>'required',
            'endtimesecondday'=>'required',
            'defenceperfduration'=>'required'
        ]); 
        
       $juries=User::where('role','=','1')->get();
       $start_date_first_day=$request->input('startdate');
       $start_date_second_day=$request->input('startdate2');

       $init_internship_duration=(int)$request->input('defenceduration');
       $perf_internship_duration=(int)$request->input('defenceperfduration');
  
       $start_time_first_day=$request->input('starttime');
       $end_time_first_day=$request->input('endtime');
       $start_time_second_day=$request->input('starttimesecondday');
       $end_time_second_day=$request->input('endtimesecondday');

       $first_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_first_day,$end_time_first_day);
       $second_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_second_day,$end_time_second_day);

       $init_internships_per_day=PlanningCore::getNbrInternshipsPerDay(1,false);
       $nbr_init_internships_first_day= $init_internships_per_day['first_day'];
       $nbr_init_internships_second_day=$init_internships_per_day['second_day'];
         
       $perf_internships_per_day=PlanningCore::getNbrInternshipsPerDay(2,true);
       $nbr_perf_internships_first_day=$perf_internships_per_day['first_day'];
       $nbr_perf_internships_second_day=$perf_internships_per_day['second_day'];

       $duration_internships_in_first_day=($nbr_init_internships_first_day * $init_internship_duration)+($nbr_perf_internships_first_day * $perf_internship_duration);
       $duration_internships_in_second_day=($nbr_perf_internships_second_day * $perf_internship_duration)+($nbr_init_internships_second_day * $init_internship_duration);
       
       $required_classrooms_first_day=PlanningCore::getClassroomsNumber($first_day_legal_internships_duration, $duration_internships_in_first_day);
       $required_classrooms_second_day=PlanningCore::getClassroomsNumber($second_day_legal_internships_duration,$duration_internships_in_second_day);
       
       $first_day_nbr_juries_required=$required_classrooms_first_day * 2;
       $second_day_nbr_juries_required=$required_classrooms_second_day *2;

       $data_view_required=[
         "done"=>"false",
         'nbr_salles_first_day'=> $required_classrooms_first_day,
         'nbr_salles_second_day'=>$required_classrooms_second_day,
         'nbr_juries_first_day'=> $first_day_nbr_juries_required,
         'nbr_juries_second_day'=>$second_day_nbr_juries_required,
         'juries'=>$juries,
         'start_date_first_day'=>$start_date_first_day,
         'start_date_second_day'=>$start_date_second_day,
         'level'=>$request->input('l'),
         'start_time_first_day'=>$start_time_first_day,
         'start_time_second_day'=>$start_time_second_day,
         'end_time_first_day'=>$end_time_first_day,
         'end_time_second_day'=>$end_time_second_day,
         'init_duration'=>$init_internship_duration,
         'perf_duration'=>$perf_internship_duration,
         'legal_duration_first_day'=>$first_day_legal_internships_duration,
         'legal_duration_second_day'=>$second_day_legal_internships_duration,
        ];
       return view('planning.index')->with($data_view_required);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $l=['init','perf','pfe'];
         $level=Req::instance()->get('l');
        //  $defences=DB::table('defenses as d')->join('internships as i','d.internship','=','i.id')->where('d.date_d','>',date('Y-m-d'))->where('i.type','=',$l[$level-1])->first(['d.created_by']);
         $defenses=Defense::whereHas('internships',function($query)use($l,$level){
            $query->where('type','=',$l[$level-1]);
         })->where('date_d','>',date('Y-m-d'))->get()->toArray();
         if(count($defenses) >0)
            $creator=$defenses[0]['created_by'];
         if($defenses!=null)
            return view('planning.index')->with('done',User::find($creator));
          
         return view('planning.index')->with('done','false');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //here we return the view submitted to the store method
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

        ]);
        if($request->ajax()){
            
              $array_juries_first_day=$request->input('juries_first_day');
              $array_juries_second_day=$request->input('juries_second_day');
            //   return Response::json( $array_juries_second_day);
              $array_classrooms_first_day=$request->input('classrooms_first_day');
              $array_classrooms_second_day=$request->input('classrooms_second_day');
              $start_time_first_day=$request->input('start_time_first_day');
              $start_time_second_day=$request->input('start_time_second_day');
              $legal_duration_first_day=$request->input('legal_duration_first_day');
              $legal_duration_second_day=$request->input('legal_duration_second_day');
              $init_duration=$request->input('init_duration');
              $perf_duration=$request->input('perf_duration');
              $start_date_first_day=$request->input('start_date_first_day');
              $start_date_second_day=$request->input('start_date_second_day');
              $level=$request->input('level');

              $init_internships_per_day=PlanningCore::getNbrInternshipsPerDay(1,false);
              $perf_internships_per_day=PlanningCore::getNbrInternshipsPerDay(2,true);

              $first_day_init_and_perf_internships=PlanningCore::getFirstDayInitAndPerfInternships($init_internships_per_day['first_day'],$perf_internships_per_day['first_day']);
              $second_day_init_and_perf_internships=PlanningCore::getSecondDayInitAndPerfInternships($init_internships_per_day['second_day'],$perf_internships_per_day['second_day']);
        
              PlanningCore::addDurationAttributeToDefenses($first_day_init_and_perf_internships, $init_duration,$perf_duration,"50");
              PlanningCore::addDurationAttributeToDefenses($second_day_init_and_perf_internships, $init_duration,$perf_duration,"50");
              
              $duration_internships_in_first_day=($init_internships_per_day['first_day'] * $init_duration)+($perf_internships_per_day['first_day'] * $perf_duration);
              $duration_internships_in_second_day=($perf_internships_per_day['second_day'] * $perf_duration)+($init_internships_per_day['second_day'] * $init_duration);
              
              $planningCore=new PlanningCore($level,$first_day_init_and_perf_internships,$array_classrooms_first_day,$array_juries_first_day);
              $planningCore->groupThemByCompany();
              $planningCore->getPlanning($start_time_first_day,$legal_duration_first_day,0, $start_date_first_day, $duration_internships_in_first_day);
              $planningCore->addCompanyAttr();

              $planningCoreSecondDay=new PlanningCore($level,$second_day_init_and_perf_internships,$array_classrooms_second_day,$array_juries_second_day);
              $planningCoreSecondDay->groupThemByCompany();
              $planningCoreSecondDay->getPlanning($start_time_second_day,$legal_duration_second_day,0, $start_date_second_day, $duration_internships_in_second_day);
              $planningCoreSecondDay->addCompanyAttr(); 
    
              if($planningCore->save()  && $planningCoreSecondDay->save())
                 return Response::json(['success'=>"planning done"],'200');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $planning=Defense::whereHas('internships',function($query){
           $query->where('type','init')->orWhere('type','perf');
        })->where('date_d','>',date('Y-m-d'))->get()->groupBy('classroom');

       return view('planning.show')->with('planning',$planning->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //here we save the admin updates
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if($id==1){
            $defences=Defense::whereHas('internships',function($query){
                $query->where('type','=','init')->orWhere('type','=','perf');
            })->where('date_d','>',date('Y-m-d'))->get();
            if($defences!=null)
                    foreach($defences as $def)
                        $def->delete();
       }
        return redirect(auth()->user()->Dashboard)->with('success','Planning deleted');
    }
}
