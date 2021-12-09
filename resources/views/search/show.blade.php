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
    table {
        table-layout: fixed;
        width:100%
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
    .footer {
        text-align:center;
    }
    #map {
        width: 90%;
        height: 350px;
        margin:20px auto;
    }
@endsection

@section('content')
    <h1>Driver Show</h1>
    <div class='driver-post'>
        <table>
            <div class='name'>
                <tr><th>氏名：<a>{{$post->user->name}}</a></th></tr>
            </div>
            <div class='current-location'>
                <tr><td>現在地：<span id="address">{{$post->current_location}}</span></td></tr>
                <tr>
                    <td>
                        <div id='map'></div>
                        <div id='infowindow-content'>
                            <span id='place-name' class='title'></span><br />
                            <span id='place-address'></span>
                        </div>
                    </td>
                </tr>
            </div>
            <div class='request'>
                <tr><td>してほしいこと：{{$post->asking}}</td></tr>
            </div>
            <div class='car-info'>
                <tr><td>車種： {{$post->car_model}}</td></tr>
                <tr><td>相乗り可能人数：{{$post->max_passengers}}人まで</td></tr>
                <tr>
                    <td>
                        <div style='text-align: center'>
                            @php
                            $image_filename = $post->car_image;
                            @endphp
                            <p>{{$image_filename}}</p>
                            <image src="{{ asset('img/cars/'.$image_filename,true) }}">
                        </div>
                    </td>
                </tr>
            </div>
        </table>
    </div>
    <div class='footer'>
        <div class='btn apply-btn'>
            @csrf
            <input type='submit' style='display:none' method='post'>
            <button><span onclick='return applyPost(this);'>申請する</span></button>
        </div>
        <p>[<a href='/search/distanceMatrix'>back</a>]</p>   
    </div>
    <script>
        function applyPost(e){
            'use strict';
            if(confirm('本当にこのドライバーに申請しますか？')){
            document.getElementById('form_delete').submit();
            }
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&v=weekly"
        async
    ></script>
    
    <script src="{{ asset('js/map_show.js') }}"></script>
@endsection