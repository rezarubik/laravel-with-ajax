function initMap() {
    var amount = document.querySelectorAll('#mapDetails').length;
    var resAddress = [];
    var resLat = [];
    var resLng = [];
    var aaa = []
    for (var i=0; i<amount; i++){
        var details = document.getElementsByClassName("mapDetails")[i].innerHTML
        var obj = JSON.parse(details);
        resAddress.push(obj.address)
        resLat.push(obj.lat)
        resLng.push(obj.lng)
        aaa.push([resAddress[i], resLat[i], resLng[i]])
    }
    var locations = aaa;
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: new google.maps.LatLng(-2.548926, 118.0148634),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map,
            icon: 'http://maps.gstatic.com/mapfiles/markers2/marker.png',
        });
        google.maps.event.addListener(
            marker,
            "click",
            (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                };
            })(marker, i)
        );
    }
}

window.initMap = initMap;
