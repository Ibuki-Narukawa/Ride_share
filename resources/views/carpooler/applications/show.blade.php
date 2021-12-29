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
    .application {
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
        //width:60%;
        //margin:0 auto;
         //display:flex;
        text-align:center;
    }

    #map {
        width: 90%;
        height: 350px;
        margin:20px auto;
    }
    #output {
        text-align: center;
        padding: 5px;
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
        .application {
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
        .footer {
            //width:60%;
            //margin:0 auto;
             //display:flex;
            text-align:center;
        }
    
        #map {
            width: 100%;
            height: 300px;
            margin:20px auto;
        }
        #output {
            text-align: center;
            padding: 0px;
        }
        .operationBar {
            width:80%;
            margin:0 auto;
            display:flex;
        }
        .btn {
            text-align:center;
            width:50%;
        }    
    }
@endsection

@section('content')
    <h1>リクエスト詳細</h1>
    <div class='application'>
        <table>
            <div class='name'>
                <tr><th>氏名：<a href='/users/{{$application->user->id}}'>{{$application->user->name}}</a></th></tr> 
            </div>
            
            <div class='start-datetime'>
                <tr><td>出発日時：{{$application->start_datetime}}</th></tr>
            </div>
            
            <div class='origin'>
                <tr><td>出発地：{{$application->origin}}</td></tr>
            </div>
            
            <div class='destination'>
                <tr><td>目的地：{{$application->destination}}</td></tr>
            </div>
            
            <tr><th>経路：</th></tr>
            <tr>
                <td>
                    <div id='map'></div>
                    <div id='output'></div>    
                </td>
            </tr>
            
            <div class='updated-at'>
                <tr><td>着信日時：{{$application->updated_at}}</td></tr>
            </div>
        </table>
    </div>
    
    @if($application->status == 1)
    <div class='operationBar'>
        <div class='btn approve-btn'>
            <form action='/drives/create' id='form_approve' method='post' enctype='multipart/form-data'>
                @csrf
                <input style='display:none' type='number' name='carpooler_id' value={{$application->id}}>
                <input style='display:none' type='number' name='driver_post_id' value={{$application->driver_post_id}}>
                <input type='submit' style='display:none'>
                <button><span onclick='return approveApplication(this);'>承認する</span></button>
            </form>
        </div>
        
        <div class='btn reject-btn'>
            <form action='/carpooler/applications/{{$application->id}}' id='form_delete' method='post' enctype='multipart/form-data'>
                @csrf
                @method('delete')
                <input type='submit' style='display:none'>
                <button><span onclick='return rejectApplication(this);'>拒否する</span></button>
            </form>
        </div>
    </div>
    
    <div class='footer'>
        <p>[<a href='/carpooler/applications'>戻る</a>]</p>   
    </div>
    @else
    <div class='footer'>
        <p>[<a href='/drives/{{$application->drive_id}}'>戻る</a>]</p>   
    </div>
    @endif
    
    
    <script>
        window.startDatetime = @json($application->start_datetime);
        window.origin = @json($application->origin);
        window.destination = @json($application->destination);
        window.latFrom = @json($application->latitude_from);
        window.lngFrom = @json($application->longitude_from);
        window.latTo = @json($application->latitude_to);
        window.lngTo = @json($application->longitude_to);
        
        function approveApplication(e){
            event.preventDefault();
            'use strict';
            if(window.confirm('本当にこの相乗り者を承認しますか?')){
                document.getElementById('form_approve').submit();
            }
        }
        
        function rejectApplication(e){
            event.preventDefault();
            'use strict';
            if(window.confirm('本当にこの相乗り者を拒否しますか?')){
                document.getElementById('form_delete').submit();
            }
        }
    </script>
    
    {{--<script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&v=weekly"
        async
    ></script>--}}
    
    <script src="{{ asset('js/map_directions_show.js') }}"></script>
    
@endsection