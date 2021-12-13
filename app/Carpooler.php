<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carpooler extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function driverPost(){
        return $this->belongsTo('App\DriverPost');
    }
}
