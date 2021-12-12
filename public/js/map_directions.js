var latFrom;
var lngFrom;
var latTo;
var lngTo;
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
var inputFrom = document.getElementById('from');
var autocompleteFrom = new google.maps.places.Autocomplete(inputFrom, options);

var inputTo = document.getElementById('to');
var autocompleteTo = new google.maps.places.Autocomplete(inputTo, options);

autocompleteFrom.addListener('place_changed', calcRoute);
autocompleteTo.addListener('place_changed', calcRoute);

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
    
    latFrom = autocompleteFrom.getPlace().geometry.location.lat();
    lngFrom = autocompleteFrom.getPlace().geometry.location.lng();
    latTo = autocompleteTo.getPlace().geometry.location.lat();
    lngTo = autocompleteTo.getPlace().geometry.location.lng();
    
    var request = {
        origin: autocompleteFrom.getPlace().geometry.location,     
        destination: autocompleteTo.getPlace().geometry.location,   
        travelMode: 'DRIVING' 
      };
    
    directionsService.route(request, function(result, status) {
        if (status === 'OK') {
            directionsRenderer.setDirections(result);
            var html = new Array();
            html.push('<div class="alert-info"> From: ' + document.getElementById('from').value + '.<br>' );
            html.push('To: ' + document.getElementById('to').value + '.<br>');
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

function submitPost(e){
	document.getElementById('latFrom').value = latFrom;
	document.getElementById('lngFrom').value = lngFrom;
	document.getElementById('latTo').value = latTo;
	document.getElementById('lngTo').value = lngTo;
	                                              
	//event.preventDefault();                                             
    document.getElementById('form_create').submit();
}

window.onload = function(){
    initMap();
}

