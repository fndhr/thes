<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    //
    public function student(){
        return $this->belongsTo('App\student','session_id','session_id');
    }
}
