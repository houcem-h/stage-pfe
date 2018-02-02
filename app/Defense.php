<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defense extends Model
{
    public function internships()
    {
        return $this->belongsTo('App\Internship','internship');
    }

    public function minute()
    {
        return $this->hasOne('App\Minute');
    }
}
