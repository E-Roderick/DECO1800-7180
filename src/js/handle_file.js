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
const SCALAR = 10;
const INC = 3; // the number of route coordinate points the user goes through on each move
const POSITIVE = 1;
const NEGATIVE = -1;

const FORWARD_KEY = "ArrowUp";
const FORWARD_KEY_ALT = "KeyW";
const BACKWARD_KEY = "ArrowDown";
const BACKWARD_KEY_ALT = "KeyS";
const DIR_CHANGE_KEY = "KeyR"

const ICON_WIDTH = 56;
const ICON_HEIGHT = 75;

var eventData; // the event records
var updatedEvents; // the updated event records

var playerIcon = L.icon({
    iconUrl: "/DECO1800-7180/public/assets/avatar/player.svg",

    iconSize: [ICON_WIDTH, ICON_HEIGHT], // size of the icon
    iconAnchor: [ICON_WIDTH/2, ICON_HEIGHT/2], // point of the icon which will correspond to marker's location
    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var index = 0;          // the index of route points which the user is currently at
let nextIndex;          // The next position to move to 
let angle = 0;          // The angle of the user's marker
var userMarker;         // marker of the user
var routeCoordinates;   // coordinates of the route points
var maxIndex;           // the max index of route points
var circle;             // circle round the user marker

const getPoint = index => routeCoordinates[index];

const angleToPoint = (c1, c2) => 
    rotToMarkerAngle(angleBetweenCoordinates(c1, c2));

/**
 * Handles the main logic of the map interactibles setup, once all data is
 * loaded in on the user's end.
 * @param {*} buslineData The raw busline data to be parsed and drawn
 */
const loadedAllData = (buslineData) => {
    routeCoordinates = JSON.parse(buslineData);

    // Set the initial position
    // TODO Need to update this so it works with bot types of route
    maxIndex = routeCoordinates.length - 1;
    index = maxIndex;
    nextIndex = maxIndex - INC;

    console.log(maxIndex);
    
    // Player
    userMarker = L.marker([routeCoordinates[index][0], routeCoordinates[index][1]], { icon: playerIcon }).addTo(map);
    angle = angleToPoint(getPoint(index), getPoint(nextIndex));
    userMarker.setRotationAngle(angle);
    
    // Radius
    circle = L.circle([routeCoordinates[index][0], routeCoordinates[index][1]], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);

    // Route
    L.polyline(routeCoordinates, { color: 'purple' }).addTo(map);
    if (eventData != "null" && updatedEvents != "null") {
        console.log("Source: localStorage");
        iterateEventRecords(eventData, routeCoordinates[index][0], routeCoordinates[index][1]);
        iterateUpdatedEvents(updatedEvents, routeCoordinates[index][0], routeCoordinates[index][1]);
    }
}

const getNewIndex = (index, max, inc, direction) => {
    if (direction === POSITIVE) {
        return index - inc > max ? 0 : index - inc;
    } else if (direction === NEGATIVE) {
        return index + inc < 0 ? max : index + inc;
    }
}

function registerKeyPress() {
    // Add event listener on keydown of 'A' and 'D'
    document.addEventListener('keydown', (event) => {
        var code = event.code;

        // Cannot use next index as new current as user may change direction
        switch (code) {
            case FORWARD_KEY:
            case FORWARD_KEY_ALT:
                event.preventDefault();
                handleMove(car_orientation);
                break;

            case BACKWARD_KEY:
            case BACKWARD_KEY_ALT:
                event.preventDefault();
                handleMove(getOppositeDirection(car_orientation));
                break;

            case DIR_CHANGE_KEY:
                handleTurn();
                break;
            
            default:
                return;
        }

    }, false);
}

function setMarkerAngleFromPoints(p1, p2) {
    // Check for route wrapping
    let angle = (Math.abs(index - nextIndex) > INC) ? 
    angle : angleToPoint(getPoint(p1), getPoint(p2));
    
    // Update angle
    userMarker.setRotationAngle(angle);
}

function handleMove(move_dir) {
    // The forward direction corresponds to negative increment
    index = getNewIndex(index, maxIndex, INC, move_dir);
    nextIndex = getNewIndex(index, maxIndex, INC, move_dir);

    /**
     * Get the point indexes. This should be dependent on the move direction and
     * the car orientation. Each of the conditions is separate.
     */
    // Check move direction to possibly reverse direction
    let points = move_dir === FORWARD_DIR ? 
        [index, nextIndex] : [nextIndex, index];
    // Check car orientation to possibly reverse direction again
    points = car_orientation === FORWARD_DIR ?
        points : points.reverse();
    
    // remove all the pervious event markers, the user marker and the circle
    nearbyMarkers.forEach((marker) => {
        map.removeLayer(marker);
    })
    nearbyMarkers = [];
    map.removeLayer(userMarker);
    map.removeLayer(circle);

    // redraw all the markers.
    userMarker = L.marker([routeCoordinates[index][0], routeCoordinates[index][1]], { icon: playerIcon }).addTo(map);
    setMarkerAngleFromPoints(points[0], points[1])

    circle = L.circle([routeCoordinates[index][0], routeCoordinates[index][1]], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
    iterateEventRecords(eventData, routeCoordinates[index][0], routeCoordinates[index][1]);
    iterateUpdatedEvents(updatedEvents, routeCoordinates[index][0], routeCoordinates[index][1]);
}

function handleTurn() {
    changeDirection();
    // Swap indexes and update the angle
    nextIndex = getNewIndex(index, maxIndex, INC, car_orientation);
    setMarkerAngleFromPoints(index, nextIndex);
}

function changeDirection() {
    car_orientation = getOppositeDirection(car_orientation);
}

function getOppositeDirection(direction) {
    return direction == FORWARD_DIR? BACKWARD_DIR : FORWARD_DIR;
}

function getServerRouteData(route) {
    $.ajax({
        url: `../util/getRouteData.php?route=${route}`,
        type: "GET",
        contentType: "html",
        success: data => {
            //console.log(data);
            process_bus_data(data);
        }
    });
}

function process_bus_data(busline) {
    registerKeyPress(); // Enable interaction with map
    loadedAllData(busline); // Draw map related data
    handleMapLoad(); // Take actions once the map is loaded
}