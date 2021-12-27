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
    .operationBar {
        width:60%;
        margin:0 auto;
        display:flex;
    }
    .btn {
        text-align:center;
        width:50%;
    }
    #map {
        width: 90%;
        height: 350px;
        margin:20px auto;
    }
@endsection

@section('content')
    <h1>Driver Show</h1>
    <div class='operationBar'>
        <div class='editBtn btn'>
            <h3>[<a href='/driver/posts/{{$post->id}}/edit'>Edit</a>]</h3>
        </div>
        <div class='deleteBtn btn'>
            <form action='/driver/posts/{{$post->id}}' id='form_delete' method='post' enctype='multipart/form-data'>
                @csrf
                @method('delete')
                <input type='submit' style='display:none'>
                <h3>[<span onclick='return deletePost(this);'>Delete</span>]</h3>
            </form>
        </div>
    </div>
    <div class='driver-post'>
        <table>
            <div class='name'>
                <tr><th>氏名：<a>{{$post->user->name}}</a></th></tr>
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
            <div class='start-datetime'>
                <tr><td>送迎開始日時：{{$post->start_datetime}}</th></tr>
            </div>
            <div class='end_datetime'>
                <tr><td>送迎終了日時：{{$post->end_datetime}}</th></tr>
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
                            <image src="{{ Storage::disk('s3')->url("img/cars/".$image_filename) }}" alt="">
                        </div>
                    </td>
                </tr>
            </div>
            <div class='update-at'>
                <tr><td>最終更新日：{{$post->updated_at}}</td></tr>
            </div>
        </table>
    </div>
    <div class='footer'>
        <p>[<a href='/driver/posts'>back</a>]</p>   
    </div>
    <script>
        function deletePost(e){
            'use strict';
            if(confirm('本当にこの投稿を削除しますか？')){
                document.getElementById('form_delete').submit();
            }
        }
    </script>
    
    <script>
        window.latitude = @json($post->latitude);
        window.longitude = @json($post->longitude);
        window.address = @json($post->current_location);
    </script>
        
    {{--<script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&v=weekly"
        async
    ></script>--}}
    
    <script src="{{ asset('js/map_show.js') }}"></script>
@endsection