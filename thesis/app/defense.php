<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class defense extends Model
{
    //
    public function user(){
        return $this->hasOne('App\User','id','usr_id');
    }
    public function chairmans(){
        return $this->hasMany('App\lecturer','lec_id','chairman');
    }
    public function examiners(){
        return $this->hasMany('App\lecturer','lec_id','examiner');
    }
}
