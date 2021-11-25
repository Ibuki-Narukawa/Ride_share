@extends('layouts.app')

@section('style')
    body {
        front-size:16px;
        color:#87CEFA;
        text-align:center;
        }
    h1 {
        font-size:50px; 
        color:#87CEFA; 
        margin:20px;
        }
    .user {
        padding:0px 5px;
        width:70vw;
        margin:0 auto;
        margin-bottom:20px;
        }
    table{
        table-layout: fixed;
        width:100%;
        }
    th {
        border: solid 1px #87CEFA;
        background-color:#87CEFA;
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
    img{
        width:200px;
        }
@endsection

@section('content')
    <h1>My Page</h1>
    <div class='operationBar'>
        <div class='editBtn btn'>
            <h3>[<a href='/users/{{$user->id}}/edit'>Edit</a>]</h3>
        </div>
    </div>
    <div class='user'>
        <table>
            <div class='name'>
                <tr><th>氏名：{{$user->name}}</a></th></tr>
            </div>
            <div class='gender'>
                @if($user->gender==1)
                <tr><td>性別：男</td></tr>
                @else
                <tr><td>性別：女</td></tr>
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
                            <image src="{{ asset('img/users/'.$image_filename,true) }}">
                        </div>
                        </td>
                    </tr>
                </div>
            <div class='email'>
                <tr><td>email: {{$user->email}}</td></tr>
            </div>
            <div class='age'>
                <tr><td>age: {{$user->age}} 歳</td></tr>
            </div>
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
    <div class='footer'>
        <p>[<a href='/users'>back</a>]</p>   
    </div>
@endsection