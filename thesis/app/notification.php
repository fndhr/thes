<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    
    public function user(){
        return $this->belongsTo('App\User','usr_id','id');
    }
}
