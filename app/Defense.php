<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defense extends Model
{
    public function internship()
    {
        return $this->belongsTo('App\Internship','foreign_key');
    }

    public function minute()
    {
        return $this->hasOne('App\Minute');
    }
}
