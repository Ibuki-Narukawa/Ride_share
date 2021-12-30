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
    .user {
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
        h3 {
            font-size:20px;
        }
        .user {
            width:90vw;
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
    }
@endsection

@section('content')
    @auth
        @if(Auth::id()==$user->id)
            <h1>マイページ</h1>
            <div class='button-bar'>
                <div class='edit-btn btn'>
                    <h3>[<a href='/users/{{$user->id}}/edit'>編集</a>]</h3>
                </div>
            </div>
        @else
            <h1>プロフィール</h1>
        @endif
    @endauth
    
    <div class='user'>
        <table>
            <div class='name'>
                <tr><th>氏名：{{$user->name}}</a></th></tr>
            </div>
            <div class='gender'>
                @if($user->gender==1)
                <tr><td>性別：男性</td></tr>
                @else
                <tr><td>性別：女性</td></tr>
                @endif
            </div>
            <div class='user_image'>
                <tr>
                    <td>
                        <div style='text-align: center'>
                        @php
                        $image_filename = $user->user_image;
                        @endphp
                        <p>{{$image_filename}}</p>
                        <image src="{{ Storage::disk('s3')->url("img/users/".$image_filename) }}" alt="">
                    </div>
                    </td>
                </tr>
            </div>
            <div class='age'>
                <tr><td>age: {{$user->age}} 歳</td></tr>
            </div>
            @auth
                @if(Auth::id()==$user->id)
                    <div class='email'>
                        <tr><td>email: {{$user->email}}</td></tr>
                    </div>
                @endif
            @endauth
            <div class='self_introduction'>
                <tr>
                    <td>
                        <p>自己紹介文：</p>
                        <p>{{$user->self_introduction}}</p>
                    </td>
                </tr>
            </div>
        </table>
    </div>
@endsection