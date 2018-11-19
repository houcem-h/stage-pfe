<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Defense;
use App\Internship;
use App\Registration;
use DB;
use App\Manager;
use Response;
use App\Company;

class PlanningControllerCore extends Controller
{
   public $level;
   public $defencesArray=[];
   public $classroomsArray=[];
   public $juriesArray=[];

   public function __construct($level,$defArray,$classroomsArray,$juriesArray){
       $this->classroomsArray=$classroomsArray;
       $this->juriesArray=$juriesArray;
       $this->level=$level;
       $this->defencesArray=$defArray;
   }

   public static function getFormattedSession(){
        $month=date('m');
         if((int)$month>=9)
             return date('Y').'/'.((int)date('Y')+1);
        
        return ((int)date('Y')-1).'/'.date('Y');
   }

   public static function getFirstDayInitAndPerfInternships($nbr_init_first_day,$nbr_perf_first_day,$allInitAndPerf){
     $initial_init=$allInitAndPerf['init'];
     $initial_perf=$allInitAndPerf['perf'];
     $final_init=self::generateSpecificArray($initial_init,0,$nbr_init_first_day);
     $final_perf=self::generateSpecificArray($initial_perf,0,$nbr_perf_first_day);
     
     return array_merge($final_init,$final_perf);
   }

   public static function getSecondDayInitAndPerfInternships($nbr_init_second_day,$nbr_perf_second_day,$allInitAndPerf){
     $initial_init=$allInitAndPerf['init'];
     $initial_perf=$allInitAndPerf['perf'];
     $final_init=self::generateSpecificArray($initial_init,$nbr_init_second_day-1,$nbr_init_second_day);
     $final_perf=self::generateSpecificArray($initial_perf,$nbr_perf_second_day-1,$nbr_perf_second_day);
    
     return array_merge($final_init,$final_perf);
   }

   public static function generateSpecificArray($array,int $offset,int $length){
      $ret = [];
      $i=$offset;
      $j=1;
      while($j<=$length) {
          $ret[] = $array[$i++];
          $j++;
      }
      return $ret;
   }

    public function getInitAndPerfInternships(){
     $session=self::getFormattedSession();   
     $internshipsInitAndPerf=DB::table('users')->join('registrations','users.id','=','registrations.student')
     ->join('internships','registrations.id','=','internships.student')
     ->where('registrations.session','=',$session)->whereIn('internships.type',['init','perf'])->where("internships.state","=","accepted")->get(['internships.id','internships.type'])->toArray();

      foreach($internshipsInitAndPerf as $value)
         $this->defencesArray[]=$value;   
    }

    public function getHourBeginning($standardDate){
      return  Carbon::createFromTimeStamp(strtotime($standardDate))->hour;
    }

    public function getMinuteBeginning($standardDate){
      return  Carbon::createFromTimeStamp(strtotime($standardDate))->minute;
    }

    public function addMinutes(&$carbonObj,$minToAdd){
      return $carbonObj->addMinutes((int)$minToAdd);
    }

    public function subMinutes(&$carbonObj,$minToSub){
        return $carbonObj->subMinutes((int)$minToSub);
    }

    public static function getPersistentBeginningTime($startTime){
           return Carbon::createFromFormat('H:i', $startTime);
    } 

   public static  function getThisYearFirstLevelInternships(){
      $session=self::getFormattedSession();
      $studentsFirstLevel=DB::table('users')->join('registrations','users.id','=','registrations.student')
      ->join('internships','registrations.id','=','internships.student')
      ->where('registrations.session','=',$session)->where('internships.type','=','init')->where("internships.state","=","accepted")->get(['internships.id','internships.type','internships.company_framer'])->toArray();
        //return dd($studentsFirstLevel);
        return $studentsFirstLevel;
   }

    public static function getThisYearSecondLevelInternships(){
       $session=self::getFormattedSession();
       $studentsSecondLevel=DB::table('users')->join('registrations','users.id','=','registrations.student')
      ->join('internships','registrations.id','=','internships.student')
      ->where('registrations.session','=',$session)->where('internships.type','=','perf')->where("internships.state","=","accepted")->get(['internships.id','internships.company_framer','internships.type'])->toArray();
         
       return $studentsSecondLevel;
    }

    public static function getThisYearFirstAndSecondLevelInternships(){  
       $session=self::getFormattedSession();
      
       $allInternships =Internship::whereHas('registration',function($query)use($session){
            $query->whereHas('studentRecord')->where('session','=',$session);
       })->with('companyFramer.managerCompany')->whereIn('type',['init','perf'])->where("state","accepted")->get(['id','company_framer','type'])->groupBy('type')->all();
       $allInit = [];
       $allPerf = [];
       if(isset($allInternships['init']) && isset($allInternships['perf'])) {
          $allInit = $allInternships['init'];
          $allPerf = $allInternships['perf'];
       }
      return ["init"=>$allInit,"perf"=>$allPerf];
    }

    public static function getMatchingDefences($classroom,$ymdDate,array $level = ["init","perf"]) {
       $defenses =  Defense::whereHas("internships",function($query)use($level) {
           $query->whereIn('type',$level);
       })->where('date_d','>',$ymdDate)->where('classroom',$classroom)->with(['internships.framerRecord'])->orderBy('start_time')->get();
       return $defenses;
    }

   public function groupThemByCompany(){
     $tmp=[];
     for($i=0;$i<count($this->defencesArray);$i++){
           //$companyI=str_replace(' ','',Manager::find($this->defencesArray[$i]->company_framer)->managerCompany->name);
           $companyI=str_replace(' ','',$this->defencesArray[$i]->companyFramer->managerCompany->name);
           $tmp[]=$this->defencesArray[$i];
           $length = count($this->defencesArray);
           for($j=$i+1;$j<$length-1;$j++){
                $companyJ=str_replace(' ','',$this->defencesArray[$j]->companyFramer->managerCompany->name);
            //&& $this->defencesArray[$i]->type==$this->defencesArray[$j]->type
                if(strcasecmp($companyI,$companyJ)==0 ){
                    $tmp[]=$this->defencesArray[$j];
                    $t=$this->defencesArray[count($this->defencesArray)-1];
                    $this->defencesArray[count($this->defencesArray)-1]=$this->defencesArray[$j];
                    $this->defencesArray[$j]=$t;
                    array_pop($this->defencesArray);
                }
            }
       }
    $this->defencesArray=$tmp; 
   }


   public function addCompanyAttr(){
       foreach($this->defencesArray as $value){
           //$value->company=Manager::find($value->company_framer)->managerCompany->name;
       }
   }

    public static function countInternships($level){
     if($level >=1 && $level <=3) {
       $types=['init','perf','pfe'];  
       $type=$types[(int)$level - 1];
       $session=self::getFormattedSession();
       $nbrInternships=DB::table('users')->join('registrations','users.id','=','registrations.student')
       ->join('internships','registrations.id','=','internships.student')
       ->where('internships.type','=',$type)->where('internships.state','=','accepted')->where('registrations.session','=',$session)->count();
      
       return $nbrInternships;
       }
     return 0;
    }

    public static function countInternshipsInitAndPerf() {
       $session=self::getFormattedSession();
       $groupedNbr = DB::table('internships')->join('registrations','internships.student','=','registrations.id')
       ->join('users','users.id','=','registrations.student')->whereIn('internships.type',['init','perf'])
       ->where('registrations.session','=',$session)->where("internships.state","=","accepted")->select('type',DB::raw('count(*) as nbr'))->groupBy('type')->get()->toArray();
    
      $ret = [];
      if(!empty($groupedNbr)) {
        if($groupedNbr[0]->type =='init'){
            $ret[] = $groupedNbr[0]->nbr;
            $ret[] = $groupedNbr[1]->nbr;
        }else{
            $ret[] = $groupedNbr[1]->nbr;
            $ret[] = $groupedNbr[0]->nbr;
        }
      }
      //kanet hakka return $ret;
      return [0,0];
    }

    public static function getClassroomsNumber($legalDurationInDay,$internshipsDurationInDay){
      $res=round($internshipsDurationInDay / $legalDurationInDay);
      if($res==0)
         return 1;

         return $res;
    }

    public function getNbrDefencesPerClassroom($nbrInternships,$nbrClassrooms){
        $resFloor=floor($nbrInternships / $nbrClassrooms);
        $resRemainer=$nbrInternships % $nbrClassrooms;
    
        return [$resFloor,$resRemainer];
    }

   public static function addDurationAttributeToDefenses($defenses,$durationInit,$durationPerf,$durationPfe){
         foreach ($defenses as  $value) {
            if($value->type=="init")
               $value->duration=$durationInit;
            else if($value->type=="perf")
               $value->duration=$durationPerf;
            else 
               $value->duration=$durationPfe;
        }
    }

    public static function getLegalInternshipsDurationInTheDay($start_time,$end_time){
        $start_time=Carbon::parse($start_time);
        $end_time=Carbon::parse($end_time);
        $global_duration=$end_time->diff($start_time)->format('%H:%I');
        $global_duration=self::getPersistentBeginningTime($global_duration);
        return (($global_duration->hour * 60) + $global_duration->minute);
    }

      public static function getNbrInternshipsPerDay(int $level,bool $inverse){
            $types=['init','perf','pfe'];
            $nbrInternships=self::countInternships($level);
         if($nbrInternships > 0) {
            $nbr_internships_per_day=$nbrInternships / 2;
            if($inverse){
                $nbr_in_first_day=floor($nbr_internships_per_day);
                $nbr_in_second_day=($nbrInternships % 2) + $nbr_in_first_day;
            }else{
                $nbr_in_first_day=($nbrInternships % 2) + floor($nbr_internships_per_day);
                $nbr_in_second_day=floor($nbr_internships_per_day);
            }    
          return ['first_day'=>$nbr_in_first_day,'second_day'=>$nbr_in_second_day];
        } 
        return  ['first_day'=>0,'second_day'=>0];
    }

    public static function getNbrInternshipsPerDayForIandP() {
      $nbrInternships = self::countInternshipsInitAndPerf();
      $nbrInitInternships = $nbrInternships[0];
      $nbrPerfInternships = $nbrInternships[1];
      if($nbrInitInternships > 0)
        $nbr_internships_init_per_day=$nbrInitInternships / 2;
      else
        $nbr_internships_init_per_day = 0;

      if($nbrPerfInternships > 0)  
        $nbr_internships_perf_per_day=$nbrPerfInternships / 2;
      else
        $nbr_internships_perf_per_day = 0;

      $nbr_init_in_first_day=floor($nbr_internships_init_per_day);
      $nbr_init_in_second_day=($nbrInitInternships >=2)? (($nbrInitInternships % 2) + $nbr_init_in_first_day) : 0;

      $nbr_perf_in_first_day=($nbrPerfInternships >=2)? (($nbrPerfInternships % 2) + floor($nbr_internships_perf_per_day)) : $nbrPerfInternships;
      $nbr_perf_in_second_day=floor($nbr_internships_perf_per_day);
      $ret =  ['init'=>['first_day'=>$nbr_init_in_first_day,'second_day'=>$nbr_init_in_second_day],'perf'=>['first_day'=>$nbr_perf_in_first_day,'second_day'=>$nbr_perf_in_second_day]];
       //return dd($ret);
      return $ret;
    }

    public static function getPFENbrInternshipsPerDay(int $nbrDays){
        $nbrInternships=self::countInternships(3);
        $nbr_internships_per_day=$nbrInternships / $nbrDays;
        
        if($nbrDays==1){
            return  $nbr_internships_per_day;
        }else if($nbrDays==2){
           $nbr_in_first_day=floor($nbr_internships_per_day);
           $nbr_in_second_day=($nbrInternships % 2) + $nbr_in_first_day; 
           if($nbr_internships_per_day==0)
               return   1;
            return ['first_day'=>$nbr_in_first_day,'second_day'=>$nbr_in_second_day];  
        }else{
           $nbr_in_first_day=floor($nbr_internships_per_day);
           if($nbrInternships % 3 ==1){
               $nbr_in_second_day= $nbr_in_first_day; 
               $nbr_in_third_day= $nbr_in_first_day + 1;
               return ['first_day'=>$nbr_in_first_day,'second_day'=>$nbr_in_second_day,'third_day'=>$nbr_in_third_day];
           }else if($nbrInternships % 3 ==2){
               $nbr_in_second_day= $nbr_in_first_day +1; 
               $nbr_in_third_day= $nbr_in_first_day + 1;
               return ['first_day'=>$nbr_in_first_day,'second_day'=>$nbr_in_second_day,'third_day'=>$nbr_in_third_day];
           }else{
               $nbr_in_second_day= $nbr_in_first_day; 
               $nbr_in_third_day= $nbr_in_first_day;   
               return ['first_day'=>$nbr_in_first_day,'second_day'=>$nbr_in_second_day,'third_day'=>$nbr_in_third_day];     
           }   
        }   
    }

    public function shareClassroomsBetweenDefences($startindex,$arrayinfoclassrooms,$lengthDefencesArray){
          if($lengthDefencesArray - $startindex  == $arrayinfoclassrooms[1]){
             for($i=0;$i<$arrayinfoclassrooms[1];$i++) {
                 $this->defencesArray[$startindex++]->classroom=$this->classroomsArray[$i];
             }
          }else{
             $lengthArrayClassrooms=count($this->classroomsArray);
             for($j=0;$j<$lengthArrayClassrooms;$j++){
                 $this->defencesArray[$startindex++]->classroom=$this->classroomsArray[$j];
              }
             $this->shareClassroomsBetweenDefences($startindex,$arrayinfoclassrooms,$lengthDefencesArray);
          }
    }

    public function shareJuriesBetweenDefences($startindex,$arrayinfoclassrooms,$lengthDefencesArray){
        if($lengthDefencesArray - $startindex  == $arrayinfoclassrooms[1]){
            $j=0;   
            for($i=0;$i<$arrayinfoclassrooms[1];$i++){
                    $this->defencesArray[$startindex]->jurie1=$this->juriesArray[$j];
                    $this->defencesArray[$startindex++]->jurie2=$this->juriesArray[$j+1];
                    $j+=2;
            }    
        }else{
                $lengthja=count($this->juriesArray);
                for($j=0;$j<$lengthja;$j+=2){
                    $this->defencesArray[$startindex]->jurie1=$this->juriesArray[$j];
                    $this->defencesArray[$startindex++]->jurie2=$this->juriesArray[$j+1];
                }
           $this->shareJuriesBetweenDefences($startindex,$arrayinfoclassrooms,$lengthDefencesArray);
        } 
    }

    public function shareTimingBetweenDefences($nbrclass,$nbrextradefences,$startindex,$lengthDefencesArray,$start_time,$generic_start_time,$defenceDuartion){
        if($lengthDefencesArray - $startindex  == $nbrextradefences){
         if($nbrextradefences!=0){
            for($j=$startindex;$j<$lengthDefencesArray;$j++){
                $new_start_time=$this->defencesArray[$startindex-$nbrclass]->end_time;
                $exceptional_start_time=self::getPersistentBeginningTime($new_start_time);
                if($exceptional_start_time->minute==0){
                   $this->defencesArray[$startindex]->start_time=$exceptional_start_time->hour.':00';
                }else{ 
                  if($exceptional_start_time->minute<10) {
                    $this->defencesArray[$startindex]->start_time=$exceptional_start_time->hour.':0'.$exceptional_start_time->minute;
                  }else{
                    $this->defencesArray[$startindex]->start_time=$exceptional_start_time->hour.':'.$exceptional_start_time->minute;
                  }
                }
                $exceptional_end_time=$this->addMinutes($exceptional_start_time,$this->defencesArray[$startindex]->duration);
                if($exceptional_end_time->minute==0){
                   $this->defencesArray[$startindex++]->end_time=$exceptional_end_time->hour.':00';
                }else {
                  if ($exceptional_end_time->minute<10) {
                    $this->defencesArray[$startindex++]->end_time=$exceptional_end_time->hour.':0'.$exceptional_end_time->minute;
                  }else{
                    $this->defencesArray[$startindex++]->end_time=$exceptional_end_time->hour.':'.$exceptional_end_time->minute;
                  }
                }
            }
         }
        }else{
            for($i=0;$i<$nbrclass;$i++){
                if($startindex >= $nbrclass){
                    $new_start_time=$this->defencesArray[$startindex-$nbrclass]->end_time;
                    $generic_start_time=self::getPersistentBeginningTime($new_start_time);
                }
                //$this->defencesArray[$startindex]->start_time=$generic_start_time->hour.':'.$generic_start_time->minute;
                if($generic_start_time->minute==0){
                     $this->defencesArray[$startindex]->start_time=$generic_start_time->hour.':00'; 
                     $str=$generic_start_time->hour.':00';
                }else{ 
                    if($generic_start_time->minute<10){
                       $this->defencesArray[$startindex]->start_time=$generic_start_time->hour.':0'.$generic_start_time->minute; 
                       $str=$generic_start_time->hour.':0'.$generic_start_time->minute;
                    }else {
                       $this->defencesArray[$startindex]->start_time=$generic_start_time->hour.':'.$generic_start_time->minute; 
                       $str=$generic_start_time->hour.':'.$generic_start_time->minute;
                    }
                }
                $refstarttime = $this->getPersistentBeginningTime($str);
                $this->addMinutes($refstarttime,(int)$this->defencesArray[$startindex]->duration);
                if($refstarttime->minute==0){
                    $this->defencesArray[$startindex]->end_time=$refstarttime->hour.':00';
                }else{
                    if($refstarttime->minute< 10)
                      $this->defencesArray[$startindex]->end_time=$refstarttime->hour.':0'.$refstarttime->minute;
                    else
                      $this->defencesArray[$startindex]->end_time=$refstarttime->hour.':'.$refstarttime->minute;
                }    
                $startindex++;   
            }
            $generic_start_time=self::getPersistentBeginningTime($this->defencesArray[$startindex-$nbrclass]->end_time);
            $this->shareTimingBetweenDefences($nbrclass,$nbrextradefences,$startindex,$lengthDefencesArray,$start_time,$generic_start_time,$defenceDuartion);
        }
    }

    public function getPlanning($startTime,$legalDuration,$internshipDuration,$startDate,$internshipsDurationInThatDay){
            foreach($this->defencesArray as $value) 
                $value->start_d=$startDate;
            
            $lengthclassrooms=count($this->classroomsArray);
            $lengthdefarray=count($this->defencesArray);
            $minclassrooms=self::getClassroomsNumber($legalDuration,$internshipsDurationInThatDay);
            $generic_start_time=self::getPersistentBeginningTime($startTime);
            $defencesperclass=$this->getNbrDefencesPerClassroom($lengthdefarray,$minclassrooms);

            $this->shareClassroomsBetweenDefences(0,$defencesperclass,$lengthdefarray);
            $this->shareJuriesBetweenDefences(0,$defencesperclass,$lengthdefarray);
            $this->shareTimingBetweenDefences($lengthclassrooms,$defencesperclass[1],0,$lengthdefarray,$startTime,$generic_start_time,$internshipDuration);
    }

    public static function doPFEPlanning(array $classrooms,int $duration){
     $defensesArray=[];
     $allJuries = [];
     $session= self::getFormattedSession();
     foreach($classrooms as $class) {
         if(array_key_exists('juries',$class))
           $allJuries = array_merge($allJuries,array_values($class['juries']));
     }
     $dataInternships = Internship::where('type','pfe')->whereHas('registration',function($query)use($session){
        $query->where("session",$session);
     })->where('state',"=","accepted")->whereIn('framer',$allJuries)->get()->groupBy('framer')->all();
     foreach($classrooms as $value){
       if(array_key_exists('juries',$value)){
         $juries=$value['juries'];
         $start_time=Carbon::createFromFormat('H:i',$value['start_time']);
         foreach($juries as $key => $jurie){
            if(array_key_exists($jurie,$dataInternships)) {
                $defensesOfJurie = $dataInternships[$jurie];
                $i=0;
                foreach($defensesOfJurie as $internship){
                    $defense=new \StdClass;
                    $defense->start_date=$value["start_date"];
                    $defense->start_time=$start_time->hour.':'.$start_time->minute;
                    $start_time->addMinutes($duration);
                    $defense->end_time=$start_time->hour.':'.$start_time->minute;
                    $defense->classroom=$value['classroom'];
                    $defense->internship=$internship->id;
                    if($key=='jurie1'){
                        $i++;
                        if($i % 2 ==0){
                            $defense->president=$juries['jurie2'];
                            $defense->reporter=$juries['jurie3']; 
                        }else{
                            $defense->president=$juries['jurie3'];
                            $defense->reporter=$juries['jurie2']; 
                        }
                    }else if($key=='jurie2'){
                        $i++;
                        if($i % 2 ==0){
                            $defense->president=$juries['jurie1'];
                            $defense->reporter=$juries['jurie3']; 
                        }else{
                            $defense->president=$juries['jurie3'];
                            $defense->reporter=$juries['jurie1'];
                        }
                    }else{
                        $i++;
                        if($i % 2 ==0){
                            $defense->president=$juries['jurie1'];
                            $defense->reporter=$juries['jurie2']; 
                        }else{
                            $defense->president=$juries['jurie2'];
                            $defense->reporter=$juries['jurie1'];                            
                        }  
                    }
                  $defensesArray[]=$defense;
                }
            }
          }
       }
     }
     return $defensesArray;
    }

    public static function shiftDefense(&$defArray,int $mooved_def_index,int $target_def_index,bool $avanti,bool $after) {
        if($avanti) {
            for ($i=$mooved_def_index;$i<$target_def_index;$i++) {
                $tmp = $defArray[$i+1];
                $defArray[$i+1] = $defArray[$i];
                $defArray[$i] = $tmp;
            }
        }else{
            if($after) {
                for($i=$mooved_def_index;$i>($target_def_index+1);$i--) {
                    $tmp = $defArray[$i-1];
                    $defArray[$i-1] = $defArray[$i];
                    $defArray[$i] = $tmp;
                }
            }else {
                for($i=$mooved_def_index;$i>$target_def_index;$i--) {
                    $tmp = $defArray[$i-1];
                    $defArray[$i-1] = $defArray[$i];
                    $defArray[$i] = $tmp;
                }
            }
        }
  }

   public static function insertDefenseAt(array &$defArray,Defense $def,int $index,bool $after) {
      $length = count($defArray);
      if($index == ($length - 1)){
        array_push($defArray,$def);
      }else{
        $ret = [];
        $i=$j=0;
        while($i<$length) {
          if($j == $index) {
            if(!$after) 
              $ret[$j] = $def;
            else 
              $ret[$j] = $defArray[$i++];
          }else if($j == ($index+1)) {
            if($after)
              $ret[$j] = $def;
            else 
              $ret[$j] = $defArray[$i++];
          }else{ 
             $ret[$j] = $defArray[$i++];
          }
          $j++;   
        }
        $defArray = $ret;
      }  
   }

  public static function repareTiming($defArray,string $start_time) {
      $start_time = Carbon::parse($start_time);
      foreach($defArray as $def) {
        $end_time = Carbon::parse($def->end_time);
        $cur_def_start = Carbon::parse($def->start_time);
        $duration = $end_time->diff($cur_def_start)->format('%H:%I');
        $duration=self::getPersistentBeginningTime($duration);
        if($start_time->minute==0) {
           $def->start_time = $start_time->hour.':00:00';
        }else{
            if($start_time->minute <10){
               $def->start_time = $start_time->hour.':0'.$start_time->minute.':00';
            }else { 
               $def->start_time = $start_time->hour.':'.$start_time->minute.':00';
            }
        }
        $end_time = $start_time->addMinutes($duration->minute);
        if($end_time->minute==0) {
            $def->end_time = $end_time->hour.':00:00';
        }else{
            if($end_time->minute<10){
               $def->end_time = $end_time->hour.':0'.$end_time->minute.':00';
            }else {
               $def->end_time = $end_time->hour.':'.$end_time->minute.':00';
            }
        }
        $start_time = $end_time;
      }
  }

   public static function repareDefensesJuries($defenses) {
      $juries = [
          "jury1"=>$defenses[0]->reporter,
          "jury2"=>$defenses[0]->president,
          "jury3"=>$defenses[0]->internships->framerRecord->id
      ];
      $i=$j=$k=0;
      foreach($defenses as $def) {
        $framer = $def->internships->framerRecord->id;
        if($framer == $juries["jury1"]){
          $i++;
          if($i % 2 ==0){
            $def->president=$juries['jury2'];
            $def->reporter=$juries['jury3']; 
          }else{
            $def->president=$juries['jury3'];
            $def->reporter=$juries['jury2']; 
          }
        }else if($framer == $juries["jury2"]){
           $j++;
           if($j % 2 ==0){
             $def->president=$juries['jury1'];
             $def->reporter=$juries['jury3']; 
           }else{
             $def->president=$juries['jury3'];
             $def->reporter=$juries['jury1'];
           }
        }else{
          $k++;
          if($k % 2 ==0){
            $def->president=$juries['jury1'];
            $def->reporter=$juries['jury2']; 
          }else{
             $def->president=$juries['jury2'];
             $def->reporter=$juries['jury1'];                            
          }  
        }
      }
    }

   public static function mooveDefense(int $idMoovedDefense,int $idTargetDefense,bool $avanti,bool $after,bool $isPFE=false) {
      $moovedDefense = Defense::find($idMoovedDefense);
      $targetDefense = Defense::find($idTargetDefense);
      $classroomMoovedDefense = $moovedDefense->classroom;
      $classroomTargetDefense = $targetDefense->classroom;
      $sameClassroom = $classroomMoovedDefense === $classroomTargetDefense;
      $currentDate=date('Y-m-d');
      $level;
      if($isPFE)
       $level = ['pfe'];
      else
        $level = ['init','perf'];

        $sourceClassroomDefenses = self::getMatchingDefences($classroomMoovedDefense,$currentDate,$level);
      //if(!$isPFE && !$sameClassroom) {
        $targetClassroomDefenses = self::getMatchingDefences($classroomTargetDefense,$currentDate,$level);
        $targetDefenseIndex = self::getDefenseIndex($targetClassroomDefenses->toArray(),$targetDefense->start_time);
      //}      
      $moovedDefenseIndex= self::getDefenseIndex($sourceClassroomDefenses->toArray(),$moovedDefense->start_time);
      if($sameClassroom) {
        $start_time = self::getClassroomFirstDefenseStart($sourceClassroomDefenses);
        self::shiftDefense($sourceClassroomDefenses,$moovedDefenseIndex,$targetDefenseIndex,$avanti,$after);
        self::repareTiming($sourceClassroomDefenses ,$start_time);
        if($isPFE)
          self::repareDefensesJuries($sourceClassroomDefenses);

      }else{
          $firstClassStartTime = self::getClassroomFirstDefenseStart($sourceClassroomDefenses);
          $secondClassStartTime = self::getClassroomFirstDefenseStart($targetClassroomDefenses);
          self::deleteDefenseAt($sourceClassroomDefenses,$moovedDefense->id);
          $moovedDefense->classroom = $targetDefense->classroom;
          $worker= [];
          foreach($targetClassroomDefenses as $defRef) {
               $worker[] = $defRef;
          }
          self::insertDefenseAt($worker,$moovedDefense,$targetDefenseIndex,$after);
          self::repareTiming($sourceClassroomDefenses,$firstClassStartTime);
          self::repareTiming($worker,$secondClassStartTime);
          self::persist($worker);
      }
      return self::persist($sourceClassroomDefenses);
    }

    public static function getClassroomFirstDefenseStart($defenses) {
        $ret = Carbon::parse($defenses[0]->start_time);
        foreach ($defenses as $def) {
            $tmp = Carbon::parse($def->start_time);
            if(!$tmp->greaterThan($ret))
                $ret = $tmp;
        }
        if($ret->minute == 0)  return $ret->hour.':00:00';
          
     return $ret->hour.':'.$ret->minute.':00' ;
    }

    public static function persist($defensesArray) {
        try{
          foreach($defensesArray as $def) {
            $def->save();
          }
        }catch(Exception $e) {
            return false;
        }
        return true;
    }

    public static function getDefenseIndex(array $defensesArray,string $start_time) {
      $index=-1;
      $length = count($defensesArray);
      for ($i=0;$i<$length;$i++) {
         if($defensesArray[$i]['start_time'] == $start_time)
           return $i;
      }
      return $index;
    }

    public static function deleteDefenseAt(&$defArray,int $moovedDefId) {
       $defArray = $defArray->keyBy('id');
       $defArray->forget($moovedDefId);
    }

    public function save(){
       foreach($this->defencesArray as $value){
            $defense=new Defense();
            $defense->date_d=$value->start_d;
            $defense->start_time=$value->start_time;
            $defense->end_time=$value->end_time;
            $defense->classroom=$value->classroom;
            $defense->internship=$value->id;
            $defense->reporter=$value->jurie1;
            $defense->president=$value->jurie2;
            $defense->created_by=auth()->user()->id;
            $defense->save();
        }
        return true;
    }

    public static function savePFEPlanning($defensesArray){
         foreach($defensesArray as $value){
            $defense=new Defense();
            $defense->date_d=$value->start_date;
            $defense->start_time=$value->start_time;
            $defense->end_time=$value->end_time;
            $defense->classroom=$value->classroom;
            $defense->internship=$value->internship;
            $defense->reporter=$value->reporter;
            $defense->president=$value->president;
            $defense->created_by=auth()->user()->id;
            $defense->save();
         }        
        return true;   
    }
}
