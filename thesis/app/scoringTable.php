<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scoringTable extends Model
{
    //
    public function lecturer(){
        return $this->hasOne('App\lecturer','lec_id','lec_id');
    }

    public function student(){
        return $this->belongsTo('App\student','std_id','std_id');
    }
}
