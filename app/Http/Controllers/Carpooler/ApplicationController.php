<?php

namespace App\Http\Controllers\Carpooler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carpooler;
use App\DriverPost;
use App\Http\Requests\CarpoolerRequest;

class ApplicationController extends Controller
{
    public function index(){
        $applications = Carpooler::with('user')->with('driverPost')->where('status','=',1)->orderBy('updated_at', 'DESC')->paginate(5);
        return view('carpooler.applications.index',['applications'=>$applications]);
    }
    
    public function show(Request $request){
        $application = Carpooler::find($request->id);
        return view('carpooler.applications.show',['application'=>$application]);
    }
    
    public function store(CarpoolerRequest $request){
        $posts = DriverPost::where('status','=',1)->get();
        $start_datetime = $request->start_datetime;
        $from = $request->from;
        $to = $request->to;
        $latFrom = $request->latFrom;
        $lngFrom = $request->lngFrom;
        $latTo = $request->latTo;
        $lngTo = $request->lngTo;
        
        $application = new Carpooler;
        $application->user_id = random_int(1,20);
        $application->start_datetime = $start_datetime;
        $application->origin = $from;
        $application->latitude_from = $latFrom;
        $application->longitude_from = $lngFrom;
        $application->destination = $to;
        $application->latitude_to = $latTo;
        $application->longitude_to = $lngTo;
        $application->driver_post_id = $request->driver_post_id;
        $application->save();
        
        return view('search.distanceMatrix',[
            'posts' => $posts, 
            'start_datetime' => $start_datetime,
            'from' => $from, 
            'to' => $to,
            'latFrom' => $latFrom,
            'lngFrom' => $lngFrom,
            'latTo' => $latTo,
            'lngTo' => $lngTo
        ]);
    }
    
    public function destroy(Request $request){
        $application = Carpooler::find($request->id);
        $application->delete();
        return redirect('/carpooler/applications');
    }
}
