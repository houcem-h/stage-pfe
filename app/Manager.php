<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
   public function getPhoneNumberAttribute(){
        return $this->attributes['phone'];
    }

    public function getFaxNumberAttribute(){
        return $this->attributes['fax'];
    }


    public function managerCompany()
    {
        return $this->belongsTo('App\Company','company');
    }

    public function internships()
    {
        return $this->hasMany('App\Internship');
    }

    public function adminCreator(){
        return $this->belongsTo('App\User','created_by');
    }

    public function adminUpdator(){
        return $this->belongsTo('App\User','updated_by');
    }
}
