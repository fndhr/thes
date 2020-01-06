<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    //
    protected $primaryKey = 'std_id';
    public $incrementing = false; 
    
    public function user(){
        return $this->hasOne('App\User','id','usr_id');
    }
    public function lecturer(){
        return $this->hasOne('App\lecturer','lec_id','lec_id');
    }
    public function major(){
        return $this->hasOne('App\major','major_id','major_id');
    }
    public function proposedTitle(){
        return $this->hasMany('App\proposedTitle','std_id','std_id');
    }
    public function proposedAdvisor(){
        return $this->hasMany('App\proposedAdvisor','std_id','std_id');
    }
    public function documentUpload(){
        return $this->hasMany('App\documentUpload','std_id','std_id');
    }
    public function session(){
        return $this->belongsTo('App\session','session_id','session_id');
    }
    public function defense(){
        return $this->belongsTo('App\defense','std_id','std_id');
    }
    public function notification(){
        return $this->hasMany('App\notification','std_id','std_id');
    }
}
