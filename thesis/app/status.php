<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    //
    public function proposedTitle(){
        return $this->belongsTo('App\proposedTitle','sts_id','sts_id');
    }
    public function proposedAdvisor(){
        return $this->belongsTo('App\proposedAdvisor','sts_id','sts_id');
    }
    
    public function status(){
        return $this->belongsTo('App\proposedConsultation','sts_id','sts_id');
    }
}