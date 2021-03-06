@extends('layouts.app')

@section('style')
    body {
        front-size:16px;
        color:#00BFFF;
    }
    h1 {
        font-size:50px; 
        color:#00BFFF; 
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
    .button-bar {
        width:60%;
        margin:0 auto;
        display:flex;
    }
    .btn {
        margin:20px;
        width:50%;
    }
    #map {
        width: 90%;
        height: 350px;
        margin:20px auto;
    }
    
    .confirm {
        text-align:center;
        color:red;
    }
    
    @media screen and (max-width:480px){
        body {
            front-size:16px;
            color:#00BFFF;
        }
        h1 {
            font-size:30px; 
            color:#00BFFF; 
            margin:20px;
            text-align:center;
        }
        .driver-post {
            width:90%;
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
        .button-bar {
            width:80%;
            margin:0 auto;
            display:flex;
        }
        .btn {
            margin:20px;
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
        @if(Auth::id() == $post->user_id)
            <p class='confirm'>??????????????????????????????????????????</p>
        @endif
    @endauth
    <div class='driver-post'>
        <table>
            <div class='name'>
                <tr><th>?????????<a href='/users/{{$post->user->id}}'>{{$post->user->name}}</a></th></tr>
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
        </table>
    </div>
    <div class='button-bar'>
        @auth
            @if(Auth::id() != $post->user_id)
                <div class='btn apply-btn'>
                    <form action='/carpooler/applications/create' method='post' id='form'>
                        @csrf
                        <input style='display:none' type='number' name='driver_post_id' value={{$post->id}}>
                        <input style='display:none' type='datetime-local' name='start_datetime' value={{$start_datetime}}>
                        <input style='display:none' type='text' name='from' value="{{$from}}">
                        <input style='display:none' type='text' name='to' value="{{$to}}">
                        <input name='latFrom' style='display:none' type='number' step='0.00000000000001' id='latFrom' value={{$latFrom}}>
                        <input name='lngFrom' style='display:none' type='number' step='0.00000000000001' id='lngFrom' value={{$lngFrom}}>
                        <input name='latTo' style='display:none' type='number' step='0.00000000000001' id='latTo' value={{$latTo}}>
                        <input name='lngTo' style='display:none' type='number' step='0.00000000000001' id='lngTo' value={{$lngTo}}>
                        <input type='submit' style='display:none'>
                        <button><span onclick='return applyPost(this);'>??????</span></button>
                    </form>
                </div>
            @endif
        @endauth
        
        <div class='btn back-btn'>
            <form action='/search/distanceMatrix' method='post'>
                @csrf
                <input style='display:none' type='datetime-local' name='start_datetime' value={{$start_datetime}}>
                <input style='display:none' type='text' name='from' value="{{$from}}">
                <input style='display:none' type='text' name='to' value="{{$to}}">
                <input name='latFrom' style='display:none' type='number' step='0.00000000000001' id='latFrom' value={{$latFrom}}>
                <input name='lngFrom' style='display:none' type='number' step='0.00000000000001' id='lngFrom' value={{$lngFrom}}>
                <input name='latTo' style='display:none' type='number' step='0.00000000000001' id='latTo' value={{$latTo}}>
                <input name='lngTo' style='display:none' type='number' step='0.00000000000001' id='lngTo' value={{$lngTo}}>
                <button type='submit'>??????</button>
            </form>
        </div>
    </div>
    
    <script>
        window.startDatetime = @json($start_datetime);
        window.origin = @json($from);
        window.To = @json($to);
        window.latFrom = @json($latFrom);
        window.lngFrom = @json($lngFrom);
        window.latTo = @json($latTo);
        window.lngTo = @json($lngTo);
        
        function applyPost(e){
            event.preventDefault();
            'use strict';
            if(window.confirm('????????????????????????????????????????????????????\n\n???????????????\n???????????????' + startDatetime + '\n????????????' + origin + '\n?????????' + latFrom + ' ?????????' + lngFrom +'\n????????????' + To  + '\n?????????' + latTo + ' ?????????' + lngTo)){
                document.getElementById('form').submit();
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