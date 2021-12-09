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
    .carpooler-request {
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
    ::placeholder{
        opacity:0.4;
    }
    .form-control {
        width:97%;
    }
    .button, input, select, textarea {
        font-family: inherit;
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
@endsection

@section('content')
    <h1>検索ページ</h1>
    <p>出発地と目的地を入力してください。</p>
    <div class='carpooler-request'>
        <form action='/search/distanceMatrix' method='post' class='form-horizontal'>
            @csrf
            <table>
                <tr><th>出発日時：</th></tr>
                <tr><td><input class='start-datetime' type='datetime-local'name='start_datetime' value={{old('start_datetime')}}></td></tr>
                
                <tr><th>出発地：</th></tr>
                <tr><td><input type='text' id='from' placeholder='Origin' class='form-control' name='from'></td></tr>
                
                <tr><th>目的地：</th></tr>
                <tr><td><input type='text' id='to' placeholder='Desitination' class='form-control' name='to'></td></tr>
                
                <tr><th>経路：</th></tr>
                <tr>
                    <td>
                        <div id='map'></div>
                        <div id='output'></div>    
                    </td>
                </tr>
            </table>
            <p class='submit-btn'><input type='submit' value='検索'></p>
        </form>
    </div>
    
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&v=weekly"
        async
    ></script>
    
    <script src="{{ asset('js/map_directions.js') }}"></script>
    
@endsection