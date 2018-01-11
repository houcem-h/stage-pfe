<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public function student()
    {
        return $this->belongsTo('App\User','foreign_key');
    }

    public function group()
    {
        return $this->belongsTo('App\Group','foreign_key');
    }

    public function internship()
    {
        return $this->hasMany('App\Internship');
    }
}
