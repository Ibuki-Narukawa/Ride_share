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
    .back-link {
        text-align:center;
    }
    .button-bar {
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
        h3 {
            font-size:20px;
        }
        .driver-post {
            width:90vw;
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
        .back-link {
            text-align:center;
        }
        .button-bar {
            width:80%;
            margin:0 auto;
            display:flex;
        }
        .btn {
            text-align:center;
            width:50%;
        }
        #map {
            width: 100%;
            height: 300px;
            margin:20px auto;
        }
    }
@endsection

@section('content')
    <h1>?????????????????????</h1>
    @auth
        @if(Auth::id()==$post->user_id && $post->status==1)
            <div class='button-bar'>
                <div class='edit-btn btn'>
                    <h3>[<a href='/driver/posts/{{$post->id}}/edit'>??????</a>]</h3>
                </div>
                <div class='delet-btn btn'>
                    <form action='/driver/posts/{{$post->id}}' id='form_delete' method='post' enctype='multipart/form-data'>
                        @csrf
                        @method('delete')
                        <input type='submit' style='display:none'>
                        <h3>[<span onclick='return deletePost(this);'>??????</span>]</h3>
                    </form>
                </div>
            </div>
        @endif
    @endauth
    
    <div class='driver-post'>
        <table>
            <div class='name'>
                <tr><th>?????????<a>{{$post->user->name}}</a></th></tr>
            </div>
            <div class='status'>
                @if($post->status==1)
                <tr><td>???????????????</td></tr>
                @elseif($post->status==2)
                <tr><td>?????????????????????</td></tr>
                @elseif($post->status==3)
                <tr><td>???????????????????????????</td></tr>
                @endif
            </div>
            <div class='start-datetime'>
                <tr><td>?????????????????????{{$post->start_datetime}}</th></tr>
            </div>
            <div class='end_datetime'>
                <tr><td>?????????????????????{{$post->end_datetime}}</th></tr>
            </div>
            <div class='current-location'>
                <tr><td>????????????<span id="address">{{$post->current_location}}</span></td></tr>
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
                <tr><td>????????????????????????{{$post->asking}}</td></tr>
            </div>
            <div class='car-info'>
                <tr><td>????????? {{$post->car_model}}</td></tr>
                <tr><td>????????????????????????{{$post->max_passengers}}?????????</td></tr>
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
                <tr><td>??????????????????{{$post->updated_at}}</td></tr>
            </div>
        </table>
    </div>
    <div class='back-link'>
        <p>[<a href='/driver/posts'>??????</a>]</p>   
    </div>
    <script>
        function deletePost(e){
            'use strict';
            if(confirm('?????????????????????????????????????????????')){
                document.getElementById('form_delete').submit();
            }
        }
    </script>
    
    <script>
        window.latitude = @json($post->latitude);
        window.longitude = @json($post->longitude);
        window.address = @json($post->current_location);
    </script>
    
    <script src="{{ asset('js/map_show.js') }}"></script>
@endsection