/******************************************************************************
 * Functions and variables relating to accessing/retrieving data.        *
 ******************************************************************************/

var eventData; // the event records
var updatedEvents; // the updated event records

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

function getServerStopData(route) {
    $.ajax({
        url: `../util/getStopData.php?route=${route}`,
        type: "GET",
        contentType: "html",
        success: data => {
            console.log(data);
        }
    });
}

//TODO Make this with a nicer structure
function process_bus_data(busline) {
    registerKeyPress(); // Enable interaction with map
    initialiseMap(busline); // Draw map related data
    handleMapLoad(); // Take actions once the map is loaded
}