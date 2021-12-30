@extends('layouts.app')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('style')
    body {
        front-size:16px;
        color:#999;
        text-align:center;
    }
    h1 {
        font-size:50px;
        color:#00BFFF;
        margin:20px 20px -15px 20px;
    }
    #map {
        width: 90vw;
        height: 50vh;
        margin:25px auto;
    }
    
    #result-body {
        text-align: center;
        padding: 5px;
    }
    #route-result{
        height:30vh;
        width:90vw;
        margin:0 auto;
        overflow:auto;
    }
    table {
        table-layout: auto;
        width:100vw;
        margin:0 auto;
    }
    th {
        border: solid 1px #00BFFF;
        background-color:#00BFFF;
        color:#F0FFFF;
        padding:5px; 
        text-align:center;
    }
    td {
        border:solid 1px #aaa; 
        color:#999; 
        text-align:center;
        padding:10px;
    }
    thead {
        position: sticky;
        top: 0px;  
    }
    #result-body tr:hover { 
        background-color: #ddd; cursor: pointer; overflow-y:auto;
    }
    
    @media screen and (max-width:480px){
        body {
            front-size:16px;
            color:#999;
            text-align:center;
        }
        h1 {
            font-size:30px;
            color:#00BFFF;
            margin:10px 10px 0px 10px;
        }
        #map {
            width: 90vw;
            height: 50vh;
            margin:10px auto;
        }
        #result-body {
            text-align: center;
            padding: 5px;
        }
        #route-result{
            height:30vh;
            width:90vw;
            margin:0 auto;
            overflow:auto;
        }
        table {
            font-size:11px;
            table-layout: auto;
            width:100vw;
            margin:0 auto;
        }
        th {
            border: solid 1px #00BFFF;
            background-color:#00BFFF;
            color:#F0FFFF;
            padding:5px; 
            text-align:center;
        }
        td {
            border:solid 1px #aaa; 
            color:#999; 
            text-align:center;
            padding:10px;
        }
        thead {
            position: sticky;
            top: 0px;  
        }
        #result-body tr:hover { 
            background-color: #ddd; cursor: pointer; overflow-y:auto;
        }
    }
@endsection

@section('content')
    <h1>検索結果</h1>
    <div id='infowindow-content'>
        <span id='place-name' class='title'></span><br />
        <span id='place-address'></span>
    </div>
    <div id='map'></div>
    <div id='route-result'>
	    <table class='table'>
			<thead>
				<tr>
					<th>ドライバーの現在地</th>
					<th>距</th>
					<th>時</th>
					<th> </th>
				</tr>
			</thead>
			<tbody id='result-body'>
			    <form name="csrf-token" value="1234567890" ></form>
			</tbody>
		</table>
	</div> 
    
    <script>
        window.driverPosts = new Array();
        window.driverPosts = @json($posts);
        window.startDatetime = @json($start_datetime);
        window.origin = @json($from);
        window.To = @json($to);
        window.latFrom = @json($latFrom);
        window.lngFrom = @json($lngFrom);
        window.latTo = @json($latTo);
        window.lngTo = @json($lngTo);
    </script>
    
    <script src="{{ asset('js/map_distance_matrix.js') }}"></script>
    
@endsection