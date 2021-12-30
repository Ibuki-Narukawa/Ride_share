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
            center: {lat: +lat, lng: +lng},
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
        alert('現在地から位置の取得ができませんでした。理由: ' + status + '.\nデフォルトマップを表示します。もう一度現在地を入力してください。');
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