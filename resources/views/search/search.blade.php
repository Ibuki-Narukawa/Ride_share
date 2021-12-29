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
    .error-message {
        color:red;
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
        .carpooler-request {
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
        ::placeholder{
            opacity:0.4;
        }
        .form-control {
            width:97%;
        }
        .button, input, select, textarea {
            font-family: inherit;
        }
        .error-message {
            color:red;
        }
        #map {
            width: 100%;
            height: 300px;
            margin:20px auto;
        }
        #output {
            text-align: center;
            padding: 5px 0px;
        }
    }
@endsection

@section('content')
    <h1>ドライバー検索</h1>
    @if(count($errors)>0)
    <p>入力に問題があります。再入力してください。</p>
    @endif
    <div class='carpooler-request'>
        <form action='/search/distanceMatrix' method='post' class='form-horizontal'>
            @csrf
            <table>
                <tr><th>出発日時：</th></tr>
                <tr><td><input class='start-datetime' type='datetime-local'name='start_datetime' value={{old('start_datetime')}}></td></tr>
                @if($errors->has('start_datetime'))
                <tr><td class='error-message'>Error:{{$errors->first('start_datetime')}}</td></tr>
                @endif
                
                <tr><th>出発地：</th></tr>
                <tr><td><input type='text' id='from' placeholder='Origin' class='form-control' name='from' value={{old('from')}}></td></tr>
                @if($errors->has('from'))
                <tr><td class='error-message'>Error:{{$errors->first('from')}}</td></tr>
                @endif
                @if($errors->has('latFrom'))
                <tr><td class='error-message'>Error:{{$errors->first('latFrom')}}</td></tr>
                @endif
                
                <tr><th>目的地：</th></tr>
                <tr><td><input type='text' id='to' placeholder='Desitination' class='form-control' name='to' value={{old('to')}}></td></tr>
                @if($errors->has('to'))
                <tr><td class='error-message'>Error:{{$errors->first('to')}}</td></tr>
                @endif
                @if($errors->has('latTo'))
                <tr><td class='error-message'>Error:{{$errors->first('latTo')}}</td></tr>
                @endif
                
                <tr><th>経路：</th></tr>
                <tr>
                    <td>
                        <div id='map'></div>
                        <div id='output'></div>    
                    </td>
                </tr>
            </table>
            <p class='submit-btn'><button onclick='return submitPost(this);'>検索</button></p>
            <input name='latFrom' style='display:none' type='number' step='0.00000000000001' id='latFrom' value={{old('latFrom')}}>
            <input name='lngFrom' style='display:none' type='number' step='0.00000000000001' id='lngFrom' value={{old('lngFrom')}}>
            <input name='latTo' style='display:none' type='number' step='0.00000000000001' id='latTo' value={{old('latTo')}}>
            <input name='lngTo' style='display:none' type='number' step='0.00000000000001' id='lngTo' value={{old('lngTo')}}>
        </form>
    </div>
    
    {{--<script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&v=weekly"
        async
    ></script>--}}
    
    <script src="{{ asset('js/map_directions.js') }}"></script>
@endsection