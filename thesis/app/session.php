<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    //
    public $primaryKey = 'session_id';
    public function student(){
        return $this->belongsTo('App\student','session_id','session_id');
    }
}
