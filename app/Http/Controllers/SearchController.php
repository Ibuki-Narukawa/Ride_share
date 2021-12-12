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
        $posts = DriverPost::get();
        $start_datetime = $request->start_datetime;
        $from = $request->from;
        $to = $request->to;
        $latFrom = $request->latFrom;
        $lngFrom = $request->lngFrom;
        $latTo = $request->latTo;
        $lngTo = $request->lngTo;
        
        $carpooler_data = [$start_datetime, $from, $to, $latFrom, $lngFrom, $latTo, $lngTo]; 
        return view('search.distanceMatrix',['posts'=>$posts, 'carpooler_data'=>$carpooler_data]);
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
        
        $carpooler_data = [$start_datetime, $from, $to, $latFrom, $lngFrom, $latTo, $lngTo]; 
        return view('search.show',['post'=>$post, 'carpooler_data'=>$carpooler_data]);
    }
    
    
}
