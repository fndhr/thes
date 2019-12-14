<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    //
    public function users(){
        return $this->hasMany('App\User','id');
    }
    
}
