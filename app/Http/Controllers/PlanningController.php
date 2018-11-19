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
use App\Internship;
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
        $lev = $request->input('l');
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
       $nbrInitAndPerfInterPerDay = PlanningCore::getNbrInternshipsPerDayForIandP();
  
       $nbr_init_internships_first_day= $nbrInitAndPerfInterPerDay["init"]['first_day'];
       $nbr_init_internships_second_day=$nbrInitAndPerfInterPerDay["init"]['second_day'];

       $nbr_perf_internships_first_day=$nbrInitAndPerfInterPerDay["perf"]['first_day'];
       $nbr_perf_internships_second_day=$nbrInitAndPerfInterPerDay["perf"]['second_day'];

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
         'level'=>$lev,
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
         * route that generates a view for editing plannings of defences
         */
         public function getEditPlanningsView() {
             $session = PlanningCore::getFormattedSession();
             $defenses=Defense::whereHas('internships',function($query)use($session){
               $query->whereHas('registration',function($q)use($session) {
                   $q->where('session','=',$session);
               })->whereIn('type',['init','perf']);
            })->with(['reporterRecord','presidentRecord','internships.registration.studentRecord','internships.companyFramer.managerCompany','internships.registration.groupRecord'])->orderBy('date_d')->orderBy('start_time')->get()->groupBy('classroom')->all();

           return view('planning.edit')->with('defenses',$defenses);
         }


        public function editDefensesOrder(Request $request) {
            if($request->ajax()) {
                $test = true;
                $changes = json_decode($request->input('changes'),true);
                foreach($changes as $change) {
                   $test = PlanningCore::mooveDefense((int)$change['idMoovedDef'],(int)$change['idTargetDef'],(bool)$change['avanti'],(bool)$change['after']);
                   if(!$test) 
                     break;
                }
                if($test)
                  return Response::json(["success"=>"benne"],"200");
                else
                  return Response::json(["error"=>"benne"],"500");
            }
        }

        public function editPfeDefensesOrder(Request $request) {
            if($request->ajax()) {
                $test = true;
                $changes = json_decode($request->input('changes'),true);
                foreach($changes as $change) {
                   $test = PlanningCore::mooveDefense((int)$change['idMoovedDef'],(int)$change['idTargetDef'],(bool)$change['avanti'],(bool)$change['after'],true);
                   if(!$test) 
                     break;
                }
                if($test)
                  return Response::json(["success"=>"benne"],"200");
                else
                  return Response::json(["error"=>"benne"],"500");
            }            
        }

        public function pfeEditView() {
            $session = PlanningCore::getFormattedSession();
            $defenses=Defense::whereHas('internships',function($query)use($session){
              $query->whereHas('registration',function($q)use($session){
                $q->where('session','=',$session);
              })->where('type','pfe');
             })->with(['reporterRecord','presidentRecord','internships.framerRecord','internships.companyFramer.managerCompany','internships.registrationSecondStudent.studentRecord','internships.registration.studentRecord'])->orderBy('date_d')->orderBy('start_time')->get()->groupBy('classroom')->all();
           
            return view('planning.editPFE')->with('defenses',$defenses);
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
         $l=['init','perf','pfe'];
         $level=Req::instance()->get('l');
         if($level < 1 || $level > 3)
           $level =1;
  
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
    public function create(){
        //here we return the view submitted to the store method
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if($request->ajax()){
              $array_juries_first_day=$request->input('juries_first_day');
              $array_juries_second_day=$request->input('juries_second_day');
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

              $nbrInitAndPerfInterPerDay = PlanningCore::getNbrInternshipsPerDayForIandP();
              $allInitAndPerf = PlanningCore::getThisYearFirstAndSecondLevelInternships();
              
              $first_day_init_and_perf_internships=PlanningCore::getFirstDayInitAndPerfInternships($nbrInitAndPerfInterPerDay['init']['first_day'],$nbrInitAndPerfInterPerDay['perf']['first_day'],$allInitAndPerf);
              PlanningCore::addDurationAttributeToDefenses($first_day_init_and_perf_internships, $init_duration,$perf_duration,"50");
              $duration_internships_in_first_day=($nbrInitAndPerfInterPerDay['init']['first_day'] * $init_duration)+($nbrInitAndPerfInterPerDay['perf']['first_day'] * $perf_duration);
            
              $planningCore=new PlanningCore($level,$first_day_init_and_perf_internships,$array_classrooms_first_day,$array_juries_first_day);
              $planningCore->groupThemByCompany();
              $planningCore->getPlanning($start_time_first_day,$legal_duration_first_day,0, $start_date_first_day, $duration_internships_in_first_day);
              $res1 = $planningCore->save();

              $second_day_init_and_perf_internships=PlanningCore::getSecondDayInitAndPerfInternships($nbrInitAndPerfInterPerDay['init']['second_day'],$nbrInitAndPerfInterPerDay['perf']['second_day'],$allInitAndPerf);
              PlanningCore::addDurationAttributeToDefenses($second_day_init_and_perf_internships, $init_duration,$perf_duration,"50");
              $duration_internships_in_second_day=($nbrInitAndPerfInterPerDay['init']['second_day'] * $init_duration)+($nbrInitAndPerfInterPerDay['perf']['second_day'] * $perf_duration);
              
              $planningCoreSecondDay=new PlanningCore($level,$second_day_init_and_perf_internships,$array_classrooms_second_day,$array_juries_second_day);
              $planningCoreSecondDay->groupThemByCompany();
              $planningCoreSecondDay->getPlanning($start_time_second_day,$legal_duration_second_day,0, $start_date_second_day, $duration_internships_in_second_day);
              $res2 = $planningCoreSecondDay->save();
              if($res1 && $res2) {
                 return Response::json(['success'=>"planning done"],'200');
              }else{
                 return Response::json(['errors'=>"une erreur est survenu lors de la planification des soutenances ressayer"],'500');
              }
            }
    }

   //testing purpose
   public function test(Request $request) {
    
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $session = PlanningCore::getFormattedSession();
        if($id==1){
            $planning=Defense::whereHas('internships',function($query)use($session){
               $query->whereHas('registration',function($q)use($session) {
                   $q->where('session','=',$session);
               })->whereIn('type',['init','perf']);
            })->with(['reporterRecord','presidentRecord','internships.registration.studentRecord','internships.companyFramer.managerCompany','internships.registration.groupRecord'])->orderBy('date_d')->orderBy('start_time')->get()->groupBy('classroom')->all();
            if(count($planning)==0)
              return redirect('/planning?l=1');
            return view('planning.show')->with('planning',$planning);
        }else{
             $planning=Defense::whereHas('internships',function($query)use($session){
               $query->whereHas('registration',function($q)use($session){
                    $q->where('session','=',$session);
               })->where('type','pfe');
             })->with(['reporterRecord','presidentRecord','internships.framerRecord','internships.companyFramer.managerCompany','internships.registrationSecondStudent.studentRecord','internships.registration.studentRecord'])->orderBy('date_d')->orderBy('start_time')->get()->groupBy('classroom')->all();
            //return dd($planning);
             if(count($planning)==0) { return redirect('/planningpfe'); }
              
           return view('planning.showPFE')->with('planning',$planning);           
        }
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
       }else{
             $defences=Defense::whereHas('internships',function($query){
                $query->where('type','=','pfe');
            })->where('date_d','>',date('Y-m-d'))->get();
            if($defences!=null)
                    foreach($defences as $def)
                        $def->delete();          
       }
        return redirect('/dashboard')->with('success','Planning deleted');
    }

    public function pfeRestrictions(Request $request){
        $this->validate($request,[
         'date_first_day'=>'required',
         'start_time_first_day'=>'required',
         'end_time_first_day'=>'required',
         'pfe_duration'=>'required'
        ]);
        $nbrDays=$request->input('nbrdays');
        $pfe_duration=(int)$request->input('pfe_duration');

        $date_first_day=$request->input('date_first_day');
        $start_time_first_day=$request->input('start_time_first_day');
        $end_time_first_day=$request->input('end_time_first_day');

        $date_second_day=$request->input('date_second_day');
        $start_time_second_day=$request->input('start_time_second_day');
        $end_time_second_day=$request->input('end_time_second_day');
        
        $date_third_day=$request->input('date_third_day');
        $start_time_third_day=$request->input('start_time_third_day');
        $end_time_third_day=$request->input('end_time_third_day');  

        $data_for_view=[
           'nbr_days'=>$nbrDays,
           'date_first_day'=>$date_first_day,
           'start_time_first_day'=>$start_time_first_day,
           'date_second_day'=>  $date_second_day,
           'start_time_second_day'=>$start_time_second_day,
           'date_third_day'=>$date_third_day,
           'start_time_third_day'=>$start_time_third_day,
           'duration'=>$pfe_duration
        ];
        if((int)$nbrDays==2){
          $first_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_first_day,$end_time_first_day);  
          $second_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_second_day,$end_time_second_day);
          $nbr_internships_per_day=PlanningCore::getPFENbrInternshipsPerDay($nbrDays);
          $nbr_internships_first_day=$nbr_internships_per_day['first_day'];
          $nbr_internships_second_day=$nbr_internships_per_day['second_day'];
          $duration_in_first_day=$pfe_duration * $nbr_internships_first_day;
          $duration_in_second_day=$pfe_duration * $nbr_internships_second_day;
          $day_1_classrooms_nbr=PlanningCore::getClassroomsNumber($first_day_legal_internships_duration,$duration_in_first_day);
          $day_2_classrooms_nbr=PlanningCore::getClassroomsNumber($second_day_legal_internships_duration,$duration_in_second_day);
          $data_for_view['nbr_classrooms_first_day']=$day_1_classrooms_nbr;
          $data_for_view['nbr_classrooms_second_day']=$day_2_classrooms_nbr;
        }else if((int)$nbrDays==3){
          $first_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_first_day,$end_time_first_day);  
          $second_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_second_day,$end_time_second_day);
          $third_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_third_day,$end_time_third_day);        
          $nbr_internships_per_day=PlanningCore::getPFENbrInternshipsPerDay($nbrDays);
          $nbr_internships_first_day= $nbr_internships_per_day['first_day'];
          $nbr_internships_second_day=$nbr_internships_per_day['second_day'];          
          $nbr_internships_third_day=$nbr_internships_per_day['third_day'];         
          $duration_in_first_day=$pfe_duration * $nbr_internships_first_day;
          $duration_in_second_day=$pfe_duration * $nbr_internships_second_day;
          $duration_in_third_day=$pfe_duration * $nbr_internships_third_day;
          $day_1_classrooms_nbr=PlanningCore::getClassroomsNumber($first_day_legal_internships_duration,$duration_in_first_day);
          $day_2_classrooms_nbr=PlanningCore::getClassroomsNumber($second_day_legal_internships_duration,$duration_in_second_day);          
          $day_3_classrooms_nbr=PlanningCore::getClassroomsNumber($third_day_legal_internships_duration,$duration_in_third_day);        
          $data_for_view['nbr_classrooms_first_day']=$day_1_classrooms_nbr;
          $data_for_view['nbr_classrooms_second_day']=$day_2_classrooms_nbr;
          $data_for_view['nbr_classrooms_third_day']=$day_3_classrooms_nbr;
        }else{
          $first_day_legal_internships_duration=PlanningCore::getLegalInternshipsDurationInTheDay($start_time_first_day,$end_time_first_day);
          $nbr_internships_first_day=PlanningCore::getPFENbrInternshipsPerDay($nbrDays);
          $duration_in_first_day=$pfe_duration *$nbr_internships_first_day;
          $day_1_classrooms_nbr=PlanningCore::getClassroomsNumber($first_day_legal_internships_duration,$duration_in_first_day);
          $data_for_view['nbr_classrooms_first_day']=$day_1_classrooms_nbr;
        }
       // $year=date('Y');
        $session = PlanningCore::getFormattedSession();
        $framers=User::whereHas('framerOf',function($query)use($session){
           $query->where('type','pfe')->whereHas('registration',function($q)use($session){
               $q->where('session',$session);
           });
        })->where('role','!=','0')->get()->toArray();

        $teachersnotframers=User::whereDoesntHave('framerOf',function($query)use($session){
            $query->where('type','pfe')->whereHas('registration',function($q)use($session){
              $q->where('session',$session);
            }); 
        })->where('role','!=','0')->get()->toArray();

    return view('planning.sharingpfesubjectbetweenclassrooms')->with('data',$data_for_view)->with('framers',$framers)->with('notframers',$teachersnotframers);
    }

    public function pfePlanningStore(Request $request){
           if($request->ajax()){
              $duration=(int)$request->input('duration');
              $classrooms=$request->input('classrooms');
              $defensesArray=PlanningCore::doPFEPlanning($classrooms,$duration);
              if(PlanningCore::savePFEPlanning($defensesArray))
                 return Response::json($defensesArray,'200');
           }   
    }
}
