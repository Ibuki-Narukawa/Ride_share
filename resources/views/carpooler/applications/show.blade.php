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
    .back-link {
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
    .button-bar {
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
        .back-link {
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
        .button-bar {
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
    <h1>?????????????????????</h1>
    <div class='application'>
        <table>
            <div class='name'>
                <tr><th>?????????<a href='/users/{{$application->user->id}}'>{{$application->user->name}}</a></th></tr> 
            </div>
            
            <div class='start-datetime'>
                <tr><td>???????????????{{$application->start_datetime}}</th></tr>
            </div>
            
            <div class='origin'>
                <tr><td>????????????{{$application->origin}}</td></tr>
            </div>
            
            <div class='destination'>
                <tr><td>????????????{{$application->destination}}</td></tr>
            </div>
            
            <tr><th>?????????</th></tr>
            <tr>
                <td>
                    <div id='map'></div>
                    <div id='output'></div>    
                </td>
            </tr>
            
            <div class='updated-at'>
                <tr><td>???????????????{{$application->updated_at}}</td></tr>
            </div>
            
            @if($application->status == 1 && Auth::id() == $application->driverPost->user_id)
                <div class='driver-info'>
                    <tr><th><a href='/driver/applications/{{$application->id}}'>?????????????????????</a></th></tr>
                </div>
            @endif
        </table>
    </div>
    
    @if($application->status == 1)
        @if(Auth::id() == $application->driverPost->user_id)
            <div class='button-bar'>
                <div class='btn approve-btn'>
                    <form action='/drives/create' id='form_approve' method='post' enctype='multipart/form-data'>
                        @csrf
                        <input style='display:none' type='number' name='carpooler_id' value={{$application->id}}>
                        <input style='display:none' type='number' name='driver_post_id' value={{$application->driver_post_id}}>
                        <input type='submit' style='display:none'>
                        <button><span onclick='return approveApplication(this);'>??????</span></button>
                    </form>
                </div>
                
                <div class='btn reject-btn'>
                    <form action='/carpooler/applications/{{$application->id}}' id='form_delete' method='post' enctype='multipart/form-data'>
                        @csrf
                        @method('delete')
                        <input type='submit' style='display:none'>
                        <button><span onclick='return rejectApplication(this);'>??????</span></button>
                    </form>
                </div>
            </div>
        
            <div class='back-link'>
                <p>[<a href='/carpooler/applications'>??????</a>]</p>   
            </div>
        @else
            <div class='back-link'>
                <p>[<a href='/driver/applications/{{$application->id}}'>??????</a>]</p>   
            </div>
        @endif
    @else
        <div class='back-link'>
            <p>[<a href='/drives/{{$application->drive_id}}'>??????</a>]</p>   
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
            if(window.confirm('?????????????????????????????????????????????????')){
                document.getElementById('form_approve').submit();
            }
        }
        
        function rejectApplication(e){
            event.preventDefault();
            'use strict';
            if(window.confirm('?????????????????????????????????????????????????')){
                document.getElementById('form_delete').submit();
            }
        }
    </script>
    
    <script src="{{ asset('js/map_directions_show.js') }}"></script>
    
@endsection