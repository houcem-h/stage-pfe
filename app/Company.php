<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function managers()
    {
        return $this->hasMany('App\Manager');
    }

    //retourne le createur de l'enregistrement dans la BD (created_by)
    public function adminCreator(){
        return $this->belongsTo('App\User','created_by');
    }

    
    //retourne le modificateur de l'enregistrement dans la BD (updated_by)
    public function adminUpdator(){
        return $this->belongsTo('App\User','updated_by');
    }


    //retourne le tel sans le prefix des pays (+216)
    public function getPhoneNumberAttribute(){
        return $this->attributes['phone'];
    }


    public function getFaxNumberAttribute(){
        return $this->attributes['fax'];
    }
}
