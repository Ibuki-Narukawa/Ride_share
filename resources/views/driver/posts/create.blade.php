@extends('layouts.app')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
    .driver-post {
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
    ::placeholder {
        opacity:0.4;
    }
    .current-location {
        width:97%;
    }
    .asking {
        width:97%;
    }
    .error-message {
        color:red;
    }
    .button, input, select, textarea {
        font-family: inherit;
    }
    #map {
        width: 90%;
        height: 350px;
        margin:20px auto;
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
        .driver-post {
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
        ::placeholder {
            opacity:0.4;
        }
        .current-location {
            width:97%;
        }
        .asking {
            width:97%;
        }
        .error-message {
            color:red;
        }
        .button, input, select, textarea {
            font-family: inherit;
        }
        #map {
            width: 100%;
            height: 300px;
            margin:20px auto;
        }    
    }
@endsection

@section('content')
    <h1>???????????????????????????</h1>
    @if(count($errors)>0)
    <p>???????????????????????????????????????????????????????????????</p>
    @endif
    <div class='driver-post'>
        <form action='/driver/posts/create' method='post' enctype='multipart/form-data'???id='form_create'>
            @csrf
            <table>
                <tr><th>?????????????????????</th></tr>
                <tr><td><input class='start-datetime' type='datetime-local'name='start_datetime' value={{old('start_datetime')}}></td></tr>
                @if($errors->has('start_datetime'))
                <tr><td class='error-message'>Error:{{$errors->first('start_datetime')}}</td></tr>
                @endif
                
                <tr><th>?????????????????????</th></tr>
                <tr><td><input class='end-datetime' type='datetime-local'name='end_datetime' value={{old('end_datetime')}}></td></tr>
                @if($errors->has('end_datetime'))
                <tr><td class='error-message'>Error:{{$errors->first('end_datetime')}}</td></tr>
                @endif
                
                <tr><th>????????????</th></tr>
                <tr><td><input class='current-location' type='text' id="address" name='current_location' placeholder='????????????????????????????????????4??????' value="{{old('current_location')}}"></td></tr>
                <tr>
                    <td>
                        <div id="map"></div>
                        <div id="infowindow-content">
                            <span id="place-name" class="title"></span><br />
                            <span id="place-address"></span>
                        </div>
                    </td>
                </tr>
                @if($errors->has('current_location'))
                <tr><td class='error-message'>Error:{{$errors->first('current_location')}}</td></tr>
                @endif
                @if($errors->has('latitude'))
                <tr><td class='error-message'>Error:{{$errors->first('latitude')}}</td></tr>
                @endif
                
                <tr><th>?????????????????????????????????????????????</th></tr>
                <tr><td><textarea class='asking' name='asking' placeholder='????????????????????????????????????????????????' value={{old('asking')}}></textarea></td></tr>
                @if($errors->has('request'))
                <tr><td class='error-message'>Error:{{$errors->first('request')}}</td></tr>
                @endif
                
                <tr><th>?????????</th></tr>
                <tr><td><input class='car-model' type='text' name='car_model' placeholder='?????????' value={{old('car_model')}}></td></tr>
                @if($errors->has('car_model'))
                <tr><td class='error-message'>Error:{{$errors->first('car_model')}}</td></tr>
                @endif
                
                <tr><th>????????????????????????</th></tr>
                <tr><td><input class='max-passengers' type='number' name='max_passengers' min='1' max='10' placeholder='1' value={{old('max_passengers')}}>????????????</td></tr>
                @if($errors->has('max_passengers'))
                <tr><td class='error-message'>Error:{{$errors->first('max_passengers')}}</td></tr>
                @endif
                
                <tr><th>???????????????</th></tr>
                <tr><td><input class='car-image' type='file' name='car_image' accept='image/png, image/jpeg' value={{old('car_image')}}></td></tr>
                @if($errors->has('car_image'))
                <tr><td class='error-message'>Error:{{$errors->first('car_image')}}</td></tr>
                @endif
            </table>
            <input name='lat' style='display:none' type='number' step='0.00000000000001' id='lat' value={{old('lat')}}>
            <input name='lng' style='display:none' type='number' step='0.00000000000001' id='lng' value={{old('lng')}}>
            <p class='submit-btn'><button onclick='return submitPost(this);'>??????</button></p>
        </form>
    </div>
    <div class='back-link'>
        <p>[<a href='/'>??????</a>]</p>  
    </div>
    
    <script>
        var latitude;
        var longitude;
        var address;
    </script>
    
    <script src="{{ asset('js/map_place.js') }}"></script>
@endsection