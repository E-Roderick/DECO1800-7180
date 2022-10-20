/******************************************************************************
 * Functions and variables relating to accessing/retrieving data.        *
 ******************************************************************************/

/* Constants */
const LS_EVENT_ART_DATA = "event_art_data";
const LS_EVENT_BCC_DATA = "event_bcc_data";

/* Globals */
let eventsPublicArt;    // Events from the public art API
let eventsBCC;          // Events from the BCC event site

/* Functions */
function get_local_data_events(localVar) {
    return JSON.parse(localStorage.getItem(localVar));
}

function set_local_data_events(data, localVar) {
    localStorage.setItem(localVar, JSON.stringify(data));
}

function get_remote_data_events() {
    const request = {
        resource_id: "3c972b8e-9340-4b6d-8c7b-2ed988aa3343",
        limit: 100
    }

    return $.ajax({
        url: "https://www.data.brisbane.qld.gov.au/data/api/3/action/datastore_search",
        data: request,
        dataType: "jsonp",
        cache: true,
        success: data => {
            eventsPublicArt = data;
            set_local_data_events(data, LS_EVENT_ART_DATA);
        }
    });
}

function getServerEventData() {
    return $.ajax({
        url: `../util/getEventData.php`,
        dataType: "json",
        success: data => {
            eventsBCC = data;
            set_local_data_events(data, LS_EVENT_BCC_DATA);
        }
    });
}

function getServerRouteData(route) {
    $.ajax({
        url: `../util/getRouteData.php?route=${route}`,
        type: "GET",
        contentType: "html",
        success: data => {
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