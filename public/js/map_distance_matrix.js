console.log(driverPosts);
let tokyoTower = new google.maps.LatLng(35.658584, 139.7454316);
// 出発点
var origns = [
	tokyoTower,
];
// 到着点
/*var destinations = [
	new google.maps.LatLng(35.8, 140.5),
	new google.maps.LatLng(36.5, 139.3)
];*/
//console.log(destinations);

// ジオコードを実行し、緯度経度を返す
var geocode = function(callback,address,id) {
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		address: address
	}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			callback({'latlng':results[0].geometry.location, 'id':id});
		}
		else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) { 
	        nextAddress--;
            delay++;
		}
		else{
		}
	});
};

var destinations = new Array();
var postId = new Array();

// ジオコーディング結果を配列に挿入する
function results(geoCodeResults){
    destinations.push(geoCodeResults.latlng);
    postId.push(geoCodeResults.id);
}

//最後の要素を受け取り、calcDistanceMatrix()へ渡す。
function lastResults(geoCodeResults){
    destinations.push(geoCodeResults.latlng);
    postId.push(geoCodeResults.id);
    console.log(destinations);
    calcDistanceMatrix();
    //createPlacesMarker('test',geoCodeResults);
}

//console.log(driverPosts[0]['current_location']);
//ドライバー投稿の現在地の情報をdestinations配列に挿入。
for(var i=0; i<driverPosts.length; i++){
	if(i==driverPosts.length-1){
		geocode(lastResults, driverPosts[i].current_location, driverPosts[i].id);	
	}
	else{
		geocode(results, driverPosts[i].current_location, driverPosts[i].id);	
	}
}

var opt = {
    zoom: 13,
    center: tokyoTower,
    mapTypeId: 'roadmap'
};

var map = document.getElementById('map');
var mapObj = new google.maps.Map(map,opt);
var originMarker = new google.maps.Marker({
	map: mapObj,
	position: origns[0],
	animation: google.maps.Animation.DROP,
	title: 'tokyoTower'
});
google.maps.event.addListener(originMarker, 'click', function() {
		// 吹き出しを表示
		infowindowContent.children['place-name'].textContent = '東京タワー';
		infowindowContent.children['place-address'].textContent = tokyoTower;
		infowindow.open(mapObj, this);
	});

var distanceMatrixService = new google.maps.DistanceMatrixService();

var markers = new Array();
const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById('infowindow-content');
infowindow.setContent(infowindowContent);

// マーカーを作成
var createPlacesMarker = function(name,latlng) {
	var marker = new google.maps.Marker({
		map: mapObj,
		position: latlng,
		animation: google.maps.Animation.DROP,
		title: name,
		icon: {
			url: '../../img/map/driver.png',
			scaledSize: new google.maps.Size(33,33)
		}
	});
	markers.push(marker);

	// Markerのクリックイベンを定義
	google.maps.event.addListener(marker, 'click', function() {
		// 吹き出しを表示
		infowindowContent.children['place-name'].textContent = name;
		infowindowContent.children['place-address'].textContent = latlng;
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
var calcDistanceMatrix = function() {
	distanceMatrixService.getDistanceMatrix({
		origins: origns, // 出発地点
		destinations: destinations, // 到着地点
		travelMode: google.maps.TravelMode.DRIVING, // 車モード 
		drivingOptions: { // 車モードの時のみ有効
			departureTime: new Date('2021/12/24 10:00:00'), // 
			trafficModel: google.maps.TrafficModel.BEST_GUESS // 最適な検索
		}
	}, function(response, status) {
		if (status == google.maps.DistanceMatrixStatus.OK) {
			console.log(destinations)
		    var sortResults = new Array();
	
			// 出発地点と到着地点の住所（配列）を取得
			var originsName = response.originAddresses;
			var destinationsName = response.destinationAddresses;
	
			// 出発地点でループ
			for (var i=0; i<originsName.length; i++) {
				// 出発地点から到着地点への計算結果を取得
				var results = response.rows[i].elements;
				var bounds = new google.maps.LatLngBounds();
	
				// 到着地点でループ
				for (var j = 0; j<results.length; j++) {
					var from = originsName[i]; // 出発地点の住所
					var to = destinationsName[j]; // 到着地点の住所
					var duration = results[j].duration.value; // 時間
					var distance = results[j].distance.value; // 距離
					createPlacesMarker(to,destinations[j]);
					bounds.extend(destinations[j]);
					console.log("{},{},{},{}", from,  to, duration, distance, j, postId[j]);
					sortResults.push([from, to, duration, distance, results[j], j, postId[j]]);
				}
				mapObj.fitBounds(bounds);
			}
			
		    // 到着時間でソート
			sortResults.sort(function(a, b) {
				return b[2] - a[2];
			});
			console.log(sortResults);
			
			var html = new Array();
			for (var i=0; i<sortResults.length; i++) {
				var data = new Array();
				var placeNo = sortResults[i][5];
				var id = sortResults[i][6];
				data.push('<tr data-index="' + placeNo + '" >');
				data.push("<td><a href='/search/driverlist/"+ id +"'>" + sortResults[i][1] + '</a></td>');
				data.push('<td>' + sortResults[i][4].distance.text + '</td>');
				data.push('<td>' + sortResults[i][4].duration.text + '</td>');
				data.push('</tr>');
				html.push(data.join(''));
			}
			
			for(var i=0; i<html.length; i++){
				const output = 	document.querySelector('#result-body');
				output.insertAdjacentHTML('afterbegin',html[i]);
				
				// クリック時にルート検索を実行するようイベントを定義
				document.querySelector('#result-body tr').addEventListener('click', function(e) {
					var x = this.dataset.index;
					//console.log(x);
					var place = destinations[x];
					//console.log(place);
					calcRoute(place);
					google.maps.event.trigger(markers[i], 'click');
		
				});
			}
			
		}
		else {
			alert('DistanceMatrix 失敗(' + status + ')');
		}
	});
};

var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();

// ルート検索実行
var calcRoute = function(end) {
	clearRoute();
	var travelMode = 'DRIVING';
	//var trafficModel = $("#trafficModel").val();
	//var departureTime = $("#departureTime").val();

	directionsRenderer.setMap(mapObj);
	directionsService.route({
		origin: origns[0],
		destination: end,
		travelMode: travelMode,
		/*drivingOptions: {
			departureTime: new Date(departureTime),
			trafficModel: getTrafficModel(trafficModel),
		}*/
	}, function(response, status) {
		console.log(response);
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

// ルートと検索結果をクリア
var clearAll = function() {
	clearRoute();
	document.querySelector('#result-body').innerHTML='';
};

