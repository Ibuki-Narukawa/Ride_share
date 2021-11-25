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
    .driver-post {
        padding:0px 5px;
        width:70vw;
        margin:0 auto;
        margin-bottom:20px;
        }
    table{
        table-layout: fixed;
        width:100%
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
    .footer {
        text-align:center;
        }
    ::placeholder{
        opacity:0.4;
        }
    .current-location{
        width:97%;
        }
    .asking{
        width:97%;
        }
    .errorMessage{
        color:red;
        }
    .button, input, select, textarea{
        font-family: inherit;
        }
@endsection

@section('content')
    <h1>Driver Edit</h1>
    @if(count($errors)>0)
    <p>入力に問題があります。再入力してください。</p>
    @endif
    <div class='driver-post'>
        <form action='/driver/posts/{{$form->id}}' method='post' enctype='multipart/form-data'>
            @csrf
            @method('put')
            <table>
                <tr><th>送迎開始日時：</th></tr>
                <tr><td><input class='start-datetime' type='datetime-local'name='start_datetime' value={{old('start_datetime',str_replace(' ', 'T', $form->start_datetime))}}></td></tr>
                @if($errors->has('start_datetime'))
                <tr><td class='errorMessage'>Error: {{$errors->first('start_datetime')}}</td></tr>
                @endif
                
                <tr><th>送迎終了日時：</th></tr>
                <tr><td><input class='end-datetime' type='datetime-local'name='end_datetime' value={{old('end_datetime',str_replace(' ', 'T', $form->end_datetime))}}></td></tr>
                @if($errors->has('end_datetime'))
                <tr><td class='errorMessage'>Error: {{$errors->first('end_datetime')}}</td></tr>
                @endif
                
                <tr><th>現在地：</th></tr>
                <tr><td><input class='current-location' type='text' name='current_location' placeholder='兵庫県神戸市中央区布引町4丁目' value={{old('current_location',$form->current_location)}}></td></tr>
                @if($errors->has('current_location'))
                <tr><td class='errorMessage'>Error: {{$errors->first('current_location')}}</td></tr>
                @endif
                
                <tr><th>送迎の代わりにしてほしいこと：</th></tr>
                <tr><td><textarea class='asking' name='asking' placeholder='おすすめのカフェ教えてください！'>{{old('asking',$form->asking)}}</textarea></td></tr>
                @if($errors->has('request'))
                <tr><td class='errorMessage'>Error: {{$errors->first('request')}}</td></tr>
                @endif
                
                <tr><th>車種：</th></tr>
                <tr><td><input class='car-model' type='text' name='car_model' placeholder='ソリオ' value={{old('car_model',$form->car_model)}}></td></tr>
                @if($errors->has('car_model'))
                <tr><td class='errorMessage'>Error: {{$errors->first('car_model')}}</td></tr>
                @endif
                
                <tr><th>相乗り可能人数：</th></tr>
                <tr><td><input class='max-passengers' type='number' name='max_passengers' min='1' max='10' placeholder='1' value={{old('max_passengers',$form->max_passengers)}}>　人まで</td></tr>
                @if($errors->has('max_passengers'))
                <tr><td class='errorMessage'>Error: {{$errors->first('max_passengers')}}</td></tr>
                @endif
                
                <tr><th>車の画像：</th></tr>
                <tr>
                    <td>
                        <div style='text-align: center'>
                            @php
                            $image_filename = $form->car_image;
                            @endphp
                            <p>現画像ファイル：{{$image_filename}}</p>
                            <image src="{{ asset('img/cars/'.$image_filename,true) }}">
                        </div>
                        <input class='car-image' type='file' name='car_image' accept='image/png, image/jpeg'>
                    </td>
                </tr>
                @if($errors->has('car_image'))
                <tr><td class='errorMessage'>Error: {{$errors->first('car_image')}}</td></tr>
                @endif
            </table>
            <p class='submitBtn'><input type='submit' value='更新'></p>
        </form>
    </div>
    <div class='footer'>
        <p>[<a href='/driver/posts/{{$form->id}}'>back</a>]</p>  
    </div>
@endsection