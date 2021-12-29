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
            position: absolute;
            right: 10px;
            top: 18px;
        }
    
        .content {
            text-align: center;
        }
    
        .title {
            font-size: 84px;
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
            margin-bottom: 35px;
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
            right: 10px;
            top: 18px;
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
        <!--@if (Route::has('login'))-->
        <!--    <div class="top-right links">-->
        <!--        @auth-->
        <!--            <a href="{{ url('/home') }}">Home</a>-->
        <!--        @else-->
        <!--            <a href="{{ route('login') }}">Login</a>-->

        <!--            @if (Route::has('register'))-->
        <!--                <a href="{{ route('register') }}">Register</a>-->
        <!--            @endif-->
        <!--        @endauth-->
        <!--    </div>-->
        <!--@endif-->

        <div class="content">
            <div class="title m-b-md">
                Ride Share
            </div>
            <!--<h5>自家用車のライドシェアサービス</h5>-->
            
            <div class="links-pc">
                <a href="/search">ドライバー検索</a>
                <a href="/driver/applications">リクエスト送信履歴</a>
                <a href="/users">ユーザー一覧</a>
                <a href="/driver/posts/create">ドライバー登録</a>
                <a href="/driver/posts">ドライバー登録履歴</a>
                <a href="/carpooler/applications">「乗せて」一覧</a>
                <a href="/drives">成立したドライブ一覧</a>     
            </div>
            
            <div class="links-phone">
                <ul>
                    <li><a href="/search">ドライバー検索</a></li>
                    <li><a href="/driver/applications">リクエスト送信履歴</a></li>
                    <li><a href="/users">ユーザー一覧</a></li>
                    <li><a href="/driver/posts/create">ドライバー登録</a></li>
                    <li><a href="/driver/posts">ドライバー登録履歴</a></li>
                    <li><a href="/carpooler/applications">「乗せて」一覧</a></li>
                    <li><a href="/drives">成立したドライブ一覧</a></li>    
                </ul>
            </div>
        </div>
    </div>
@endsection