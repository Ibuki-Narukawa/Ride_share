var lat;
var lng;
var map;
var mapObj;
var originMarker;
var marker;
var markers = new Array();
var opt;
const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById('infowindow-content');
infowindow.setContent(infowindowContent);
var LatLng;
var origins = new Array();
var distanceMatrixService = new google.maps.DistanceMatrixService();
var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();
var bounds = new google.maps.LatLngBounds();
var sortResults = new Array();
var destinations = new Array();
var postId = new Array();
var sortResults = new Array();
var all_destinations = new Array();

origins = [
    new google.maps.LatLng(latFrom, lngFrom),
];

var initMap = function(){
	var opt = {
	    zoom: 13,
	    center: origins[0],
	    mapTypeId: 'roadmap'
	};
	map = document.getElementById('map');
	mapObj = new google.maps.Map(map,opt);
	originMarker = new google.maps.Marker({
		map: mapObj,
		position: origins[0],
		animation: google.maps.Animation.DROP,
	});
	google.maps.event.addListener(originMarker, 'click', function() {
		// 吹き出しを表示
		infowindowContent.children['place-name'].textContent = origin;
		infowindowContent.children['place-address'].textContent = origins[0];
		infowindow.open(mapObj, this);
	});
};

// マーカーを作成
var createPlacesMarker = function(name,latlng) {
	var marker = new google.maps.Marker({
		map: mapObj,
		position: latlng,
		animation: google.maps.Animation.DROP,
		title: name,
		icon: {
			url: 'https://ride-share-bucket.s3.us-east-2.amazonaws.com/img/map/driver.png',
			scaledSize: new google.maps.Size(33,33)
		}
	});
	markers.push(marker);

	// Markerのクリックイベンを定義
	google.maps.event.addListener(marker, 'click', function() {
		// 吹き出しを表示
		infowindowContent.children['place-name'].textContent = name;
		// infowindowContent.children['place-address'].textContent = latlng;
		infowindow.open(mapObj, this);
	});
};

// 全てのマーカーを削除
var clearPlacesMarker = function() {
	for (var i=0; i<_markers.length; i++) {
		markers[i].setMap(null);
	}
	markers = new Array();
};

// DistanceMatrix の実行
var calcDistanceMatrix = function(length, flag, callback, count_times, times, remainder,sortResults, all_destinations, bounds) {
	var destinations = new Array();
	var postId = new Array();
	for (var i=25*(count_times-1); i<25*(count_times-1)+length; i++) {
	    lat = driverPosts[i].latitude;
	    lng = driverPosts[i].longitude;
		LatLng = new google.maps.LatLng(lat, lng);
		destinations.push(LatLng);
		postId.push(driverPosts[i].id);
		all_destinations.push(LatLng);
	}
	
	distanceMatrixService.getDistanceMatrix({
		origins: origins, // 出発地点
		destinations: destinations, // 到着地点
		travelMode: google.maps.TravelMode.DRIVING, // 車モード 
		drivingOptions: { 
			departureTime: new Date(startDatetime), //
			trafficModel: google.maps.TrafficModel.BEST_GUESS // 最適な検索
		}
	}, function(response, status) {
		if (status == google.maps.DistanceMatrixStatus.OK) {

			// 出発地点と到着地点の住所（配列）を取得
			var originsName = response.originAddresses;
			var destinationsName = response.destinationAddresses;
			
			
			// 出発地点でループ
			for (var i=0; i<originsName.length; i++) {
				// 出発地点から到着地点への計算結果を取得
				var results = response.rows[i].elements;
	
				// 到着地点でループ
				for (var j = 0; j<results.length; j++) {
					if(isset(results[j].distance)){
						var from = originsName[i]; // 出発地点の住所
						var to = destinationsName[j]; // 到着地点の住所
						var distance = results[j].distance.value; // 距離
						var duration = results[j].duration.value; // 時間
						
						//距離が20km以内のドライバーを取得
						if(distance<20000){
							sortResults.push([from, to, duration, distance, results[j], 25*(count_times-1)+j, postId[j], markers.length]);
							createPlacesMarker(to,destinations[j]);
							bounds.extend(destinations[j]);
						}
					}
				}
				
				if (flag == 1) {
					if (sortResults.length>0) {
						mapObj.fitBounds(bounds);	
					}
					else{
						window.alert('近くにドライバーはいませんでした。');
					}
				}
		
			}
			
			if (flag == 1) {
				// 到着時間でソート
				sortResults.sort(function(a, b) {
					return b[2] - a[2];
				});
				
				var html = new Array();
				for (var i=0; i<sortResults.length; i++) {
					var data = new Array();
					var placeNo = i;
					var id = sortResults[i][6];
					data.push('<tr data-index="' + placeNo + '" >');
					data.push('<td>' + sortResults[i][1] + '</td>');
					data.push('<td>' + sortResults[i][4].distance.text + '</td>');
					data.push('<td>' + sortResults[i][4].duration.text + '</td>');
					data.push('<td><button onclick=submitForm('+ id + ');>詳細</button></td>');
					data.push('</tr>');
					html.push(data.join(''));
				}
				
				for(var i=0; i<html.length; i++){
					const output = 	document.querySelector('#result-body');
					output.insertAdjacentHTML('afterbegin',html[i]);
					
					// クリック時にルート検索を実行するようイベントを定義
					document.querySelector('#result-body tr').addEventListener('click', function(e) {
						var i = this.dataset.index;
						var x = sortResults[i][5];
						var place = all_destinations[x];
						calcRoute(place);
						google.maps.event.trigger(markers[sortResults[i][7]], 'click');
			
					});
				}	
			}
			callback(count_times, times, remainder, sortResults, all_destinations, bounds);
		}
		else {
			alert('DistanceMatrix 失敗(' + status + ')');
		}
	});
};

//検索情報を送信
var submitForm = function(id){
	event.stopPropagation();;
	var form = document.createElement('form');  
	form.method = 'post';
	form.action = '/search/driverlist/'+ id ;
	
	let token = document.head.querySelector('meta[name="csrf-token"]').content;
	var Token=document.createElement('input');
    Token.setAttribute('type','hidden');
    Token.setAttribute('name','_token');
    Token.setAttribute('value', token);
    form.appendChild(Token);
    
    var StartDateime=document.createElement('input');
    StartDateime.setAttribute('name','start_datetime');
    StartDateime.setAttribute('value', startDatetime);
    form.appendChild(StartDateime);
    
    var From=document.createElement('input');
    From.setAttribute('name','from');
    From.setAttribute('value', origin);
    form.appendChild(From);
    
    var to=document.createElement('input');
    to.setAttribute('name','to');
    to.setAttribute('value', To);
    form.appendChild(to);
    
    var LatFrom=document.createElement('input');
    LatFrom.setAttribute('name','latFrom');
    LatFrom.setAttribute('value', latFrom);
    form.appendChild(LatFrom);
    
    var LngFrom=document.createElement('input');
    LngFrom.setAttribute('name','lngFrom');
    LngFrom.setAttribute('value', lngFrom);
    form.appendChild(LngFrom);
    
    var LatTo=document.createElement('input');
    LatTo.setAttribute('name','latTo');
    LatTo.setAttribute('value', latTo);
    form.appendChild(LatTo);
    
    var LngTo=document.createElement('input');
    LngTo.setAttribute('name','lngTo');
    LngTo.setAttribute('value', lngTo);
    form.appendChild(LngTo);
	
	document.body.appendChild(form);
	form.submit();
};

// ルート検索実行
var calcRoute = function(end) {
	clearRoute();
	var travelMode = 'DRIVING';

	directionsRenderer.setMap(mapObj);
	directionsService.route({
		origin: origins[0],
		destination: end,
		travelMode: travelMode,
		drivingOptions: {
			departureTime:new Date(startDatetime),
			trafficModel: google.maps.TrafficModel.BEST_GUESS,
		}
	}, function(response, status) {
		if (status === google.maps.DirectionsStatus.OK) {
			directionsRenderer.setDirections(response);
		} else {
			alert('Directions 失敗(' + status + ')');
		}
	});	
};

// ルートをクリア
var clearRoute = function() {
	directionsRenderer.setMap(null);
};

var isset = function(data){
    if(data === '' || data === null || data === undefined){
        return false;
    }else{
        return true;
    }
};

//callback関数でcalcDistamceMatrix()を呼び出す。※distanceMatrix APIが一度に25個しか計算できないため
var calcAllDistanceMatrix = function(count_times, times, remainder, sortResults, all_destinations, bounds){
	if (count_times < times){
		var flag = 0;
		count_times++;
		calcDistanceMatrix(25, flag, calcAllDistanceMatrix, count_times, times, remainder, sortResults, all_destinations, bounds);
		return 0;
	}
	else if(count_times === times) {
		flag = 1;
		count_times++;
		calcDistanceMatrix(remainder, flag, calcAllDistanceMatrix, count_times, times, remainder, sortResults, all_destinations, bounds);
	}
	else if(count_times > times) {
		return 0;
	}
}

window.onload = function(){
    initMap();
    
    if(driverPosts.length == 0){
    	window.alert('近くにドライバーはいませんでした。');
    }
 
    var times = Math.floor(driverPosts.length / 25);
    var remainder = driverPosts.length % 25;
    
    if (remainder!=0){
    	calcAllDistanceMatrix(0, times, remainder, sortResults, all_destinations, bounds);
    }
    else {
    	calcAllDistanceMatrix(0, times, 25, sortResults, all_destinations, bounds);	
    }
}