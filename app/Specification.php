<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    public function internship(){
       return $this->hasOne('App\Internship','specifications');
    }

    public function adminCreator(){
        return $this->belongsTo('App\User','created_by');
    }

    public function adminUpdator(){
        return $this->belongsTo('App\User','updated_by');
    }
    
}
