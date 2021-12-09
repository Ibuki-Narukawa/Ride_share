let japan = {lat: 35.39291572, lng: 139.44288869};
var opt = {
    zoom: 4,
    center: japan,
    mapTypeId: "roadmap"
};

var map = document.getElementById("map");
var mapObj = new google.maps.Map(map,opt);

var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();

directionsRenderer.setMap(mapObj); 

var options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    componentRestrictions: {country: "jp"},
    types: [],
}

var inputFrom = document.getElementById("from");
var autocompleteFrom = new google.maps.places.Autocomplete(inputFrom, options);

var inputTo = document.getElementById("to");
var autocompleteTo = new google.maps.places.Autocomplete(inputTo, options);

autocompleteFrom.addListener("place_changed", calcRoute);
autocompleteTo.addListener("place_changed", calcRoute);

function calcRoute(){
    var request = {
        origin: autocompleteFrom.getPlace().geometry.location,     
        destination: autocompleteTo.getPlace().geometry.location,   
        travelMode: "DRIVING" 
      };
    
    directionsService.route(request, function(result, status) {
        if (status === "OK") {
            directionsRenderer.setDirections(result);
            var html = new Array();
            html.push("<div class='alert-info'> From: " + document.getElementById("from").value + ".<br>" );
            html.push("To: " + document.getElementById("to").value + ".<br>");
            html.push("Driving distance: " + result.routes[0].legs[0].distance.text + ".<br>");
            html.push("Duration: " + result.routes[0].legs[0].duration.text + ".</div>");
            
            const output = document.querySelector("#output");
            output.innerHTML = html.join('');
        }
        else{
            alert("取得できませんでした：" + status);
        }
    });
}