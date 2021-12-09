var geocoder = new google.maps.Geocoder();  
var address = document.getElementById("address").value;
var map = document.getElementById("map");

const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById("infowindow-content");

infowindow.setContent(infowindowContent);

var mapObj;
var marker;
var opt;

if (address){
    geocoder.geocode({ address: address }, function(results, status){
        if (status === "OK"){  //status を確認して処理開始
            opt = {
                zoom: 15,
                center: results[0].geometry.location,
                mapTypeId: "roadmap"
            };
            mapObj = new google.maps.Map(map, opt);
            marker = new google.maps.Marker({
                map: mapObj,
                anchorPoint: new google.maps.Point(0, -29),
            });
            console.log(results[0]);
            marker.setPosition(results[0].geometry.location);
            marker.setVisible(true);
            infowindowContent.children["place-name"].textContent = results[0].name;
            infowindowContent.children["place-address"].textContent = results[0].formatted_address;
            infowindow.open(mapObj, marker);
        }else{
            window.alert("現在地から位置の取得ができませんでした。理由: " + status + ".\nデフォルトマップを表示します。もう一度現在地を入力してください。");
            var myLatLng = {lat: 34.694659, lng: 135.194954};
            opt = {
            zoom: 10,
            center: myLatLng,
            mapTypeId: "roadmap"
            };
            mapObj = new google.maps.Map(map,opt);
            marker = new google.maps.Marker({
                map: mapObj,
                anchorPoint: new google.maps.Point(0, -29),
                animation: google.maps.Animation.DROP,
            });
        }
    }); 
}else{
    var myLatLng = {lat: 34.694659, lng: 135.194954};
    opt = {
    zoom: 10,
    center: myLatLng,
    mapTypeId: "roadmap"
    };
    mapObj = new google.maps.Map(map,opt);
    marker = new google.maps.Marker({
        map: mapObj,
        anchorPoint: new google.maps.Point(0, -29),
    });
}

//document.getElementById("test").innerHTML ="" + document.getElementById('address').value + "<br>" + myLatLng;
mapObj = new google.maps.Map(map,opt);

var options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    componentRestrictions: {country: "jp"},
    types: [],
}

var input = document.getElementById("address");
var autocomplete = new google.maps.places.Autocomplete(input, options);

autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);
    
    const place = autocomplete.getPlace();
    
    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        event.preventDefault();   
    }
    
    mapObj.setCenter(place.geometry.location);
    mapObj.setZoom(15);
    
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent = place.formatted_address;
    infowindow.open(mapObj, marker);
    
});
