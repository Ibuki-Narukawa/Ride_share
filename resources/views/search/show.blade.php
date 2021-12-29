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
    .footer {
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
        .footer {
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
    <h1>ドライバー詳細</h1>
    <div class='driver-post'>
        <table>
            <div class='name'>
                <tr><th>氏名：<a href='/users/{{$post->user->id}}'>{{$post->user->name}}</a></th></tr>
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
        </table>
    </div>
    <div class='footer'>
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
                <button class='operationBar'><span onclick='return applyPost(this);'>申請する</span></button>
            </form>
        </div>
        
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
                <button type='submit'>戻る</button>
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
            if(window.confirm('本当にこのドライバーに申請しますか?\n\n検索データ\n出発時刻：' + startDatetime + '\n出発地：' + origin + '\n緯度：' + latFrom + ' 経度：' + lngFrom +'\n目的地：' + To  + '\n緯度：' + latTo + ' 経度：' + lngTo)){
                document.getElementById('form').submit();
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