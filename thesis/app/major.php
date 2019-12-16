<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class major extends Model
{
    //
    protected $primaryKey = 'major_id';
    
    public function student(){
        $this->belongsTo('App\student','major_id');
    }
}
