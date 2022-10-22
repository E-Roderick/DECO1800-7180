/******************************************************************************
 * Functions and variables relating to the explore page, not incl. the map    *
 ******************************************************************************/

/**
 * Handles the tutorial page upon map load.
 */
 function handleMapLoad() {
    $("#help-skip-btn").prop("disabled", false); // Enable button
    $("#help-skip-btn").text("Skip Tutorial"); // Update text
}

/**
 * On-click event for the skip button in the tutorial page. Also enables
 * movement on the map. This is done here to stop movement during the tutorial.
 */
function helpSkipOnClick() {
    registerKeyPress(); // Enable interaction with map
    registerBtnClick(); // Enable button interaction
    $("#map-help").addClass("complete");
}

/**
 * The main page operation for the explore page. Loads all requisite data and 
 * the map, sets up listeners.
 */
async function doPageOperation() {
    // Create the map and load tiles
    createMap();

    // Load images
    getServerArtImage();

    // Load event data   
    await getEventData();

    const route = getUrlParam(window.location.href, "route");
    getServerRouteData(route);
}
