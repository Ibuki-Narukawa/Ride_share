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
    .footer {
        text-align:center;
        }
@endsection

@section('content')
    <h1>Driver Show</h1>
    <div class='driver-post'>
        <table>
            <div class='name'>
                <tr><th><a>{{$post->user->name}}</a></th></tr>
            </div>
            <div class='status'>
                @if($post->status==1)
                <tr><td>状態：空車</td></tr>
                @elseif($post->status==2)
                <tr><td>状態：予約済み</td></tr>
                @elseif($post->status==3)
                <tr><td>状態：ドライブ完了</td></tr>
                @endif
            </div>
            <div class='car-info'>
                <tr><td>車種： {{$post->car_model}}</td></tr>
                <tr><td>相乗り可能人数：{{$post->max_passengers}}人</td></tr>
                <tr>
                    <td>
                        <div style="text-align: center">
                            <image src="{{ asset('img/car/solio.jpg',true) }}" >
                        </div>
                    </td>
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
    <div class='footer'>
        <div class='btn apply-btn'>
            @csrf
            <input type='submit' style='display:none' method='post'>
            <button><span onclick='return applyPost(this);'>申請する</span></button>
        </div>
        <p>[<a href='/driver/posts'>back</a>]</p>   
    </div>
    <script>
        function applyPost(e){
            'use strict';
            if(confirm('本当にこのドライバーに申請しますか？')){
            document.getElementById('form_delete').submit();
            }
        }
    </script>
@endsection