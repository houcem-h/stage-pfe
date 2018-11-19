<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defense extends Model
{
    public function internships()
    {
        return $this->belongsTo('App\Internship','internship');
    }

    public function reporterRecord() {
      return $this->belongsTo('App\User','reporter');
    }

    public function presidentRecord() {
        return $this->belongsTo('App\User','president');
    }

    public function minute()
    {
        return $this->hasOne('App\Minute');
    }
}
