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
    
    #map{
        width: 70%;
        height: 350px;
        margin:20px auto;
    }
    
    #output{
        margin:20px auto;
    }
@endsection

@section('content')
    <div class='container'>
        <h1>検索ページ</h1>
        <p>出発地と目的地を入力してください。</p>
        <form class='form-horizontal'>
            <div class='form-group'>
                <div class='start-address'>
                    <p>出発地：<input type='text' id='from' placeholder='Origin' class='form-control'></p>
                </div>
                
                <div class='end-address'>
                    <p>目的地：<input type='text' id='to' placeholder='Desitination' class='form-control'></p>
                </div>
            </div>
        </form>
        <div class='btn'>
            <button id='search' onclick='calcRoute();'>検索</button>
        </div>
        
        <div id='map'>
        
        </div>
        
        <div id='output'>
            
        </div>
    </div>
    
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&v=weekly"
        async
    ></script>
    
    <script src="{{ asset('js/map.js') }}"></script>
    
@endsection