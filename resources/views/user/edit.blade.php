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
        padding-bottom:14.4px;
    }
    .back-link {
        text-align:center;
    }
    ::placeholder {
        opacity:0.4;
    }
    .self-introduction {
        height:80px;
        width:97%;
    }
    .error-message {
        color:red;
    }
    .button, input, select, textarea {
        font-family: inherit;
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
        .user {
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
            padding-bottom:14.4px;
        }
        .back-link {
            text-align:center;
        }
        ::placeholder {
            opacity:0.4;
        }
        .self-introduction {
            height:80px;
            width:97%;
        }
        .error-message {
            color:red;
        }
        .button, input, select, textarea {
            font-family: inherit;
        }   
    }
@endsection

@section('content')
    <h1>?????????????????????</h1>
    @if(count($errors)>0)
    <p>???????????????????????????????????????????????????????????????</p>
    @endif
    <div class='user'>
        <form action='/users/{{$form->id}}' method='post' enctype='multipart/form-data'>
            @csrf
            @method('put')
            <table>
                <tr><th>?????????</th></tr>
                <tr><td><input class='name' type='text' name='name' placeholder='???????????????' value="{{old('name',$form->name)}}"></td></tr>
                @if($errors->has('name'))
                <tr><td class='error-message'>Error: {{$errors->first('name')}}</td></tr>
                @endif
                
                <tr><th>?????????</th></tr>
                <tr>
                    <td>
                        <select name='gender'>
                            <option value=''>????????????????????????</option>
                            <option value=1 @if(old('gender',$form->gender)==1) selected  @endif>??????</option>
                            <option value=2 @if(old('gender',$form->gender)==2) selected  @endif>??????</option>
                        </select>
                    </td>
                </tr>
                @if($errors->has('gender'))
                <tr><td class='error-message'>Error: {{$errors->first('gender')}}</td></tr>
                @endif
                
                <tr><th>???????????????????????????</th></tr>
                <tr>
                    <td>
                        <div style='text-align: center'>
                            @php
                            $image_filename = $form->user_image;
                            @endphp
                            <p>????????????????????????{{$image_filename}}</p>
                            <image src="{{ Storage::disk('s3')->url("img/users/".$image_filename) }}" alt="">
                        </div>
                        <input class='user-image' type='file' name='user_image' accept='image/png, image/jpeg'>
                    </td>
                </tr>
                @if($errors->has('user_image'))
                <tr><td class='error-message'>Error: {{$errors->first('user_image')}}</td></tr>
                @endif
                
                <tr><th>?????????</th></tr>
                <tr><td><input class='age' type='number' name='age' min='18' max='100' placeholder='18' value={{old('age',$form->age)}}>??????</td></tr>
                @if($errors->has('age'))
                <tr><td class='error-message'>Error: {{$errors->first('age')}}</td></tr>
                @endif
                
                <tr><th>????????????????????????</th></tr>
                <tr><td><input class='email' type='text' name='email' value={{old('email',$form->email)}}></td></tr>
                @if($errors->has('email'))
                <tr><td class='error-message'>Error: {{$errors->first('email')}}</td></tr>
                @endif
                
                <tr><th>??????????????????</th></tr>
                <tr><td><textarea class='self-introduction' name='self_introduction' placeholder=''>{{old('self_introduction',$form->self_introduction)}}</textarea></td></tr>
                @if($errors->has('self_introduction'))
                <tr><td class='error-message'>Error: {{$errors->first('self_introduction')}}</td></tr>
                @endif
            </table>
            <p class='submit-btn'><input type='submit' value='??????'></p>
        </form>
    </div>
    <div class='back-link'>
        <p>[<a href='/users/{{$form->id}}'>??????</a>]</p>  
    </div>
@endsection