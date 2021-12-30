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
    .drive {
        width:75vw;
        margin:0 auto;
        margin-bottom:20px;
    }
    table {
        table-layout: fixed;
        width:100%;
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
    .pagination {
        margin-left:10%;
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
        .drive {
            width:90vw;
            margin:0 auto;
            margin-bottom:20px;
        }
        table {
            table-layout: fixed;
            width:100%;
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
        .pagination {
            margin-left:10%;
        }
    }
@endsection

@section('content')
    <h1>成立したドライブ一覧</h1>
    <div class='drives'>
        @foreach($drives as $drive)
        <div class='drive'>
            <table>
                <div class='role'>
                    @if (Auth::id() == $drive->carpooler->user_id)
                        <tr><th>あなたの役割：<a href='/drives/{{$drive->id}}'>相乗り者</a></th></tr>
                    @elseif (Auth::id() == $drive->driverPost->user_id)
                        <tr><th>あなたの役割：<a href='/drives/{{$drive->id}}'>ドライバー</a></th></tr>
                    @else
                        <tr><th>あなたの役割：<a href='/drives/{{$drive->id}}'>未定</a></th></tr>
                    @endif
                </div>
                
                <div class='driver_name'>
                    <tr><td>ドライバー名：{{$drive->driverPost->user->name}}</td></tr>
                </div>
                
                <div class='carpooler_name'>
                    <tr><td>相乗り者名：{{$drive->carpooler->user->name}}</td></tr>
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
            </table>
        </div>
        @endforeach
    </div>
    <div>
        <p class='pagination'>
            {{$drives->links()}}
        </p>
    </div>
@endsection