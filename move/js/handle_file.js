const TARGET = "P2060002";
// Data is id, lat, long, sequence
const LAT_OFF = 27;
const LON_OFF = -152;
const SCALAR = 10;
const INC = 3;

var map = L.map("map").setView([-27, 152], 8);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 18,
    attribution: '© OpenStreetMap'
}).addTo(map);

var eventData = JSON.parse(localStorage.getItem("eventData"));

var greenIcon = L.icon({
    iconUrl: 'leaf-green.png',
    shadowUrl: 'leaf-shadow.png',

    iconSize: [38, 95], // size of the icon
    shadowSize: [50, 64], // size of the shadow
    iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

const uploadInput = document.getElementById("fileinput");
var index = 0;
var marker;
var data;
var maxIndex;
var circle;

const dataLoad = (rawData) => {
    data = rawData.split("\r\n")
        .map(line => line.split(','))
        .filter(line => line.includes(TARGET))
        .map(vals => [Number(vals[1]), Number(vals[2])]);

    console.log(data);
    console.log(data[index][0]);
    maxIndex = data.length;
    index = maxIndex - 1;
    console.log(maxIndex);
    marker = L.marker([data[index][0], data[index][1]], { icon: greenIcon }).addTo(map);
    circle = L.circle([data[index][0], data[index][1]], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);

    L.polyline(data, { color: 'red' }).addTo(map);
    if (eventData) {
        console.log("Source: localStorage");
        iterateRecords1(eventData, data[index][0], data[index][1]);
    }
}

$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "data\\shapes.txt",
        dataType: "text",
        success: function(data) {
            dataLoad(data);
        }
    });
});

// Add event listener on keydown
document.addEventListener('keydown', (event) => {
    var name = event.key;
    var code = event.code;
    // Alert the key name and key code on keydown
    //alert(`Key pressed ${name} \r\n Key code value: ${code}`);
    if (code == "KeyA") {
        index += INC;
        if (index >= maxIndex) {
            index = 0;
        }
    } else if (code == "KeyD") {
        index -= INC;
        if (index < 0) {
            index = maxIndex - 1;
        }
    } else {
        return;
    }

    nearbyMarkers.forEach((eventMarker) => {
        map.removeLayer(eventMarker);
    })
    nearbyMarkers = [];
    map.removeLayer(marker);
    map.removeLayer(circle);

    console.log(index);
    marker = L.marker([data[index][0], data[index][1]], { icon: greenIcon }).addTo(map);
    circle = L.circle([data[index][0], data[index][1]], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
    iterateRecords1(eventData, data[index][0], data[index][1]);


}, false);