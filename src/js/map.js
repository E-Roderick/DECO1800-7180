/******************************************************************************
 *  Functions relating the the explore page map.                              *
 ******************************************************************************/

/* Constants */
const INC = 3; // Route coordinates skipped per move
const POSITIVE = 1;
const NEGATIVE = -1;

const FORWARD_DIR = 1;
const BACKWARD_DIR = -1;

const FORWARD_KEY = "ArrowUp";
const FORWARD_KEY_ALT = "KeyW";
const BACKWARD_KEY = "ArrowDown";
const BACKWARD_KEY_ALT = "KeyS";
const DIR_CHANGE_KEY = "KeyR"

/* Globals */
let map;                // Map holder

// Car
let userMarker;         // Marker of the user
let circle;             // circle round the user marker

let car_orientation     // Car move direction
    = FORWARD_DIR;
let angle = 0;          // The angle of the user's marker

let index = 0;          // Index of route points which the user is currently at
let nextIndex;          // The next position to move to 
let routeCoordinates;   // Store all coordinate pairs for the route
let maxIndex;           // The max index of route points

/* Functions */
/**
 * Get the lat/lon of a route position for a given index.
 * @param {int} index The index to find the route positions for
 * @returns A point (two floats) for the route coordinate
 */
const getPoint = index => routeCoordinates[index];

/**
 * Convert a mathematical angle to a map-based angle. 0 will be North, with
 * clockwise rotation increasing the angle.
 * @param {float} angle The mathematical angle to convert.
 * @returns The map based angle.
 */
const rotToMarkerAngle = angle => (1 * angle - 90) % 360;

/**
 * Finds the map-based angle between two points (coordiantes). 
 * @param {point} c1 The reference point
 * @param {point} c2 The point to find the angle to
 * @returns The angle in between
 */
const angleToPoint = (c1, c2) => 
    rotToMarkerAngle(angleBetweenCoordinates(c1, c2));

/**
 * Get a new index based on increment and direction, with wrapping. If the new 
 * index is outside of the range of indecies, the new value will wrap to the
 * opposing end.
 * @param {int} index The reference index
 * @param {int} max The greatest possible index
 * @param {int} inc The number of route points to skip to get new index
 * @param {*} direction Which direction along the route the new index should be
 * @returns The new index
 */
const getNewIndex = (index, max, inc, direction) => {
    if (direction === POSITIVE) {
        return index - inc < 0 ? max : index - inc;
    } else if (direction === NEGATIVE) {
        return index + inc > max ? 0 : index + inc;
    }
}

/**
 * Create the leaflet map.
 */
function createMap() {
    map = L.map("map", { keyboard: false })
        .setView([-27.491457, 153.102629], 13);
    
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);
}

/**
 * Handles the tutorial page upon map load.
 */
function handleMapLoad() {
    $("#help-skip-btn").prop("disabled", false); // Enable button
    $("#help-skip-btn").text("Skip Tutorial"); // Update text
}

/**
 * On-click event for the skip button in the tutorial page.
 */
function helpSkipOnClick() {
    $("#map-help").addClass("complete");
}

/**
 * Set the angle of the player's marker based on two points indexes.
 * @param {int} p1 The reference point index (should be player's index)
 * @param {int} p2 The next point index
 */
function setMarkerAngleFromPointsIndexes(p1, p2) {
    // Check for route wrapping
    angle = (Math.abs(index - nextIndex) > INC) ? 
        angle : angleToPoint(getPoint(p1), getPoint(p2));
    
    // Update angle
    userMarker.setRotationAngle(angle);
}

/**
 * Draw's the player's marker and the surrounding circle to the map.
 * @param {*} index The current index of the players position.
 * @param {*} angleIndexes Indexes to calculate the angle for the player marker
 */
function drawUser(index, angleIndexes) {
    userMarker = L.marker([...getPoint(index)], { icon: playerIcon })
        .addTo(map);
    setMarkerAngleFromPointsIndexes(...angleIndexes);

    circle = L.circle([...getPoint(index)], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
}

/**
 * Handle a move occurring for the player.
 * @param {*} move_dir The direction to move in. 
 */
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

    // Put the user on the map
    drawUser(index, points);

    iterateEventRecords(eventsPublicArt, ...getPoint(index));
    iterateUpdatedEvents(eventsBCC, ...getPoint(index));
}

/**
 * Handle re-orienting the player's marker.
 */
function handleTurn() {
    changeDirection();
    // Swap indexes and update the angle
    nextIndex = getNewIndex(index, maxIndex, INC, car_orientation);
    setMarkerAngleFromPointsIndexes(index, nextIndex);
}

/** Change the direction of the car */
function changeDirection() {
    car_orientation = getOppositeDirection(car_orientation);
}

/**
 * Get the direction opposite to that provided.
 * @param {*} direction the target direction
 * @returns The opposite direction
 */
function getOppositeDirection(direction) {
    return direction == FORWARD_DIR? BACKWARD_DIR : FORWARD_DIR;
}

/**
 * Register the event listener for the map interactions.
 */
function registerKeyPress() {
    // Add event listener on keydown of 'A' and 'D'
    document.addEventListener('keydown', (event) => {
        var code = event.code;

        switch (code) {
            case FORWARD_KEY:
            case FORWARD_KEY_ALT:
                event.preventDefault(); // Ensure map does not pan
                handleMove(car_orientation);
                break;

            case BACKWARD_KEY:
            case BACKWARD_KEY_ALT:
                event.preventDefault(); // Ensure map does not pan
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

/**
 * Handles the main logic of the map interactibles setup, once all data is
 * loaded in on the user's end.
 * @param {*} buslineData The raw busline data to be parsed and drawn
 */
const initialiseMap = (buslineData) => {
    routeCoordinates = JSON.parse(buslineData);

    // Set the initial position
    maxIndex = routeCoordinates.length - 1;
    index = maxIndex;
    nextIndex = maxIndex - INC;

    console.log(maxIndex);
    
    // Player
    drawUser(index, [index, nextIndex])

    // Route
    L.polyline(routeCoordinates, { color: 'purple' }).addTo(map);
    if (eventsPublicArt != "null" && eventsBCC != "null") {
        console.log("Source: localStorage");
        iterateEventRecords(eventsPublicArt, ...getPoint(index));
        iterateUpdatedEvents(eventsBCC, ...getPoint(index));
    }
}