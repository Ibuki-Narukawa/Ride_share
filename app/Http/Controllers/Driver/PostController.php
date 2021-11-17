<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DriverPost;

class PostController extends Controller
{
    public function index(){
        $posts = DriverPost::with('user')->orderBy('arrival_time', 'ASC')->paginate(5);
        return view('driver.posts.index',['posts'=>$posts]);
    }
}

