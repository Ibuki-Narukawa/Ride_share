<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatRoom extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');
    
    public function carpooler(){
        return $this->belongsTo('App\carpooler');
    }
    
    public function driverPost(){
        return $this->belongsTo('App\DriverPost');
    }
    
    public function messages(){
        return $this->hasMany('App\Message');     
    }
}
