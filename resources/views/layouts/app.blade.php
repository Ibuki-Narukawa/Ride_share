<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google-analytics.id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config.services.google-analytics.id', '');
    </script>
    
    @yield('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ride Share') }}</title>

    <!-- Scripts -->
    <!--<script src="https://js.stripe.com/v3/"></script>-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://maps.google.com/maps/api/js?v=3.exp&key={{ config('services.google-map.apikey') }}&language=ja&libraries=drawing,geometry,places,visualization"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        main {
            margin-top: 45px;
        }
        @yield('style')
        
        .FooterSection a{
          display: block;
          text-decoration: none;
        }
        .FooterSection img{
          width: 100%;
          height: auto;
        }
        
        .FooterSection {
          padding-top: 24px;
          padding-bottom: 24px;
          background: #F0F8FF;
        }
        .Footer-Inner {
          margin-left: auto;
          margin-right: auto;
          max-width: 1200px;
          width: 100%;
        }
    
        .Footer-Inner-List {
          margin-top: 20px;
          margin-left: auto;
          margin-right: auto;
          width: 100%;
          display: flex;
          justify-content: space-between;
        }
        @media screen and (max-width: 540px) {
          .Footer-Inner-List {
            flex-wrap: wrap;
            justify-content: center;
          }
        }
        .Footer-Inner-List-Item {
          margin-right: 2.3%;
          padding-left: 3%;
          text-align: center;
          color: #636b6f;
          font-weight: bold;
          font-size: 13px;
        }
        @media screen and (max-width: 540px) {
          .Footer-Inner-List-Item {
            margin-right: 0;
            padding-left: 0;
            width: 100%;
          }
        }
        .Footer-Inner-List-Item:not(:first-child) {
          border-left: 1px solid #636b6f;
        }
        @media screen and (max-width: 540px) {
          .Footer-Inner-List-Item:not(:first-child) {
            border-left: none;
            margin-top: 20px;
          }
        }
        .Footer-Inner-Contact-Email {
          margin-top: 30px;
          text-align: center;
          color: #636b6f;
          font-size: 12px; 
        }
        @media screen and (max-width: 540px) {
          .Footer-Inner-Contact-Email {
            font-size: 11px;
          }
        }
        .Footer-Inner-CopyRight {
          margin-top: 10px;
          text-align: center;
          color: #636b6f;
          font-size: 12px;
        }
        @media screen and (max-width: 540px) {
          .Footer-Inner-CopyRight {
            font-size: 11px;
          }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Ride Share') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <main class="py-4">
      @yield('content')
    </main>
    <div class="FooterSection">
      <div class="Footer">
        <div class="Footer-Inner">
          <div class="Footer-Inner-List">
            <a href="/search" class="Footer-Inner-List-Item">ドライバー検索</a>
            <a href="/driver/applications" class="Footer-Inner-List-Item">リクエスト送信履歴</a>
            <a href="/carpooler/applications" class="Footer-Inner-List-Item">「乗せて」一覧</a>
            <a href="/drives" class="Footer-Inner-List-Item">成立したドライブ一覧</a>
            @auth<a href="/users/{{Auth::id()}}" class="Footer-Inner-List-Item">マイページ</a>@endauth
            <a href="/driver/posts/create" class="Footer-Inner-List-Item">ドライバー登録</a>
            <a href="/driver/posts" class="Footer-Inner-List-Item">ドライバー登録履歴</a>
          </div>
          
          <div class="Footer-Inner-Contact-Email">
            お問い合わせは以下のメールアドレスまでお願いします.<br>
            ride.share.is2021@gmail.com 
          </div>
          
          <div class="Footer-Inner-CopyRight">
            Copyright © Ibuki Narukawa All Rights Reserved.
          </div>
        </div>
      </div>
    </div>
</body>
</html>
