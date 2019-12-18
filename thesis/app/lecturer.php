<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecturer extends Model
{
    public function user(){
        return $this->hasOne('App\User','id','usr_id');
    }
    public function proposedAdvisor(){
        return $this->belongsTo('App\proposedAdvisor','lec_id','lec_id');
    }
}
