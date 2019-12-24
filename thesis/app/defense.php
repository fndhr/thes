<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class defense extends Model
{
    //
    public function student(){
        return $this->hasOne('App\student','std_id','std_id');
    }
    public function chairman_name(){
        return $this->belongsTo('App\lecturer','chairman','lec_id');
    }
    public function examiner_name(){
        return $this->belongsTo('App\lecturer','examiner','lec_id');
    }
}
