<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DriverPost;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(){
        $posts = DriverPost::with('user')->orderBy('updated_at', 'DESC')->paginate(5);
        return view('driver.posts.index',['posts'=>$posts]);
    }
    
    public function show(Request $request){
        $post = DriverPost::find($request->id);
        return view('driver.posts.show',['post'=>$post]);
    }
    
    public function create(){
        return view('driver.posts.create');
    }
    
    public function store(PostRequest $request){
        if ($file = $request->car_image){
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('img/cars/');
            $file->move($target_path, $fileName);
        } 
        else {
            $fileName = '';
        }
        
        $post = new DriverPost;
        $post->user_id = random_int(1,10);
        $post->start_datetime = $request->start_datetime;
        $post->end_datetime = $request->end_datetime;
        $post->current_location = $request->current_location;
        $post->asking = $request->asking;
        $post->car_model = $request->car_model;
        $post->max_passengers = $request->max_passengers;
        $post->car_image = $fileName;
        $post->save();
        return redirect('/driver/posts/'.$post->id);
    }
}

