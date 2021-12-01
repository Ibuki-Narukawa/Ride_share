let tokyoTower = {lat: 35.6585769, lng: 139.7454506};
var opt = {
    zoom: 13,
    center: tokyoTower,
    mapTypeId: "roadmap"
};

var map = document.getElementById("map");
var mapObj = new google.maps.Map(map,opt);
/*var marker = new google.maps.Marker({
    position: tokyoTower,
    map: mapObj,
    title: 'tokyoTower',
});*/


var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();

directionsRenderer.setMap(mapObj); 

//var start = tokyoTower; 
//var end = new google.maps.LatLng(35.7100069, 139.8108103);  
    
function calcRoute(){
    var request = {
        origin: document.getElementById("from").value,      
        destination: document.getElementById("to").value,   
        travelMode: 'DRIVING' 
      };
    
    directionsService.route(request, function(result, status) {
        if (status === 'OK') {
            directionsRenderer.setDirections(result);
            const output = document.querySelector("#output");
            output.innerHTML = "<div class='alert-info'> From: " + document.getElementById("from").value + ".<br> To: " + document.getElementById("to").value + ".<br> Driving distance: " + result.routes[0].legs[0].distance.text + ".<br>Duration: " + result.routes[0].legs[0].duration.text + ".</div>";
        }
        else{
            alert("取得できませんでした：" + status);
        }
    });
}

var options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    types: [],
}

var inputFrom = document.getElementById("from");
var autocompleteFrom = new google.maps.places.Autocomplete(inputFrom, options);

var inputTo = document.getElementById("to");
var autocompleteTo = new google.maps.places.Autocomplete(inputTo, options);
