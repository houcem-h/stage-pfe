<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company','foreign_key');
    }

    public function internships()
    {
        return $this->hasMany('App\Internship');
    }
}
