<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DriverPost;

class PostController extends Controller
{
    public function index(){
        $posts = DriverPost::with('user')->orderBy('start_datetime', 'ASC')->paginate(5);
        return view('driver.posts.index',['posts'=>$posts]);
    }
    
    public function show(Request $request){
        $post = DriverPost::find($request->id);
        return view('driver.posts.show',['post'=>$post]);
    }
}

