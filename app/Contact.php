<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'contact_id';

    protected $fillable = ['contact_civilite', 'contact_prenom', 'contact_nom', 'societe_id', 'contact_fonction', 'contact_service', 'contact_e_mail', 'contact_telephone', 'contact_date_naissance'];

    public function Societe(){
        return $this->belongsTo('App\Societe', 'societe_id', 'societe_id');
    }

}
