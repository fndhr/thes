<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documentUpload extends Model
{
    public function student(){
        return $this->belongsTo('App\student','std_id','std_id');
    }
}
