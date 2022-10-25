/******************************************************************************
 *  Functions relating the the explore page map.                              *
 ******************************************************************************/

/* Constants */
const INC = 2; // Route coordinates skipped per move
const POSITIVE = 1;
const NEGATIVE = -1;

const FORWARD_DIR = 1;
const BACKWARD_DIR = -1;

const FORWARD_KEY = "ArrowUp";
const FORWARD_KEY_ALT = "KeyW";
const BACKWARD_KEY = "ArrowDown";
const BACKWARD_KEY_ALT = "KeyS";
const DIR_CHANGE_KEY = "KeyR";

const MIN_ZOOM = 16;
const MAX_ZOOM = 16;

/**
 * This object contains route IDs, followed by associative object mapping stop
 * IDs to route position indexes.
 */
const START_POSITIONS = {
    "610142": {
        "2481": 457,
        "19050": 328,
        "1960": 0,
    },
    "660047": {
        "1880": 327,
        "10793": 0,
        "19051": 222,
        "18055": 309,
        "10795": 290,
    },
    "1110001": {
        "10823": 286,
        "10813": 150,
        "10792": 0,
    },
    "2220001": {
        "6291": 376,
        "3001": 187,
        "10792": 0,
    },
    "4440002": {
        "10793": 84,
        "4641": 696,
        "19910": 0,
    },
    "P2060002": {
        "5902": 490,
        "228": 0,
        "3071": 172,
    },
}

/* Globals */
let map; // Map holder

// Car
let userMarker; // Marker of the user
let circle; // circle round the user marker

let car_orientation // Car move direction
    = FORWARD_DIR;
let angle = 0; // The angle of the user's marker

let index = 0; // Index of route points which the user is currently at
let nextIndex; // The next position to move to 
let routeCoordinates; // Store all coordinate pairs for the route
let maxIndex; // The max index of route points

let artImage; // Stores information about all art images

// Bus stops
let busStopMarkers; // Container for all bus stops

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
    let mapID;
    if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
        //Mobile device
        mapID = "map_mobile";
    } else {
        mapID = "map_desktop";
    }

    map = L.map(mapID, { keyboard: false, zoomControl: false })
        .setView([-27.491457, 153.102629], MIN_ZOOM);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        minZoom: MIN_ZOOM,
        maxZoom: MAX_ZOOM,
        attribution: '© OpenStreetMap'
    }).addTo(map);
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
 * Sets the index and new index values based on a stop along a route.
 * @param {str} route The target route's ID string
 * @param {str} stop The target stop's ID string
 */
function setIndexByRouteStop(route, stop) {
    index = START_POSITIONS[route][stop];
    nextIndex = getNewIndex(index, maxIndex, 1, car_orientation);
}

/**
 * Draw's the player's marker and the surrounding circle to the map.
 * @param {*} index The current index of the players position.
 * @param {*} angleIndexes Indexes to calculate the angle for the player marker
 */
function drawUser(index, angleIndexes) {
    userMarker = L.marker(
        [...getPoint(index)], { icon: playerIcon, zIndexOffset: -1000, }
    ).addTo(map);
    setMarkerAngleFromPointsIndexes(...angleIndexes);

    circle = L.circle([...getPoint(index)], {
        color: '#1aeefc',
        fillColor: '#3ef3ff',
        fillOpacity: 0.3,
        radius: 500
    }).addTo(map);

    map.panTo(userMarker.getLatLng());
}

function drawBusStops(stops) {
    // BUG Stops has been double stringified for some reason
    stops = JSON.parse(stops);

    // Store each marker after adding to the map
    busStopMarkers = stops.map(stop => {
        const [id, coords, name, url] = stop;
        stopMarker = L.marker(
            coords, { icon: busStopIcon, zIndexOffset: -1500 }
        ).addTo(map);

        // Add popup for on click
        let popup = L.DomUtil.create('div', 'infoWindow');
        popup.innerHTML = generateStopPopup(stop);
        stopMarker.bindPopup(popup);
    });
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
    let points = move_dir === FORWARD_DIR ? [index, nextIndex] : [nextIndex, index];

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

    iteratArtEvents(eventsPublicArt, ...getPoint(index));
    iterateBccEvents(eventsBCC, ...getPoint(index));
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

/**
 * Move the car forward.
 */
const moveForward = () => handleMove(car_orientation);

/**
 * Move the car backward.
 */
const moveBackward = () => handleMove(getOppositeDirection(car_orientation));

/** 
 * Change the direction of the car 
 */
function changeDirection() {
    car_orientation = getOppositeDirection(car_orientation);
}

/**
 * Get the direction opposite to that provided.
 * @param {*} direction the target direction
 * @returns The opposite direction
 */
function getOppositeDirection(direction) {
    return direction == FORWARD_DIR ? BACKWARD_DIR : FORWARD_DIR;
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
                moveForward();
                break;

            case BACKWARD_KEY:
            case BACKWARD_KEY_ALT:
                event.preventDefault(); // Ensure map does not pan
                moveBackward();
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
 * Register the onclick handlers for the map interactions.
 */
function registerBtnClick() {
    // Attach movement functions to buttons
    document.getElementById("ic_forward").onclick = e => moveForward();
    document.getElementById("ic_backward").onclick = e => moveBackward();
    document.getElementById("ic_rotate").onclick = e => handleTurn();
}

/**
 * Register the touchend handlers for the map interactions.
 */
function registerBtnTouch() {
    // Attach movement functions to buttons
    document.getElementById("ic_forward_mobile").onclick = e => moveForward();
    document.getElementById("ic_backward_mobile").onclick = e => moveBackward();
    document.getElementById("ic_rotate_mobile").onclick = e => handleTurn();
}

/**
 * Handles the main logic of the map interactibles setup, once all data is
 * loaded in on the user's end.
 * @param {*} buslineData The raw busline data to be parsed and drawn
 */
const initialiseMap = (buslineData, stops) => {
    routeCoordinates = JSON.parse(buslineData);

    // Set the initial position
    maxIndex = routeCoordinates.length - 1;
    car_orientation = index === maxIndex ? FORWARD_DIR : BACKWARD_DIR;
    nextIndex = getNewIndex(index, maxIndex, 1, car_orientation);

    // Route
    L.polyline(routeCoordinates, { color: '#b12defff', weight: 4 }).addTo(map);
    if (eventsPublicArt != "null" && eventsBCC != "null") {
        console.log("Source: localStorage");
        iteratArtEvents(eventsPublicArt, ...getPoint(index));
        iterateBccEvents(eventsBCC, ...getPoint(index));
    }

    // Put player marker on the map
    drawUser(index, [index, nextIndex])

    // Put the bus stops on the map
    drawBusStops(stops)

    // Update the event tray
    updateCollection();
}