@extends('layouts.app')

@section('style')
    body {
        front-size:16px;
        color:#00BFFF;
        text-align:center;
    }
    h1 {
        font-size:50px; 
        margin:20px;
    }
    .driver-post {
        width:75vw;
        margin:0 auto;
        margin-bottom:20px;
    }
    table {
        table-layout: fixed;
        width:100%;
    }
    th {
        border: solid 1px #00BFFF;
        background-color:#00BFFF;
        color:#F0FFFF;
        padding:5px; 
        text-align:left;
    }
    td {
        border:solid 1px #aaa; 
        color:#999; 
        text-align:left;
        padding:10px;
    }
    img {
        width:200px;
    }
    .pagination {
        margin-left:10%;
    }
    
    @media screen and (max-width:480px){
        body {
        front-size:16px;
        color:#00BFFF;
        text-align:center;
        }
        h1 {
            font-size:30px; 
            margin:20px;
        }
        .driver-post {
            width:90vw;
            margin:0 auto;
            margin-bottom:20px;
        }
        table {
            table-layout: fixed;
            width:100%;
        }
        th {
            border: solid 1px #00BFFF;
            background-color:#00BFFF;
            color:#F0FFFF;
            padding:5px; 
            text-align:left;
        }
        td {
            border:solid 1px #aaa; 
            color:#999; 
            text-align:left;
            padding:10px;
        }
        img {
            width:200px;
        }
        .pagination {
            margin-left:10%;
        }
    }
@endsection

@section('content')
    <h1>ドライバー登録履歴</h1>
    <!--<div class='create-btn'>-->
    <!--    <h3>[<a href='/driver/posts/create'>Create</a>]</h3>-->
    <!--</div>-->
    <div class='driver-posts'>
        @foreach($posts as $post) 
        <div class='driver-post'>
            <table>
                {{--<div class='id'>
                    <tr><th>id:{{$post->id}}</th></tr>
                </div>--}}
                <div class='name'>
                    <tr><th>氏名：<a href='/driver/posts/{{$post->id}}'>{{$post->user->name}}</a></th></tr>
                </div>
                {{--<div class='start-datetime'>
                    <tr><td>送迎開始日時：{{$post->start_datetime}}</th></tr>
                </div>
                <div class='end_datetime'>
                    <tr><td>送迎終了日時：{{$post->end_datetime}}</th></tr>
                </div>--}}
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
                                <image src="{{ Storage::disk('s3')->url("img/cars/".$image_filename) }}" alt="">
                            </div>
                        </td>
                    </tr>
                </div>
                <div class='updated-at'>
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