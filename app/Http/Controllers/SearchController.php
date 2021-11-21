<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DriverPost;

class SearchController extends Controller
{
    public function driverlist(){
        $posts = DriverPost::with('user')->orderBy('arrival_time', 'ASC')->paginate(5);
        return view('search.driverlist',['posts'=>$posts]);
    }
    
    public function show(Request $request){
        $post = DriverPost::find($request->id);
        return view('search.show',['post'=>$post]);
    }
}
