const TARGET = "P2060002";

const ROUTES = {
    /* Route: [route_ids]*/
    "61": ["610003", "610142"],
    "66": ["660001", "660047"],
    "111": ["1110001", "1110086"],
    "222": ["2220001", "2220058"],
    "444": ["4440002", "4440004"],
    "P206": ["P2060002", "P2060003"],
}

// Data is id, lat, long, sequence
const LAT_OFF = 27;
const LON_OFF = -152;
const SCALAR = 10;
const INC = 3; // the number of route coordinate points the user goes through on each move

var eventData; // the event records

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

/**
 * Handles the main logic of the map interactibles setup, once all data is
 * loaded in on the user's end.
 * @param {*} buslineData The raw busline data to be parsed and drawn
 */
const loadedAllData = (buslineData) => {

    console.log(buslineData);
    routeCoordinates = JSON.parse(buslineData);

    // routeCoordinates = buslineData.split("\n")
    //     .map(line => line.split(','))
    //     .filter(line => line.includes(TARGET))
    //     .map(vals => [Number(vals[1]), Number(vals[2])]);

    // console.log(routeCoordinates);
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

function registerKeyPress() {
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
}

function getRouteData(route) {
    $.ajax({
        url: `../util/getRouteData.php?route=${route}`,
        type: "GET",
        contentType: "html",    
        success: data => {
            console.log(data);
            process_bus_data(data);
        }
    });
}