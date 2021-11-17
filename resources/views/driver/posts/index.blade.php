@extends('layouts.app')

@section('style')
    body {
        front-size:16px;
        color:#87CEFA;
        }
    h1 {
        font-size:50px; 
        color:#87CEFA; 
        margin:20px;
        text-align:center;
        }
    .driver {
        padding:0px 5px;
        width:60%;
        margin:0 auto;
        margin-bottom:20px;
        }
    th {
        border: solid 1px #87CEFA;
        background-color:#87CEFA;
        color:#F0FFFF;
        padding:5px; 
        text-align:left;
        width:100vw;
        }
    td {
        border:solid 1px #aaa; 
        color:#999; 
        text-align:left;
        padding:10px;
        width:100vw;
        }
    img{
        width:200px;
        }
@endsection

@section('content')
    <h1>Driver List</h1>
    <div class='drivers'>
        @foreach($posts as $post) 
        <div class='driver'>
            <table>
                <div class='name'>
                    <tr><th><a>{{$post->user->name}}</a></th></tr>
                </div>
                <div class='car'>
                    <tr><td>車種： {{$post->car_model}}</td></tr>
                    <tr>
                        <td>
                            <div style="text-align: center">
                                <image src="{{ asset('img/solio.jpg',true) }}" >
                            </div>
                        </td
                    </tr>
                </div>
                <div class='current-location'>
                    <tr><td>現在地：{{$post->current_location}}</td></tr>
                </div>
                <div class='distance'>
                    <tr><td>距離：{{$post->distance}}km</td></tr>
                </div>
                <div class='arrival-time'>
                    <tr><td>到着所要時間：{{$post->arrival_time}}分</td></tr>
                </div>
                <div class='request'>
                    <tr><td>してほしいこと：{{$post->request}}</td></tr>
                </div>
            </table>
        </div>
        @endforeach
    </div>
    <p class='pagination'>
        {{$posts->links()}}
    </p>  
@endsection