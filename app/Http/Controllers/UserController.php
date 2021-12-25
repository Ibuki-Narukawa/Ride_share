<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::orderBy('updated_at', 'DESC')->paginate(5);
        return view('user.index',['users'=>$users]);
    }
    
    public function show(Request $request){
        $user = User::find($request->id);
        return view('user.show',['user'=>$user]);
    }
    
    public function edit(Request $request){
        $user = User::find($request->id);
        return view('user.edit',['form'=>$user]);
    }
    
    public function update(UserRequest $request){
        $user = User::find($request->id);
       
        if ($file = $request->file('user_image')){
            $file_name = time() . $file->getClientOriginalName();
            $file->storeAs('img/users/', $file_name, 's3');
        } 
        else{
            $file_name = $user->user_image;
        }
        
        $form = $request->all(); $user->user_image = $file_name;
        $user->fill($form)->save();
        return redirect('/users/'.$user->id);
    }
}
