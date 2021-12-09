<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DriverPost;

class SearchController extends Controller
{
    public function search(){
        return view('search.search');
    }
    
    public function distanceMatrix(){
        $posts = DriverPost::all();
        return view('search.distanceMatrix',['posts'=>$posts]);
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
    
    public function show(Request $request){
        $post = DriverPost::find($request->id);
        return view('search.show',['post'=>$post]);
    }
    
    
}
