<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposedConsultation extends Model
{
    public function student(){
        return $this->belongsTo('App\student','std_id','std_id');
    }
    public function status(){
        return $this->hasOne('App\status','sts_id','sts_id');
    }
}
