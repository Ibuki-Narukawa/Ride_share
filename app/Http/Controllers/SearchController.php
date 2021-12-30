<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DriverPost;
use App\Http\Requests\CarpoolerRequest;

class SearchController extends Controller
{
    public function search(){
        return view('search.search');
    }
    
    public function distanceMatrix(CarpoolerRequest $request){
        $start_datetime = $request->start_datetime;
        $posts = DriverPost::where('status','=', 1)->where('start_datetime','<=',$start_datetime)->where('end_datetime','>',$start_datetime)->get();
        $from = $request->from;
        $to = $request->to;
        $latFrom = $request->latFrom;
        $lngFrom = $request->lngFrom;
        $latTo = $request->latTo;
        $lngTo = $request->lngTo;
        
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
    
    public function driverlist(){
        //dd(DriverPost::pluck('current_location')->all());
        $locations = DriverPost::pluck('current_location')->all();
        //dd($locations);
        //$posts = DriverPost::all();
        $posts = DriverPost::orderBy('updated_at', 'DESC')->paginate(5);
        //return response()->json(['posts'=>$posts]);
        return view('search.driverlist',['posts'=>$posts]);
        //return view('search.driverlist',['posts'=>$posts,response()->json(['locations'=>$locations])]);
        
    }
    
    public function show(CarpoolerRequest $request){
        $post = DriverPost::find($request->id);
        $start_datetime = $request->start_datetime;
        $from = $request->from;
        $to = $request->to;
        $latFrom = $request->latFrom;
        $lngFrom = $request->lngFrom;
        $latTo = $request->latTo;
        $lngTo = $request->lngTo;
        
        return view('search.show',[
            'post'=>$post, 
            'start_datetime' => $start_datetime,
            'from' => $from, 
            'to' => $to,
            'latFrom' => $latFrom,
            'lngFrom' => $lngFrom,
            'latTo' => $latTo,
            'lngTo' => $lngTo
        ]);
    }
    
    
}
