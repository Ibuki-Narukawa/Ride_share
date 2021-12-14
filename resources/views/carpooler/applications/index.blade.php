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
@endsection

@section('content')
    <h1>相乗り者リクエスト一覧</h1>
    <div class='applications'>
        @foreach($applications as $application)
        <div class='application'>
            <table>
                <div class='name'>
                    <tr><th>氏名：<a href='/carpooler/applications/{{$application->id}}'>{{$application->user->name}}</a></th></tr>
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
                    <tr><td>{{$application->updated_at}}</td></tr>
                </div>
            </table>
        </div>
        @endforeach
    </div>
    <p class='pagination'>
        {{$applications->links()}}
    </p> 
@endsection