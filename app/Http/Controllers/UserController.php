<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::orderBy('updated_at', 'DESC')->paginate(5);
        return view('User.index',['users'=>$users]);
    }
    
    public function show(Request $request){
        $user = User::find($request->id);
        return view('User.show',['user'=>$user]);
    }
}
