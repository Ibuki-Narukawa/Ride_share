<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');
    
    public function drive(){
        return $this->belongsTo('App\Drive');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
