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
    .driver-post {
        width:75%;
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
    <h1>検索結果</h1>
    <div class='driver-posts'>
        @foreach($posts as $post) 
        <div class='driver-post'>
            <table>
                <div class='name'>
                    <tr><th>氏名：<a href='/search/driverlist/{{$post->id}}'>{{$post->user->name}}</a></th></tr>
                </div>
                <div class='current-location'>
                    <tr><td>現在地：{{$post->current_location}}</td></tr>
                </div>
                <div class='request'>
                    <tr><td>してほしいこと：{{$post->asking}}</td></tr>
                </div>
                <div class='car'>
                    <tr><td>車種： {{$post->car_model}}</td></tr>
                    <tr>
                        <td>
                            <div style='text-align: center'>
                                @php
                                $image_filename = $post->car_image;
                                @endphp
                                <p>{{$image_filename}}</p>
                                <image src="{{ asset('img/cars/'.$image_filename,true) }}">
                            </div>
                        </td
                    </tr>
                </div>
                <div class='update-at'>
                    <tr><td>最終更新日：{{$post->updated_at}}</td></tr>
                </div>
            </table>
        </div>
        @endforeach
    </div>
    <p class='pagination'>
        {{$posts->links()}}
    </p>  
@endsection