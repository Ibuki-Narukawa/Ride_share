<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverPost extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
