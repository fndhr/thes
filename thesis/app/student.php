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
}
