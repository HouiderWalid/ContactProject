<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    protected $primaryKey = 'societe_id';

    public function Contacts(){
        return $this->hasMany('App\Contact', 'societe_id', 'societe_id');
    }
}
