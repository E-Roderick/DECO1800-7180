const TARGET = "P2060002";
// Data is id, lat, long, sequence
const LAT_OFF = 27;
const LON_OFF = -152;
const SCALAR = 10;
const INC = 3; // the number of route coordinate points the user goes through on each move

// var map = L.map("map").setView([-27, 152], 8);
// L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
//     maxZoom: 18,
//     attribution: '© OpenStreetMap'
// }).addTo(map);

var eventData = JSON.parse(localStorage.getItem("eventData")); // the event records

var greenIcon = L.icon({
    iconUrl: "/DECO1800-7180/public/assets/avatar/avatar.png",
    shadowUrl: "/DECO1800-7180/public/assets/avatar/avatar-shadow.png",

    iconSize: [38, 95], // size of the icon
    shadowSize: [50, 64], // size of the shadow
    iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

const uploadInput = document.getElementById("fileinput");
var index = 0; // the index of route points which the user is currently at
var userMarker; // marker of the user
var routeCoordinates; // coordinates of the route points
var maxIndex; // the max index of route points
var circle; // circle round the user marker

const dataLoad = (rawData) => {

    routeCoordinates = rawData.split("\n")
        .map(line => line.split(','))
        .filter(line => line.includes(TARGET))
        .map(vals => [Number(vals[1]), Number(vals[2])]);

    console.log(routeCoordinates);
    console.log(routeCoordinates[index][0]);
    maxIndex = routeCoordinates.length - 1;
    index = maxIndex;
    console.log(maxIndex);
    userMarker = L.marker([routeCoordinates[index][0], routeCoordinates[index][1]], { icon: greenIcon }).addTo(map);
    circle = L.circle([routeCoordinates[index][0], routeCoordinates[index][1]], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);

    L.polyline(routeCoordinates, { color: 'red' }).addTo(map);
    if (eventData) {
        console.log("Source: localStorage");
        iterateEventRecords(eventData, routeCoordinates[index][0], routeCoordinates[index][1]);
    }
}

$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "/DECO1800-7180/data/shapes.txt",
        dataType: "text",
        success: function(data) {
            dataLoad(data);
        }
    });
});


// Add event listener on keydown of 'A' and 'D'
document.addEventListener('keydown', (event) => {
    var code = event.code;

    if (code == "KeyA") {
        index += INC;
        if (index > maxIndex) {
            index = 0;
        }
    } else if (code == "KeyD") {
        index -= INC;
        if (index < 0) {
            index = maxIndex;
        }
    } else {
        return;
    }

    // remove all the pervious event markers, the user marker and the circle
    nearbyMarkers.forEach((marker) => {
        map.removeLayer(marker);
    })
    nearbyMarkers = [];
    map.removeLayer(userMarker);
    map.removeLayer(circle);

    // redraw all the markers.
    userMarker = L.marker([routeCoordinates[index][0], routeCoordinates[index][1]], { icon: greenIcon }).addTo(map);
    circle = L.circle([routeCoordinates[index][0], routeCoordinates[index][1]], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
    iterateEventRecords(eventData, routeCoordinates[index][0], routeCoordinates[index][1]);
}, false);