<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposedTitle extends Model
{
    //
    public function students(){
        return $this->belongsTo('App\student','std_id','std_id');
    }
    public function statuses(){
        return $this->hasOne('App\status','sts_id','sts_id');
    }
}
