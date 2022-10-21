/******************************************************************************
 * Functions and variables relating to map routes.                       *
 ******************************************************************************/

/* Constants */
const ROUTES = {
    /* Route: [route_ids]*/
    "61": ["610003", "610142"],
    "66": ["660001", "660047"],
    "111": ["1110001", "1110086"],
    "222": ["2220001", "2220058"],
    "444": ["4440002", "4440004"],
    "P206": ["P2060002", "P2060003"],
}

/* Functions */

const generateStopPopup = (stop) => {
    const [ id, coords, name, url ] = stop;

    return `
        <article id='popup'>
            <h3>${name}</h3>
            <div>
                <p>More information about this stop can be found on the 
                <a href="${url}">TransLink website</a>.
            </div>
        </article>
    `;
}

/**
 * Initialises the map with loaded route data.
 * @param {*} busline list of coordinates making up a route shape
 * @param {*} stops list of stop information for stops along the busline 
 */
 function processRouteData(busline, stops) {
    initialiseMap(busline, stops); // Draw map related data
    handleMapLoad(); // Take actions once the map is loaded
}