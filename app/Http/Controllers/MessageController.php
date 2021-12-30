<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Drive;
use App\Carpooler;
use App\DriverPost;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(MessageRequest $request){
        $message = new Message;
        $message->drive_id = $request->drive_id;
        $message->user_id = $request->user_id;
        $message->comment = $request->comment;
        $message->save();
        
        return redirect('/drives/'.$message->drive_id);
    }
    
    public function destroy(Request $request){
        $id = Auth::id();
        $message = Message::find($request->id);
        
        if($id != $message->user_id){
            return redirect('/');   
        }
        
        $message->delete();
        return redirect('/drives/'.$message->drive_id);
    }
}
