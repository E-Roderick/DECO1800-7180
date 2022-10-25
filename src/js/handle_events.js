/******************************************************************************
 * Functions and variables relating to the map events.                       *
 ******************************************************************************/
/* Globals */
let nearbyMarkers = []; // the event marker within a certain range of the user
let collectedEvents = getLocalStorage(LS_EVENT_COLLECTED);
if (!collectedEvents)
    collectedEvents = [];

const EVENT_RADIUS = 500;

/* Functions */
/**
 * Find a collected event based on ID.
 * @param {obj} ce The collected event object
 * @param {int} id The target ID
 * @returns True if the event object's ID matches the target. False otherwise
 */
const findCollectedEvent = (ce, id) => ce.id === id;

/**
 * Generates HTML for an event's popup.
 * @param {str} state Whether this event has been collected yet.
 * @param {Any} record Record obj containing the event's information.
 * @returns String of popup's inner HTML.
 */
const generateEventPopup = (state, record) => {
    var { id, item, location, desc, icon, image, start, end, source } = record;
    var showTime = "";
    if (!start || !end)
        showTime = "hide";
    var showSource;
    if (!source)
        showSource = "hide";
    desc = desc.replace("<p>", "");
    desc = desc.replace("</p>", "");

    return `
        <section id='popup'>
            <section class='title'>
                <h3>${item}</h3>
                <input type="checkbox" class="heart-checkbox" id="heart-checkbox" ${state}>
                <label id = ${id} class="heart" for="heart-checkbox" 
                    onclick="collectCallback('${
                    encodeURIComponent(JSON.stringify(record)).replace(/'/g, '%27')
                    }');" ></label>
            </section>
            <section class='time ${showTime}'>
                <span>${start}</span> ~
                <span>${end}</span>
            </section>
            <section class='detail'>
                <div class='desc'>
                    <p>${location}</p>
                    <p class='ellipsis'>${desc}</p>
                </div>
                <div class="case cover" style="background: url('${image}') center center;"></div>
            </section>
            <section class='${showSource}'>
                <a href=${source} target='_blank' rel='noopener'>source</a>
            </section>
        </section>
    `;
}

/**
 * Iterate over all the given art events and draw markers for those that are 
 * near given coordinate.
 *
 * @param {any} results The event data.
 * @param {number} lat the latitude of the user's current position.
 * @param {number} lon the longitude of the user's current position.
 */
function iteratArtEvents(results, lat, lon) {
    $.each(results.result.records, function(eventID, eventData) {
        let latitude = eventData["Latitude"];
        let longitude = eventData["Longitude"]
        let title = eventData["Item_title"];
        let description = eventData["Description"];
        let location = eventData["The_Location"];

        let image;
        let source;
        if (artImage && artImage.hasOwnProperty(title)) {
            image = artImage[title][0];
            source = artImage[title][1];
        }


        let collected = collectedEvents.find(
            event => findCollectedEvent(event, eventID)
        ) ? 'checked' : '';

        let event = {
            id: eventID,
            item: title,
            location: location,
            desc: description,
            icon: artEventIcon.options.iconUrl,
            image: image,
            start: '',
            end: '',
            source: source
        };

        // Handle the event data
        handleSingleEvent(
            event,
            collected, [lat, lon], [latitude, longitude],
            artEventIcon
        );
    });
}

/**
 * Iterate over all the given BCC local events records and draw markers for 
 * those that are near given coordinate.
 *
 * @param {any} results The event data.
 * @param {number} lat the latitude of the user's current position.
 * @param {number} lon the longitude of the user's current position.
 */
function iterateBccEvents(results, lat, lon) {
    $.each(results, function(eventID, eventData) {

        // Retrieve relevant event information
        let latitude = eventData["lat"];
        let longitude = eventData["lon"]
        let title = eventData["title"];
        let description = eventData["description"];
        let location = eventData["location"];
        var start = eventData["startDateTime"];
        var end = eventData["endDateTime"];

        let recordImage;
        if ("eventImage" in eventData)
            recordImage = eventData["eventImage"]["url"];

        let collected = collectedEvents.find(
            event => findCollectedEvent(event, eventID)
        ) ? 'checked' : '';

        // Create event object
        let event = {
            id: eventID,
            item: title,
            location: location,
            desc: description,
            icon: culturalEventIcon.options.iconUrl,
            image: recordImage,
            start: start,
            end: end
        };

        // Handle the event data
        handleSingleEvent(
            event,
            collected, [lat, lon], [latitude, longitude],
            culturalEventIcon
        );
    });
}

/**
 * Creates a marker for a given event if it is close enough to the given 
 * position.
 * 
 * @param {*} event The event details as an object
 * @param {*} collectState The state of collection for the event
 * @param {*} refPos The reference position as a latLon
 * @param {*} eventPos The event's position as a latLon
 * @param {*} icon The icon to display as the events marker
 */
function handleSingleEvent(event, collectState, refPos, eventPos, icon) {
    // console.log(event);
    // Find the distance between car and event
    let distance = eventPos[0] && eventPos[1] ?
        distanceInKmBetweenCoords(...refPos, ...eventPos) :
        null;

    // Make sure the event is within 500m from the user's position.  
    if (distance * 1000 < EVENT_RADIUS) {
        // Create a new marker
        let marker = L.marker(eventPos, { icon: icon }).addTo(map);
        nearbyMarkers.push(marker);

        let popup = L.DomUtil.create('div', 'infoWindow');
        popup.innerHTML = generateEventPopup(collectState, event);
        marker.bindPopup(popup);
    }
}

/**
 * Handle the collection of an event icon.
 * @param {obj} record Information pertaining to the collected event.
 */
function collectCallback(record) {
    record = JSON.parse(decodeURIComponent(record));
    console.log(record);
    const id = record.id;

    if (collectedEvents.find(record => findCollectedEvent(record, id))) {
        collectedEvents = collectedEvents.filter(record => record.id !== id);
    } else {
        collectedEvents.push(record);
    }
    setLocalStorage(collectedEvents, LS_EVENT_COLLECTED);
    // Propagate updates to collection
    updateCollection();
}

function updateCount(count) {
    // <foreignObject id="inv_count_text" x="1167" y="125" width="50" height="30">0</foreignObject>
    let countText = document.getElementById("inv_count_text");
    countText.innerHTML = String(count);
}

/**
 * Update the collection tray on the map page, based on the actual collected
 * events.
 */
function updateCollection() {
    // Empty container
    $("#collection").empty();

    // Add all icons
    collectedEvents.forEach(collected => {
        $("#collection").append(
            $('<section class="collected-event">').append(
                `<img src=${collected.icon} height="64px" width="64px">`
            )
        );
    });

    // Update the inventory icon number
    updateCount(collectedEvents.length)    
}