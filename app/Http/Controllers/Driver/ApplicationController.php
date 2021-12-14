<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carpooler;
use App\DriverPost;
use App\Http\Requests\CarpoolerRequest;

class ApplicationController extends Controller
{
    public function index(){
        $applications = Carpooler::with('user')->with('driverPost')->where('status','=',1)->orderBy('updated_at', 'DESC')->paginate(5);
        return view('driver.applications.index',['applications'=>$applications]);
    }
    
    public function show(Request $request){
        $application = Carpooler::find($request->id);
        $post = DriverPost::find($application->driver_post_id);
        return view('driver.applications.show',['post'=>$post]);
    }
    
    public function destroy(Request $request){
        $application = Carpooler::find($request->id);
        $application->delete();
        return redirect('/driver/applications');
    }
}
