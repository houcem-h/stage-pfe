<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Group extends Model
{
    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }



    /********************************** AMINE BEJAOUI WORK ****************************************/
    public function getCreatedAtAttribute(){
      $date = Carbon::parse($this->attributes['created_at'])->format("d-m-Y");
      return $this->attributes['created_at'] = $date;
    }

    public function getUpdatedAtAttribute(){
      $date = Carbon::parse($this->attributes['updated_at'])->format("d-m-Y");
      return $this->attributes['updated_at'] = $date;
    }

    //get list stream but the first one is the stream of the id_group ==> this method is used to get select list in blade
    public static function getListStream($id_group){
        $first_stream = self::where("id",$id_group)->get(['stream'])->first();
        return $first_stream['stream'];

    }
}
