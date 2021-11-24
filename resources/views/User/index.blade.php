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
@endsection

@section('content')
    <h1>User List</h1>
    <div class='users'>
        @foreach($users as $user)
        <div class='user'>
            <table>
                <div class='name'>
                    <tr><th>氏名：<a href='/users/{{$user->id}}'>{{$user->name}}</a></th></tr>
                </div>
                <div class='email'>
                    <tr><td>email: {{$user->email}}</td></tr>
                </div>
                <div class='age'>
                    <tr><td>age: {{$user->age}} 歳</td></tr>
                </div>
            </table>
        </div>
        @endforeach
    </div>
    <p class='pagination'>
        {{$users->links()}}
    </p> 
@endsection