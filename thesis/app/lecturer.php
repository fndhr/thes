<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecturer extends Model
{
    public function user(){
        return $this->hasOne('App\User','id','usr_id');
    }
    public function student(){
        return $this->belongsTo('App\student','lec_id','lec_id');
    }
    public function proposedAdvisors(){
        return $this->hasMany('App\proposedAdvisor','lec_id','lec_id');
    }
    public function chairmans(){
        return $this->hashMany('App\defense','lec_id','chairman');
    }
    public function examiners(){
        return $this->hasMany('App\defense','lec_id','examiner');
    }
}
