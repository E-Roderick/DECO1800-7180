/******************************************************************************
 * Functions and variables relating to the expplore page, not incl. the map   *
 ******************************************************************************/

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
 * The main page operation for the explore page. Loads all requisite data and 
 * the map, sets up listeners.
 */
function doPageOperation() {
    // Create the map and load tiles
    createMap();

    // Load event data
    // TODO Combine the get local and get remote into one get call
    // TODO Neaten up all functions and naming
    eventData = get_local_data_events(LS_EVENT_ART_DATA);
    updatedEvents = get_local_data_events(LS_EVENT_BCC_DATA);
    
    const route = getUrlParam(window.location.href, "route");
    getServerStopData(route);
    if (isValid(eventData) && isValid(updatedEvents)) {
        console.log("Source: localStorage");
        // Load busline data from server
        console.log(route);
        getServerRouteData(route);
    } else {
        console.log("Source: API");
        // Load event information
        $.when(get_remote_data_events(), getServerEventData()).done(function() {
            // Load busline data from server
            console.log(route);
            getServerRouteData(route);
        });
    }
}
