<?php

namespace App\Http\Controllers\Carpooler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carpooler;
use App\Http\Requests\CarpoolerRequest;

class ApplicationController extends Controller
{
    public function index(){
        $carpoolers = Carpooler::with('user')->with('driverPost')->where('status','=',1)->orderBy('updated_at', 'DESC')->paginate(5);
        return view('carpooler.applications.index',['carpoolers'=>$carpoolers]);
    }   
}
