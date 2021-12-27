@extends('layouts.app')

@section('style')
    main {
        margin-top: 40px;
    }
    
    html, body {
        background-color: #fff;
        color: #00BFFF;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
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

    .links {
        padding-bottom: 25px;
    }
    
    .links > a {
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
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
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

            <div class="links">
                <a href="/search">ドライバー検索</a>
                <a href="/driver/applications">リクエスト送信履歴</a>
                <a href="/users">ユーザー一覧</a>
                <a href="/driver/posts/create">ドライバー登録</a>
                <a href="/driver/posts">ドライバー登録履歴</a>
                <a href="/carpooler/applications">「乗せて」一覧</a>
            </div>
            
            <div class="links">
    
            </div>
        </div>
    </div>
@endsection