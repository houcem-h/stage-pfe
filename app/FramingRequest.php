<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FramingRequest extends Model
{
    public function internshipRecord(){
        return $this->belongsTo('App\Internship','internship');
    }

    public function teacherRecord(){
        return $this->belongsTo('App\User','teacher');
    }

    public function adminCreator(){
        return $this->belongsTo('App\User','created_by');
    }

    public function adminUpdator(){
        return $this->belongsTo('App\User','updated_by');
    }
}
