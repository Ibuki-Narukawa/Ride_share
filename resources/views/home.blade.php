@extends('layouts.app')

@section('style')
    @media screen and (min-width:550px){
        main {
            margin-top: 37px;
        }
        
        html, body {
            background-color: #fff;
            color: #00BFFF;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 85vh;
            margin: 0;
        }
    
        .full-height {
            height: 85vh;
        }
    
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
    
        .position-ref {
            position: relative;
        }
    
        .top-right {
            display: none;
        }
    
        .content {
            text-align: center;
        }
    
        .title {
            font-size: 84px;
        }
        
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        
        .links-pc {
            margin-bottom: 35px;
        }
        
        .links-pc > a {
            color: #636b6f;
            padding: 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    
        .m-b-md {
            margin-bottom: 30px;
        }
        
        .links-phone {
            display: none;
        }
        
        h5 {
            margin-top: -35px;
            margin-bottom: 60px;
        }
    }
    
    @media screen and (max-width:550px){
        main {
            margin-top: 0px;
        }
        
        html, body {
            padding-top: 30px;
            background-color: #fff;
            color: #00BFFF;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 85vh;
            margin: 0;
        }
    
        .full-height {
            height: 85vh;
        }
    
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
    
        .position-ref {
            position: relative;
        }
    
        .top-right {
            position: absolute;
            right: 0.1vw;
            top: 0vh;
        }
        
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        
        .content {
            text-align: center;
        }
    
        .title {
            font-size: 50px;
        }
        
        .links-phone a {
            color: #636b6f;
            padding: 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    
        .m-b-md {
            margin-bottom: 30px;
        }
        
        ul {
            margin-left:-40px;
            margin-bottom: 0rem;
            list-style-type: none;
        }
        
        li {
            padding-top: 15px;
            padding-bottom: 15px;
        }
        
        .links-pc {
            display: none;
        }
        
        h5 {
            margin-top: -25px;
            margin-bottom: 30px;
        }
    }
@endsection

@section('content')
    <div class="flex-center position-ref full-height center">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/') }}">?????????</a>
                @else
                    <a href="{{ route('login') }}">????????????</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">????????????</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Ride Share
            </div>
            <h5>?????????????????????<br>email???test@gmail.com<br>password???laraveltest</h5>
            
            <div class="links-pc">
                <a href="/search">?????????????????????</a>
                @auth
                    <a href="/users/{{Auth::id()}}">???????????????</a>
                @endauth
                <a href="/driver/applications">???????????????????????????</a>
                <a href="/carpooler/applications">?????????????????????</a>
            </div>
            
            <div class="links-pc">
                <a href="/drives">?????????????????????????????????</a>
                <a href="/history/drives">???????????????????????????</a>
                <a href="/driver/posts/create">?????????????????????</a>
                <a href="/driver/posts">???????????????????????????</a>
            </div>
                
            <div class="links-phone">
                <ul>
                    <li><a href="/search">?????????????????????</a></li>
                    @auth
                        <li><a href="/users/{{Auth::id()}}">???????????????</a></li>
                    @endauth
                    <li><a href="/driver/applications">???????????????????????????</a></li>
                    <li><a href="/carpooler/applications">?????????????????????</a></li>
                    <li><a href="/drives">?????????????????????????????????</a></li>
                    <li><a href="/history/drives">???????????????????????????</a></li>
                    <li><a href="/driver/posts/create">?????????????????????</a></li>
                    <li><a href="/driver/posts">???????????????????????????</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection