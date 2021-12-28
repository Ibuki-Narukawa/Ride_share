<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drive extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');
    
    public function carpooler(){
        return $this->belongsTo('App\Carpooler');
    }
    
    public function driverPost(){
        return $this->belongsTo('App\DriverPost');
    }
    
    public function messages(){
        return $this->hasMany('App\Message');     
    }
}
