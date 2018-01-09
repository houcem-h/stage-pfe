<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    public function company_framer()
    {
        return $this->belongsTo('App\Manager','foreign_key');
    }

    public function framer()
    {
        return $this->belongsTo('App\User','foreign_key');
    }

    public function registration()
    {
        return $this->belongsTo('App\Registration','foreign_key');
    }

    public function defense()
    {
        return $this->hasOne('App\Defense');
    }
}
