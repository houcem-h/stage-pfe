<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function managers()
    {
        return $this->hasMany('App\Manager');
    }
}
