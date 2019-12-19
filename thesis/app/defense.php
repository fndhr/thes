<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class defense extends Model
{
    //
    public function user(){
        return $this->hasOne('App\User','id','usr_id');
    }
    public function chairman(){
        return $this->belongsTo('App\lecturer','lec_id','chairman');
    }
    public function examiner(){
        return $this->belongsTo('App\lecturer','lec_id','examiner');
    }
}
