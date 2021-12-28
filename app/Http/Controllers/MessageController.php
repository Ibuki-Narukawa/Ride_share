<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Drive;
use App\Carpooler;
use App\DriverPost;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request){
        $message = new Message;
        $message->drive_id = $request->drive_id;
        $message->user_id = $request->user_id;
        $message->comment = $request->comment;
        $message->save();
        
        return redirect('/drives/'.$message->drive_id);
    }
}
