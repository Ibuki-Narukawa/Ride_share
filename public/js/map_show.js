var geocoder = new google.maps.Geocoder();  
var address = document.getElementById("address").textContent;
var map = document.getElementById("map");

const infowindow = new google.maps.InfoWindow();
const infowindowContent = document.getElementById("infowindow-content");

infowindow.setContent(infowindowContent);

var mapObj;
var marker;
var opt;

if (address){
    geocoder.geocode({ address: address }, function(results, status){
        if (status === 'OK'){  //status を確認して処理開始
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
            marker.setPosition(results[0].geometry.location);
            marker.setVisible(true);
            infowindowContent.children["place-name"].textContent = results[0].name;
            infowindowContent.children["place-address"].textContent = results[0].formatted_address;
            infowindow.open(mapObj, marker);
        }else{
            alert('現在地から位置の取得ができませんでした。理由: ' + status + '.\nデフォルトマップを表示します。もう一度現在地を入力してください。');
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

