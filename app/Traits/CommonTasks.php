<?php
namespace App\Traits;

trait CommonTasks{

    public function arrayOfSimpleArrays($array){
        $result=[];
        foreach($array as $key=>$value){
          foreach($value as $val){
              $result[]=$val;
          }
        }
        return $result;
    }

    public function DoesHaveThisInternshipToPass($type,$haystack){
      $test=true;
      foreach($haystack as $value){
         foreach($value as $val){
            if($value['type']==$type){
                if($value['state']!='accepted' && $value['state']!='waiting')
                   $test=true;
                else 
                  return false;
            }
         }
      }
      return $test;
    }

    
}
?>
