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
            @if($application->status == 1 && Auth::id() == $application->user->id)
                <div class='carpooler-info'>
                    <tr><th><a href='/carpooler/applications/{{$application->id}}'>リクエスト詳細</a></th></tr>
                </div>
            @endif
        </table>
    </div>
    <div class='back-link'>
        <!--<div class='btn delete-btn'>-->
            
        <!--</div>-->
        @if($application->status == 1)
            @if(Auth::id() == $application->user->id)
                <p>[<a href='/driver/applications'>戻る</a>]</p>
            @else
                <p>[<a href='/carpooler/applications/{{$application->id}}'>戻る</a>]</p>
            @endif
        @else
            <p>[<a href='/drives/{{$application->drive_id}}'>戻る</a>]</p>
        @endif
        
    </div>
    
    <script>
        window.latitude = @json($post->latitude);
        window.longitude = @json($post->longitude);
        window.address = @json($post->current_location);
    </script>
    
    <script src="{{ asset('js/map_show.js') }}"></script>
@endsection