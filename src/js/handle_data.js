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

/**
 * Retrieve data from local storage.
 * @param {str} localVar the name of the local storage item
 * @returns The data from local storage
 */
function getLocalStorage(localVar) {
    return JSON.parse(localStorage.getItem(localVar));
}

/**
 * Place an item into local storage
 * @param {*} data the data to store
 * @param {str} localVar the name of the local storage item
 */
function setLocalStorage(data, localVar) {
    localStorage.setItem(localVar, JSON.stringify(data));
}

/**
 * Check if data exists and is not null.
 * @param {*} data the data to check.
 * @returns True if the data is valid. False otherwise.
 */
function isValidData(data) {
    return data && data != "null";
}

/**
 * Retrieve remote information regarding public art events. Retrieved 
 * information is stored in local storage, and a global variable.
 * @returns A promise regarding the public art events.
 */
function getRemoteArtEvents() {
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
            setLocalStorage(data, LS_EVENT_ART_DATA);
        }
    });
}

/**
 * Retrieve remote information regarding BCC local events. Retrieved 
 * information is stored in local storage, and a global variable.
 * @returns A promise regarding the BCC events.
 */
function getServerBccData() {
    return $.ajax({
        url: `../util/getEventData.php`,
        dataType: "json",
        success: data => {
            eventsBCC = data;
            setLocalStorage(data, LS_EVENT_BCC_DATA);
        }
    });
}

/**
 * Retrieve remote information regarding translink bus routes. The information
 * retreived is the route shape coordinate points, and the coordinates, name,
 * and URL for the bus stops along the given route.
 * @param {str} route A route identifier
 */
function getServerRouteData(route) {
    let routeData;
    let stops;

    // Request route information from the server
    let routeResolver = $.ajax({
        url: `../util/getRouteData.php?route=${route}`,
        type: "GET",
        contentType: "html",
        success: data => { routeData = data; }
    });

    // Request stop information from the server
    let stopResolver = $.ajax({
        url: `../util/getStopData.php?route=${route}`,
        type: "GET",
        contentType: "html",
        success: data => { stops = data; }
    });

    $.when(routeResolver, stopResolver).done(function() {
        processRouteData(routeData, stops);
    });
}

/**
 * Gets all of the event data, and stores it in the respective globals. 
 * Currently, the event data is the public art events, and the BCC local events.
 */
async function getEventData() {
    let resolving = [];

    // Get public art event data
    eventsPublicArt = getLocalStorage(LS_EVENT_ART_DATA);
    if (!isValidData(eventsPublicArt)) {
        // Track that we have something to resolve
        resolving.push(getRemoteArtEvents())
    }

    // Get BCC event data
    eventsBCC = getLocalStorage(LS_EVENT_BCC_DATA);
    if (!isValidData(eventsBCC)) {
        // Track that we have something to resolve
        resolving.push(getServerBccData())
    }
    
    // Wait for any outstanding data requests
    if (resolving) {
        await Promise.all(resolving);
    }
}

function getServerArtImage() {
    return $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/DECO1800-7180/data/images.json',
        success: function(data) {
            // console.log(data);
            artImage = data;
        }
    });
}