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
        padding-left:5px;
        font-size:5px;
    }
    .delete-btn:hover {
        cursor: pointer;
    }
    .my-message {
        width:40%;
        margin-left:60%;
    }
    .partner-message{
        width: 40%;
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
            font-size:5px;
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
    <h1>ドライブ詳細</h1>
    <div class='drive'>
        <table>
            <tr><th>ドライブ情報</th></tr>
            
            <div class='driver_name'>
                <tr><td>ドライバー名：<a href='/driver/applications/{{$drive->carpooler->id}}'>{{$drive->driverPost->user->name}}</a></td></tr>
            </div>
                
            <div class='carpooler_name'>
                <tr><td>相乗り者名：<a href='/carpooler/applications/{{$drive->carpooler->id}}'>{{$drive->carpooler->user->name}}</a></td></tr>
            </div>
            
            <div class='start-datetime'>
                <tr><td>出発日時：{{$drive->carpooler->start_datetime}}</th></tr>
            </div>
            
            <div class='origin'>
                <tr><td>出発地：{{$drive->carpooler->origin}}</td></tr>
            </div>
            
            <div class='destination'>
                <tr><td>目的地：{{$drive->carpooler->destination}}</td></tr>
            </div>
            
            <div class='driver_location'>
                <tr><td>ドライバーの現在地：{{$drive->driverPost->current_location}}</td></tr>
            </div>
            <tr><th>ドライバーの現在地から出発地までの経路：</th></tr>
            <tr>
                <td>
                    <div id='map'></div>
                    <div id='output'></div>    
                </td>
            </tr>
        </table>
        
        <div class='messages'>
            <h1>メッセージ欄</h1>
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
                                <p class='created_at'>{{$message->created_at}}　 <span class='delete-btn' onclick='return deleteMessage({{$message->id}});'>削除</span></p>
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
            
            <form action='/drives/messages/create' method='post' enctype='multipart/form-data'　id='message_create'>
                @csrf
                <input style='display:none' type='number' name='drive_id' value={{$drive->id}}>
                <input style='display:none' type='number' name='user_id' value={{Auth::id()}}>
                <textarea class='comment' name='comment' placeholder='こんにちは！' value="{{old('comment')}}"></textarea>
                <input class='submit-btn ' type='submit' value='送信'>
            </form>
            @if($errors->has('comment'))
                <p class='error-message'>Error:{{$errors->first('comment')}}</p>
            @endif
        </div>
    </div>
    
    <div class='back-link'>
        <p>[<a href='/drives'>戻る</a>]</p>   
    </div>
    
    <script>
        function deleteMessage(id){
            'use strict';
            var form_id = 'form_delete'+ id;
            if(confirm('本当にこのメッセージを削除しますか？')){
                document.getElementById(form_id).submit();
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