var map;
var mapObj;
var marker;
var opt;
var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();
var options = {
    fields: ['formatted_address', 'geometry', 'name'],
    strictBounds: false,
    componentRestrictions: {country: 'jp'},
    types: [],
}

var initMap = function(){
    LatLng = {lat: 35.39291572, lng: 139.44288869};
    opt = {
        zoom: 4,
        center: LatLng,
        mapTypeId: 'roadmap'
    };
	map = document.getElementById('map');
	mapObj = new google.maps.Map(map,opt);
	marker = new google.maps.Marker({
        map: mapObj,
        anchorPoint: new google.maps.Point(0, -29),
    });
};

function calcRoute(){
    directionsRenderer.setMap(mapObj); 
    
    var request = {
        origin: {lat: +latFrom, lng: +lngFrom},     
        destination: {lat: +latTo, lng: +lngTo},   
        travelMode: 'DRIVING' 
      };
    
    directionsService.route(request, function(result, status) {
        if (status === 'OK') {
            directionsRenderer.setDirections(result);
            var html = new Array();
            html.push('<div class="alert-info"> From: ' + origin + '.<br>' );
            html.push('To: ' + destination + '.<br>');
            html.push('Driving distance: ' + result.routes[0].legs[0].distance.text + '.<br>');
            html.push('Duration: ' + result.routes[0].legs[0].duration.text + '.</div>');
            
            const output = document.querySelector('#output');
            output.innerHTML = html.join('');
        }
        else{
            alert('取得できませんでした：' + status);
        }
    });
}

window.onload = function(){
    initMap();
    calcRoute();
}
