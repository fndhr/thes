<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposedAdvisor extends Model
{
    //
    public function lecturers(){
        return $this->hasMany('App\lecturer','lec_id','lec_id');
    }
    public function students(){
        return $this->hasMany('App\student','std_id','std_id');
    }
    public function statuses(){
        return $this->hasMany('App\status','sts_id','sts_id');
    }
}
