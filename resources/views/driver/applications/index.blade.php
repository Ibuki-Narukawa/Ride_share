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
        .pagination {
            margin-left:10%;
        }
    }
@endsection

@section('content')
    <h1>リクエスト送信履歴</h1>
    <div class='driver-posts'>
        @foreach($applications as $application)
        @php
        $post = $application->driverPost;
        @endphp
        <div class='driver-post'>
            <table>
                <div class='driver-name'>
                    <tr><th>ドライバー名：<a href='/driver/applications/{{$application->id}}'>{{$post->user->name}}</a></th></tr>
                </div>
                <div class='current-location'>
                    <tr><td>現在地：{{$post->current_location}}</td></tr>
                </div>
                <div class='request'>
                    <tr><td>してほしいこと：{{$post->asking}}</td></tr>
                </div>
                <div class='car'>
                    <tr><td>車種： {{$post->car_model}}</td></tr>
                </div>
                
                <div class='update-at'>
                    <tr><td>最終更新日：{{$post->updated_at}}</td></tr>
                </div>
            </table>
        </div>
        @endforeach
    </div>
    <p class='pagination'>
        {{$applications->links()}}
    </p>  
@endsection
