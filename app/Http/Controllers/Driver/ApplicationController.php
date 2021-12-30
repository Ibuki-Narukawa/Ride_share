<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carpooler;
use App\DriverPost;
use App\Http\Requests\CarpoolerRequest;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(){
        $id = Auth::id();
        $applications = Carpooler::with('user')->with('driverPost')->where('user_id','=',$id)->where('status','=',1)->orderBy('updated_at', 'DESC')->paginate(5);
        return view('driver.applications.index',['applications'=>$applications]);
    }
    
    public function show(Request $request){
        $id = Auth::id();
        $application = Carpooler::find($request->id);
    
        if($id != $application->user_id && $id != $application->driverPost->user_id){
            return redirect('/');       
        }
        
        $post = DriverPost::find($application->driver_post_id);
        return view('driver.applications.show',['post'=>$post, 'application'=>$application]);
    }
    
    public function destroy(Request $request){
        $application = Carpooler::find($request->id);
        $application->delete();
        return redirect('/driver/applications');
    }
}
