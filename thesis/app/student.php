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
    public function major(){
        return $this->hasOne('App\major','major_id','major_id');
    }
    public function proposedTitle(){
        return $this->belongsTo('App\proposedTitle','std_id','std_id');
    }
    public function proposedAdvisor(){
        return $this->belongsTo('App\proposedAdvisor','std_id','std_id');
    }
}
