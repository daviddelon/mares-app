@props(['markers'])

var markers = {!! json_encode($markers) !!}


var map = L.map('map', {
    center: [43.78, 3.76],
    zoom: 13,
    scrollWheelZoom: false
});

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    scrollWheelZoom: false,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

markers.map(function(item) {

    if (typeof item.image != '') {
        L.marker(item.latlng).addTo(map).bindPopup('<img src="storage/'+item.image+'"/>');
    }

});
