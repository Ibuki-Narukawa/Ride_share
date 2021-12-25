<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');
    
    public function chat_room(){
        return $this->belongsTo('App\ChatRoom');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
