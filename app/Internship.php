<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    //j ai changé le nom des méthodes(nom_table_relation."Record") a cause de la confusion entre l attribut du modele qui va etre cree apres le chargement des donnees et le nom de la methode qui effectue la relation avec l'autre table
    public function companyFramer()
    {
        return $this->belongsTo('App\Manager','company_framer');
    }

    public function framerRecord()
    {
        return $this->belongsTo('App\User','framer');
    }

    public function registration()
    {
        return $this->belongsTo('App\Registration','student');
    }

    public function defense()
    {
        return $this->hasOne('App\Defense');
    }

        //retourne le createur de l'enregistrement dans la BD (created_by)
    public function adminCreator(){
        return $this->belongsTo('App\User','created_by');
    }

	//retourne le modificateur de l'enregistrement dans la BD (updated_by)
    public function adminUpdator(){
        return $this->belongsTo('App\User','updated_by');
    }
}
