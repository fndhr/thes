<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    //
    public $primaryKey = 'session_id';
    public function students(){
        return $this->hasMany('App\student','session_id','session_id');
    }
}
