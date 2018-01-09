<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minute extends Model
{
    public function defense()
    {
        return $this->belongsTo('App\Defense','foreign_key');
    }
}
