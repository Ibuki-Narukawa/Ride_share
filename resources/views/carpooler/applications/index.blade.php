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
    .carpooler {
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
    <div class='carpoolers'>
        @foreach($carpoolers as $carpooler)
        <div class='carpooler'>
            <table>
                <div class='name'>
                    <tr><th>氏名：{{$carpooler->user->name}}</th></tr>
                </div>
                <div class='start-datetime'>
                    <tr><td>出発日時：{{$carpooler->start_datetime}}</th></tr>
                </div>
                <div class='origin'>
                    <tr><td>出発地：{{$carpooler->origin}}</td></tr>
                </div>
                <div class='destination'>
                    <tr><td>目的地：{{$carpooler->destination}}</td></tr>
                </div>
                <div class='updated-at'>
                    <tr><td>{{$carpooler->updated_at}}</td></tr>
                </div>
            </table>
        </div>
        @endforeach
    </div>
@endsection
