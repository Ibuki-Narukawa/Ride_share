var lat;
var lng;
var map;
var mapObj;
var marker;
var opt;
const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById('infowindow-content');
infowindow.setContent(infowindowContent);

var LatLng;

var initMap = function(){
    if(isset(latitude) && isset(longitude) && isset(address)){
        console.log(latitude);
        console.log(longitude);
        console.log(address);
        lat = latitude;
        lng = longitude;
        LatLng = {lat, lng};
        opt = {
            zoom: 15,
            center: LatLng,
            mapTypeId: 'roadmap'
        };
        map = document.getElementById('map');
        mapObj = new google.maps.Map(map, opt);
        marker = new google.maps.Marker({
            map: mapObj,
            anchorPoint: new google.maps.Point(0, -29),
        });
        marker.setPosition(LatLng);
        marker.setVisible(true);
        infowindowContent.children['place-address'].textContent = address;
        infowindow.open(mapObj, marker);
    }
    else{
        LatLng = {lat: 34.694659, lng: 135.194954};
        opt = {
            zoom: 10,
            center: LatLng,
            mapTypeId: 'roadmap'
        };
    	map = document.getElementById('map');
    	mapObj = new google.maps.Map(map,opt);
    	marker = new google.maps.Marker({
            map: mapObj,
            anchorPoint: new google.maps.Point(0, -29),
        });
    }
};

var options = {
    fields: ['formatted_address', 'geometry', 'name'],
    strictBounds: false,
    componentRestrictions: {country: 'jp'},
    types: [],
}

var input = document.getElementById('address');
var autocomplete = new google.maps.places.Autocomplete(input, options);

autocomplete.addListener('place_changed', () => {
    infowindow.close();
    marker.setVisible(false);
    
    const place = autocomplete.getPlace();
    
    if (!place.geometry || !place.geometry.location) {
        window.alert("No details available for input: '" + place.name + "'");
        event.preventDefault();   
    }
    
    lat = place.geometry.location.lat();
    lng = place.geometry.location.lng();
    
    mapObj.setCenter(place.geometry.location);
    mapObj.setZoom(15);
    
    marker = new google.maps.Marker({
        map: mapObj,
        anchorPoint: new google.maps.Point(0, -29),
    });
    
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children['place-name'].textContent = place.name;
    infowindowContent.children['place-address'].textContent = place.formatted_address;
    infowindow.open(mapObj, marker);
    
});

var submitPost = function(e){
	document.getElementById('lat').value = lat;
	document.getElementById('lng').value = lng;
	                                              
	//event.preventDefault();                                             
    document.getElementById('form_create').submit();
};

var isset = function(data){
    if(data === '' || data === null || data === undefined){
        return false;
    }else{
        return true;
    }
};

window.onload = function(){
    initMap();
}