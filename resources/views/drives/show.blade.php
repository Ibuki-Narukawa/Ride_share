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
    .drive {
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
        height: 400px;
        margin:20px auto;
    }
    #output {
        text-align: center;
        padding: 5px;
    }
    .messages {
        margin-top:30px;
    }
    .messages-space{
        border:solid 1px #aaa; 
        color:#999; 
        text-align:left;
        padding:10px;
        height:400px;
        overflow:auto;
    }
    form {
        display:flex;
    }
    .comment {
        width:100%;
        margin:0 auto;
    }
    ::placeholder {
        opacity:0.4;
    }
    .messages h2 {
        border-bottom:solid 1px #aaa;
    }
    table.message-table{
        overflow-wrap:break-word;
        margin-bottom:10px;
        border-collapse: separate;
        overflow: hidden;
        border-spacing: 0;
        border-radius: 10px;
        border: 1px solid #aaa;
    }
    .message-table th, .message-table td {
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid #aaa;
    }
    .message-table tr:last-child td {
        border-bottom: none;
    }
    .created_at {
        margin-top:-7px;
        margin-bottom:17px;
        padding-left:12px;
        font-size:5px;
    }
    .delete-btn:hover {
        cursor: pointer;
    }
    .my-message {
        width:40%;
        margin-left:60%;
    }
    .partner-message {
        width: 40%;
    }
    .complete-btn p {
        margin:35px 0px;
    }
    .complete-btn form {
        display:inline;
    }
    .drive-complete {
        text-align:center;
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
        .drive {
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
        .messages {
            margin-top:30px;
        }
        .messages-space{
            border:solid 1px #aaa; 
            color:#999; 
            text-align:left;
            padding:10px;
            height:400px;
            overflow:auto;
        }
        form {
            display:flex;
        }
        .comment {
            width:100%;
            margin:0 auto;
        }
        ::placeholder {
            opacity:0.4;
        }
        .messages h2 {
            border-bottom:solid 1px #aaa;
        }
        table.message-table{
            overflow-wrap:break-word;
            margin-bottom:10px;
            border-collapse: separate;
            overflow: hidden;
            border-spacing: 0;
            border-radius: 10px;
            border: 1px solid #aaa;
        }
        .message-table th, .message-table td {
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 1px solid #aaa;
        }
        .message-table tr:last-child td {
            border-bottom: none;
        }
        .created_at {
            margin-top:-7px;
            margin-bottom:17px;
            padding-left:5px;
            font-size:10px;
        }
        .delete-btn:hover {
            cursor:pointer;
        }
        .my-message {
            width:45%;
            margin-left:55%;
        }
        .partner-message{
            width:45%;
        }
    }
@endsection

@section('content')
    <h1>??????????????????</h1>
    <div class='drive'>
        <table>
            <tr><th>??????????????????</th></tr>
            
            <div class='status'>
                @if($drive->driverPost->status==1)
                <tr><td>???????????????</td></tr>
                @elseif($drive->driverPost->status==2)
                <tr><td>?????????????????????</td></tr>
                @elseif($drive->driverPost->status==3)
                <tr><td>???????????????????????????</td></tr>
                @endif
            </div>
            
            <div class='driver_name'>
                <tr><td>?????????????????????<a href='/driver/applications/{{$drive->carpooler->id}}'>{{$drive->driverPost->user->name}}</a></td></tr>
            </div>
                
            <div class='carpooler_name'>
                <tr><td>??????????????????<a href='/carpooler/applications/{{$drive->carpooler->id}}'>{{$drive->carpooler->user->name}}</a></td></tr>
            </div>
            
            <div class='start-datetime'>
                <tr><td>???????????????{{$drive->carpooler->start_datetime}}</th></tr>
            </div>
            
            <div class='origin'>
                <tr><td>????????????{{$drive->carpooler->origin}}</td></tr>
            </div>
            
            <div class='destination'>
                <tr><td>????????????{{$drive->carpooler->destination}}</td></tr>
            </div>
            
            <div class='driver_location'>
                <tr><td>??????????????????????????????{{$drive->driverPost->current_location}}</td></tr>
            </div>
            <tr><th>????????????????????????????????????????????????????????????</th></tr>
            <tr>
                <td>
                    <div id='map'></div>
                    <div id='output'></div>    
                </td>
            </tr>
        </table>
        
        <div class='messages'>
            <h1>??????????????????</h1>
            <div class='messages-space'>
                @foreach($messages as $message)
                    @if(Auth::id()==$message->user_id)
                        <div class='my-message'>
                            <table class='message-table'>
                            <tr><th>{{$message->user->name}}</th></tr>
                            <tr><td>{{$message->comment}}</td></tr>
                            </table>
                            <form action='/drives/messages/{{$message->id}}' id='form_delete{{$message->id}}' method='post' enctype='multipart/form-data'>
                                @csrf
                                @method('delete')
                                <input type='submit' style='display:none'>
                                <p class='created_at'>{{$message->created_at}}??? <span class='delete-btn' onclick='return deleteMessage({{$message->id}});'>??????</span></p>
                            </form>
                        </div>
                    @else
                        <div class='partner-message'>
                            <table class='message-table'>
                                <tr><th>{{$message->user->name}}</th></tr>
                                <tr><td>{{$message->comment}}</td></tr>
                            </table>
                            <p class='created_at'>{{$message->created_at}}</p>
                        </div>
                    @endif
                @endforeach
            </div>
            
            <form action='/drives/messages/create' method='post' enctype='multipart/form-data'???id='message_create'>
                @csrf
                <input style='display:none' type='number' name='drive_id' value={{$drive->id}}>
                <input style='display:none' type='number' name='user_id' value={{Auth::id()}}>
                <textarea class='comment' name='comment' placeholder='??????????????????' value="{{old('comment')}}"></textarea>
                <input class='submit-btn ' type='submit' value='??????'>
            </form>
            @if($errors->has('comment'))
                <p class='error-message'>Error:{{$errors->first('comment')}}</p>
            @endif
        </div>
    </div>
    
    @auth
        @if($drive->driverPost->status == 2)
            <div class='complete-btn'>
                <form action='/drives/{{$drive->id}}' id='drive_complete' class='drive-complete' method='post' enctype='multipart/form-data'>
                    @csrf
                    @method('put')
                    <input type='submit' style='display:none'>
                    <p><button><span onclick='return completeDrive(this);'>??????????????????</span></button></p>
                </form>
            </div>
        @endif
    @endauth
    
    @if($drive->driverPost->status == 2)
        <div class='back-link'>
            <p>[<a href='/drives'>??????</a>]</p>   
        </div>
    @else
        <div class='back-link'>
            <p>[<a href='/history/drives'>??????</a>]</p>   
        </div>
    @endif
    
    <script>
        function deleteMessage(id){
            'use strict';
            var form_id = 'form_delete'+ id;
            if(window.confirm('??????????????????????????????????????????????????????')){
                document.getElementById(form_id).submit();
            }
        }
    </script>
    
    <script>
        function completeDrive(e){
            event.preventDefault();
            'use strict';
            if(window.confirm('????????????????????????????????????????????????????')){
                document.getElementById('drive_complete').submit();
            }
        }
    </script>
    
    <script>
        window.startDatetime = @json($drive->carpooler->start_datetime);
        window.origin = @json($drive->driverPost->current_location);
        window.destination = @json($drive->carpooler->origin);
        window.latFrom = @json($drive->driverPost->latitude);
        window.lngFrom = @json($drive->driverPost->longitude);
        window.latTo = @json($drive->carpooler->latitude_from);
        window.lngTo = @json($drive->carpooler->longitude_from);
    </script>
    
    <script src="{{ asset('js/map_directions_show.js') }}"></script>
@endsection