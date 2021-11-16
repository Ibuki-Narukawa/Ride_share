@extends('layouts.app')

@section('style')
    body {
        front-size:16px;
        color:#999;
        }
    h1 {
        font-size:50px; 
        color:#999; 
        margin:20px;
        text-align:center;
        }
    .driver {
        padding:0px 5px;
        width:60%;
        margin:0 auto;
        margin-bottom:20px;
        }
    th {
        border: solid 1px #999;
        background-color:#999;
        color:#fff;
        padding:5px; 
        text-align:left;
        width:100vw;
        }
    td {
        border:solid 1px #aaa; 
        color:#999; 
        text-align:left;
        padding:10px;
        width:100vw;
        }
    img{
        width:200px;
        }
@endsection

@section('content')
    <h1>Driver List</h1>
    <div class='drivers'>
        <div class='driver'>
            <table>
                <div class='name'>
                    <tr><th>Ibuki</th></tr>
                </div>
                <div class='car'>
                    <tr><td>車種： ソリオ</td></tr>
                    <tr>
                        <td>
                            <div style="text-align: center">
                                <image src="{{ asset('img/solio.jpg',true) }}" >
                            </div>
                        </td
                    </tr>
                </div>
                <div class='start-address'>
                    <tr><td>出発地：六甲駅</td></tr>
                </div>
                <div class='end-address'>
                    <tr><td>到着地：三ノ宮駅</td></tr>
                </div>
                <div class='arrival-time'>
                    <tr><td>所要時間：15分</td></tr>
                </div>
                <div class='request'>
                    <tr><td>してほしいこと：おすすめのカフェ教えてください！</td></tr>
                </div>
            </table>
        </div>
    </div>
@endsection