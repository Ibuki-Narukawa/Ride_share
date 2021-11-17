<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverPost extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
