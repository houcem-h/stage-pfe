<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Minute extends Model
{
    public function defense()
    {
        return $this->belongsTo('App\Defense','foreign_key');
    }


    // added by amine
    public static function check($id_defense){
        $result = DB::table("minutes")
                  ->join("defenses","defenses.id","=","minutes.defense")
                  ->join("internships","internships.id","=","defenses.internship")
                  ->where("defenses.id","=",$id_defense)
                  ->select("final_note","mention","notes","internships.type")
                  ->get()->first();

        return array($result);
    }
}
