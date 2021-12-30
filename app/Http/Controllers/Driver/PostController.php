<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DriverPost;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $id = Auth::id();
        $posts = DriverPost::with('user')->where('user_id','=',$id)->orderBy('updated_at', 'DESC')->paginate(5);
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
        if ($file = $request->file('car_image')){
            $file_name = time() . $file->getClientOriginalName();
            $file->storeAs('img/cars/', $file_name, 's3');
            
            /*$path=Storage::disk('s3')->putFileAs('img/cars', $file, $file_name, 'public');*/
            /*Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');*/
            /*Storage::disk('s3')->putFile('img/cars/' . $file_name, $file, 'public');*/
            /*Storage::put('img/cars/' . $file_name, $file, 'public');
            /*$target_path = Storage::disk('s3')->putFile('/img/cars/', $file, 'public');*/
            /*$target_path = public_path('img/cars/');
            $file->move($target_path, $fileName);*/
        } 
        else {
            $file_name = '';
        }
        
        $post = new DriverPost;
        $post->user_id = Auth::id();
        $post->start_datetime = $request->start_datetime;
        $post->end_datetime = $request->end_datetime;
        $post->current_location = $request->current_location;
        $post->asking = $request->asking;
        $post->car_model = $request->car_model;
        $post->max_passengers = $request->max_passengers;
        $post->car_image = $file_name;
        $post->latitude = $request->lat;
        $post->longitude = $request->lng;
        $post->save();
        return redirect('/driver/posts/'.$post->id);
    }
    
    public function edit(Request $request){
        $id = Auth::id();
        $post = DriverPost::find($request->id);
        
        if($id != $post->user_id){
            return redirect('/');   
        }
        
        return view('driver.posts.edit',['form'=>$post]);
    }
    
    public function update(PostRequest $request){
        $id = Auth::id();
        $post = DriverPost::find($request->id);
        
        if($id != $post->user_id){
            return redirect('/');   
        }
        
        if ($file = $request->file('car_image')){
            $file_name = time() . $file->getClientOriginalName();
            $file->storeAs('img/cars/', $file_name, 's3');
        } 
        else{
            $file_name = $post->car_image;
        }
        
        $post->start_datetime = $request->start_datetime;
        $post->end_datetime = $request->end_datetime;
        $post->current_location = $request->current_location;
        $post->asking = $request->asking;
        $post->car_model = $request->car_model;
        $post->max_passengers = $request->max_passengers;
        $post->car_image = $file_name;
        $post->latitude = $request->lat;
        $post->longitude = $request->lng;
        $post->save();
        return redirect('/driver/posts/'.$post->id);
    }
    
    public function destroy(Request $request){
        $id = Auth::id();
        $post = DriverPost::find($request->id);
        
        if($id != $post->user_id){
            return redirect('/');   
        }
        
        $post->delete();
        return redirect('/driver/posts');
    }
}

