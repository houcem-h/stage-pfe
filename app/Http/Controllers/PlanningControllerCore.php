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

   public static function getFirstDayInitAndPerfInternships($nbr_init_first_day,$nbr_perf_first_day){
     $initial_init=self::getThisYearFirstLevelInternships();
     $initial_perf=self::getThisYearSecondLevelInternships();
     $final_init=self::generateSpecificArray($initial_init,0,$nbr_init_first_day);
     $final_perf=self::generateSpecificArray($initial_perf,0,$nbr_perf_first_day);
     $res=[];
       foreach($final_init as $val)
          $res[]=$val;
       foreach ($final_perf as  $val) 
          $res[]=$val;

    return $res;
   }

   public static function getSecondDayInitAndPerfInternships($nbr_init_second_day,$nbr_perf_second_day){
     $initial_init=self::getThisYearFirstLevelInternships();
     $initial_perf=self::getThisYearSecondLevelInternships();
     $final_init=self::generateSpecificArray($initial_init,$nbr_init_second_day-1,$nbr_init_second_day);
     $final_perf=self::generateSpecificArray($initial_perf,$nbr_perf_second_day-1,$nbr_perf_second_day);
     $res=[];
       foreach($final_init as $val)
          $res[]=$val;
       foreach ($final_perf as  $val) 
          $res[]=$val;

    return $res;
   }

   public static function generateSpecificArray(array $array,int $offset,int $length){
      return array_slice($array,$offset,$length);
   }

    public function getInitAndPerfInternships(){
     $session=((int)date('Y')-1).'/'.date('Y');   
     $internshipsInitAndPerf=DB::table('users')->join('registrations','users.id','=','registrations.student')
     ->join('internships','registrations.id','=','internships.student')
     ->where('registrations.session','=',$session)->where('internships.type','=','init')->orWhere('internships.type','=','perf')->get(['internships.id','internships.type'])->toArray();

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
      $session=((int)date('Y')-1).'/'.date('Y');
      $studentsFirstLevel=DB::table('users')->join('registrations','users.id','=','registrations.student')
      ->join('internships','registrations.id','=','internships.student')
      ->where('registrations.session','=',$session)->where('internships.type','=','init')->get(['internships.id','internships.type','internships.company_framer'])->toArray();

        return $studentsFirstLevel;
   }

   public function groupThemByCompany(){
     $tmp=[];
     for($i=0;$i<count($this->defencesArray);$i++){
           $companyI=str_replace(' ','',Manager::find($this->defencesArray[$i]->company_framer)->managerCompany->name);
           $tmp[]=$this->defencesArray[$i];
            for($j=$i+1;$j<count($this->defencesArray)-1;$j++){
                $companyJ=str_replace(' ','',Manager::find($this->defencesArray[$j]->company_framer)->managerCompany->name);
                if(strcasecmp($companyI,$companyJ)==0 && $this->defencesArray[$i]->type==$this->defencesArray[$j]->type){
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
           $value->company=Manager::find($value->company_framer)->managerCompany->name;
       }
   }

    public static function getThisYearSecondLevelInternships(){
       $session=((int)date('Y')-1).'/'.date('Y');
       $studentsSecondLevel=DB::table('users')->join('registrations','users.id','=','registrations.student')
      ->join('internships','registrations.id','=','internships.student')
      ->where('registrations.session','=',$session)->where('internships.type','=','perf')->get(['internships.id','internships.company_framer','internships.type'])->toArray();
         
       return $studentsSecondLevel;
    }

    public static function countInternships($level){
       $types=['init','perf','pfe'];  
       $type=$types[(int)$level - 1];
       $session=((int)date('Y')-1).'/'.date('Y');
       $nbrInternships=DB::table('users')->join('registrations','users.id','=','registrations.student')
       ->join('internships','registrations.id','=','internships.student')
       ->where('registrations.session','=',$session)->where('internships.type','=',$type)->count();
      
       return $nbrInternships;
    }


    public static function getMinClassroomsNbr($durationOfAllDefencesInMinutes,$defenceDurationInMinutes,$nbrDefences,$nbdDays=null){
        $globaldefencesduration=$defenceDurationInMinutes * $nbrDefences;
        $res=($globaldefencesduration / $durationOfAllDefencesInMinutes);
 
        return round($res);
    }

    public static function getClassroomsNumber($legalDurationInDay,$internshipsDurationInDay){
      return round($internshipsDurationInDay / $legalDurationInDay);
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

      public static function getNbrInternshipsPerDay(int $level,$inverse){
            $types=['init','perf','pfe'];
            $nbrInternships=self::countInternships($level);
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

    public function shareClassroomsBetweenDefences($startindex,$arrayinfoclassrooms,$lengthDefencesArray){
      
          if($lengthDefencesArray - $startindex  == $arrayinfoclassrooms[1]){
             for($i=0;$i<$arrayinfoclassrooms[1];$i++)
                 $this->defencesArray[$startindex++]->classroom=$this->classroomsArray[$i];
          }else{
             $lengthArrayClassrooms=count($this->classroomsArray);
             for($j=0;$j<$lengthArrayClassrooms;$j++)
                 $this->defencesArray[$startindex++]->classroom=$this->classroomsArray[$j];

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
                if($exceptional_start_time->minute==0)
                   $this->defencesArray[$startindex]->start_time=$exceptional_start_time->hour.':'.$exceptional_start_time->minute.'0';
                else  
                   $this->defencesArray[$startindex]->start_time=$exceptional_start_time->hour.':'.$exceptional_start_time->minute;
                $exceptional_end_time=$this->addMinutes($exceptional_start_time,$this->defencesArray[$startindex]->duration);
                if($exceptional_end_time->minute==0)
                   $this->defencesArray[$startindex++]->end_time=$exceptional_end_time->hour.':'.$exceptional_end_time->minute.'0';
                else 
                   $this->defencesArray[$startindex++]->end_time=$exceptional_end_time->hour.':'.$exceptional_end_time->minute;
            }
         }
        }else{
            for($i=0;$i<$nbrclass;$i++){
                if($startindex >= $nbrclass){
                    $new_start_time=$this->defencesArray[$startindex-$nbrclass]->end_time;
                    $generic_start_time=self::getPersistentBeginningTime($new_start_time);
                }
                    $this->defencesArray[$startindex]->start_time=$generic_start_time->hour.':'.$generic_start_time->minute;
                    if($generic_start_time->minute==0){
                       $this->defencesArray[$startindex]->start_time=$generic_start_time->hour.':'.$generic_start_time->minute.'0'; 
                       $str=$generic_start_time->hour.':'.$generic_start_time->minute.'0';
                    }else{ 
                       $this->defencesArray[$startindex]->start_time=$generic_start_time->hour.':'.$generic_start_time->minute; 
                       $str=$generic_start_time->hour.':'.$generic_start_time->minute;
                    }
                $refstarttime=$this->getPersistentBeginningTime($str);
                $this->addMinutes($refstarttime,$this->defencesArray[$startindex]->duration);
                if($refstarttime->minute==0)
                    $this->defencesArray[$startindex]->end_time=$refstarttime->hour.':'.$refstarttime->minute.'0';
                else
                    $this->defencesArray[$startindex]->end_time=$refstarttime->hour.':'.$refstarttime->minute;
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

}
