function initMap(lt, lg) {
    var pos = {lat: lt, lng: lg};
    var opt = {
        center: pos,
        zoom: 15,
    };

    var myMap = new google.maps.Map(document.getElementById('map_listing'), opt);

    var marker = new google.maps.Marker({
        position: pos,
        map: myMap,
        title: "gogogo",
    });

    var info = new google.maps.InfoWindow({
        content: '<h1>Good</h1>'
    });

    marker.addListener("click", function() {
        info.open(myMap, marker);
    });
}
