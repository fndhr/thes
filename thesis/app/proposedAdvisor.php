<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposedAdvisor extends Model
{
    //
    public $primaryKey = 'advisor_id';  
    public function lecturer(){
        return $this->belongsTo('App\lecturer','lec_id','lec_id');
    }
    public function student(){
        return $this->belongsTo('App\student','std_id','std_id');
    }
    public function statuses(){
        return $this->hasOne('App\status','sts_id','sts_id');
    }
}
