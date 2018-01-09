<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }
}
