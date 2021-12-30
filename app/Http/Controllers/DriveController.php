<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Drive;
use App\Carpooler;
use App\DriverPost;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class DriveController extends Controller
{
    public function index(){
        $id = Auth::id();
        $drives = Drive::with('carpooler')->with('driverPost')->whereHas('carpooler', function (Builder $query){
            $query->where('user_id','=',Auth::id());
        })->orwhereHas('driverPost', function (Builder $query){
            $query->where('user_id','=',Auth::id());
        })->orderBy('updated_at', 'DESC')->paginate(5);
        
        return view('drives.index',['drives'=>$drives]);
    }
    
    public function show(Request $request){
        $id = Auth::id();
        $drive = Drive::find($request->id);
        
        if($id != $drive->carpooler->user_id && $id != $drive->driverPost->user_id){
            return redirect('/');       
        }
        
        $messages = Message::with('drive')->with('user')->where('drive_id','=',$request->id)->orderBy('created_at', 'ASC')->get();
        return view('drives.show',['drive'=>$drive, 'messages'=>$messages]);
    }
    
    public function store(Request $request){
        $carpooler = Carpooler::find($request->carpooler_id);
        $carpooler->status = 2;
        
        $driverPost = DriverPost::find($request->driver_post_id);
        $driverPost->status = 2;
        $driverPost->save();
        
        $drive = new Drive;
        $drive->carpooler_id = $request->carpooler_id;
        $drive->driver_post_id = $request->driver_post_id;
        $drive->save();
        
        $carpooler->drive_id = $drive->id;
        $carpooler->save();
        return redirect('/drives');
    } 
}
