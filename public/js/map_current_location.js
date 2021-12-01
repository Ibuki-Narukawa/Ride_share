let myLatLng = {lat: 34.694659, lng: 135.194954};
var opt = {
    zoom: 13,
    center: myLatLng,
    mapTypeId: "roadmap"
};

var map = document.getElementById("map");
var mapObj = new google.maps.Map(map,opt);

var options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    types: [],
}

var input = document.getElementById("pac-input");
var autocomplete = new google.maps.places.Autocomplete(input, options);

const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById("infowindow-content");

infowindow.setContent(infowindowContent);

const marker = new google.maps.Marker({
    map: mapObj,
    anchorPoint: new google.maps.Point(0, -29),
});

autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);
    
    const place = autocomplete.getPlace();
    
    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    mapObj.setCenter(place.geometry.location);
    mapObj.setZoom(15);
    
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(mapObj, marker);
});
