// Display a map with markers and return a map

export function map_index(markers) {

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

    markers.map(function (item) {



        if ('picture' in item ) {

            L.circleMarker(item.latlng).addTo(map).bindPopup('<a href="/mares/' + item.mare_id + '"><img src="/storage/' + item.picture + '"/></a>');
        }
        else {
            L.circleMarker(item.latlng).addTo(map).bindPopup('<a href="/mares/' + item.mare_id + '">'+ item.mare_id + '</a>');
        }

    });
    return map;

}
