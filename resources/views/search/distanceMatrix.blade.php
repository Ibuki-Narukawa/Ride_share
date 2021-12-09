@extends('layouts.app')
@section('style')
    body {
        front-size:16px;
        color:#999;
        text-align:center;
    }
    h1 {
        font-size:50px;
        color:#00BFFF;
        margin:20px;
    }
    #map {
        width: 90vw;
        height: 300px;
        margin:10px auto;
    }
    
    #result-body {
        text-align: center;
        padding: 5px;
    }
    .route-result{
        width:75vw;
        margin:0 auto;
        margin-bottom:30px;
        overflow:auto;
    }
    table {
        table-layout: auto;
        width:80vw;
        margin:0 auto;
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
    #route-result {
        height:230px;
        overflow-y:scroll;
    }
    thead {
        position: sticky;
        top: 0px;  
    }
    #result-body tr:hover { 
        background-color: #ddd; cursor: pointer; overflow-y:auto;
    }
@endsection

@section('content')
    <h1>Distace Matrix</h1>
    <div id='map'></div>
    <div id='infowindow-content'>
        <span id='place-name' class='title'></span><br />
        <span id='place-address'></span>
    </div>
    <div id='route-result'>
	    <table class='table'>
			<thead>
				<tr>
					<th>現在地</th>
					<th>距離</th>
					<th>時間</th>
				</tr>
			</thead>
			<tbody id='result-body'></tbody>
		</table>
	</div> 
    
    <script>
        window.driverPosts = new Array();
        window.driverPosts = @json($posts);
    </script>
    
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&libraries=places&v=weekly"
        async
    ></script>
    
    <script src="{{ asset('js/map_distance_matrix.js') }}"></script>
@endsection