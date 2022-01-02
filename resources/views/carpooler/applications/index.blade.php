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
    .application {
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
        .application {
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
    <h1>「乗せて」一覧</h1>
    <div class='applications'>
        @foreach($applications as $application)
        <div class='application'>
            <table>
                <div class='name'>
                    <tr><th>相乗り者名：<a href='/carpooler/applications/{{$application->id}}'>{{$application->user->name}}</a></th></tr>
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
                <div class='updated-at'>
                    <tr><td>着信日時：{{$application->updated_at}}</td></tr>
                </div>
            </table>
        </div>
        @endforeach
    </div>
    <p class='pagination'>
        {{$applications->links()}}
    </p> 
@endsection
