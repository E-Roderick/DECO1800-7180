/* Constants */
const LS_EVENT_DATA = "eventData";
const LS_UPDATE_EVENT_DATA = "updatedEventData";

/* Globals */
let nearbyMarkers = []; // the event marker within a certain range of the user
let collectedEvents = [];

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
const generatePopup = (state, record) => {
    const { id, item, location, desc, image } = record;

    return `
        <div id='popup'>
            <h3>${item}</h3>
            <div>
                <p>${location}</p>
                <img src=${image} alt="blanchflower" />
                <p>${desc}</p>
            </div>
            <div class="wrapper">
                <input type="checkbox" class="heart-checkbox" id="heart-checkbox" ${state}>
                <label id = ${id} class="heart" for="heart-checkbox" 
                    onclick="collectCallback('${
                        encodeURIComponent(JSON.stringify(record)).replace(/'/g, '%27')
                    }');"></label>
            </div>
        </div>
    `;
}

/**
 * Iterate over all the given event records and draw markers for those that are near given coordinate.
 *
 * @param {any} results The event data.
 * @param {number} lat the latitude of the user's current position.
 * @param {number} lon the longitude of the user's current position.
 */
function iterateEventRecords(results, lat, lon) {
    $.each(results.result.records, function(recordID, recordValue) {
        var recordLatitude = recordValue["Latitude"];
        var recordLongitud = recordValue["Longitude"]
        var recordItem = recordValue["Item_title"];
        var recordDescription = recordValue["Description"];
        var recordLocation = recordValue["The_Location"];

        var recordIcon;
        if (recordID % 2)
            recordIcon = "/DECO1800-7180/public/assets/art-icons/mona-lisa.png";
        else
            recordIcon = "/DECO1800-7180/public/assets/art-icons/art.png";
        var artIcon = L.icon({
            iconUrl: recordIcon,
            // shadowUrl: 'images/mona-lisa.png',

            iconSize: [40, 40], // size of the icon
            // shadowSize:   [50, 64], // size of the shadow
            iconAnchor: [20, 20], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [0, -20] // point from which the popup should open relative to the iconAnchor
        });

        var checkState = '';
        if (collectedEvents.find(record => findCollectedEvent(record, recordID))) {
            checkState = 'checked';
        }

        let record = {
            id: recordID,
            item: recordItem,
            location: recordLocation,
            desc: recordDescription,
            icon: recordIcon,
            image: "/DECO1800-7180/public/assets/images/blanchflower.jpg"
        };
        var popupText = generatePopup(checkState, record);

        // Make sure the event coordinates exist and it's within 500m from the user's position.  
        if (recordLatitude && recordLatitude &&
            distanceInKmBetweenEarthCoordinates(lat, lon, recordLatitude, recordLongitud) * 1000 < 500) {
            var marker = L.marker([recordLatitude, recordLongitud], { icon: artIcon }).addTo(map);
            nearbyMarkers.push(marker);
            var myPopup = L.DomUtil.create('div', 'infoWindow');
            myPopup.innerHTML = popupText;
            // marker.bindPopup(`<button type="button" onclick="alert('Hello world!')">Click Me!</button>`);
            marker.bindPopup(myPopup);
            $('#popup', myPopup).on('load', function() {
                console.log("popup");
            });
        }
    });
}

/**
 * Iterate over all the given updated event records and draw markers for those that are near given coordinate.
 *
 * @param {any} results The event data.
 * @param {number} lat the latitude of the user's current position.
 * @param {number} lon the longitude of the user's current position.
 */
function iterateUpdatedEvents(results, lat, lon) {
    $.each(results, function(recordID, recordValue) {
        //console.log(recordValue);
        var recordLatitude = recordValue["lat"];
        var recordLongitud = recordValue["lon"]
        var recordItem = recordValue["title"];
        var recordDescription = recordValue["description"];
        var recordLocation = recordValue["location"];
        var recordImage = "/DECO1800-7180/public/assets/images/blanchflower.jpg";
        if ('eventImage' in recordValue)
            recordImage = recordValue["eventImage"]["url"];

        var artIcon = L.icon({
            iconUrl: "/DECO1800-7180/public/assets/art-icons/party.png",
            // shadowUrl: 'images/mona-lisa.png',

            iconSize: [40, 40], // size of the icon
            // shadowSize:   [50, 64], // size of the shadow
            iconAnchor: [20, 20], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [0, -20] // point from which the popup should open relative to the iconAnchor
        });

        var checkState = '';
        if (collectedEvents.find(record => findCollectedEvent(record, recordID))) {
            checkState = 'checked';
        }

        let record = {
            id: recordID,
            item: recordItem,
            location: recordLocation,
            desc: recordDescription,
            icon: "/DECO1800-7180/public/assets/art-icons/party.png",
            image: recordImage
        };
        var popupText = generatePopup(checkState, record);

        // Make sure the event coordinates exist and it's within 500m from the user's position.  
        if (recordLatitude && recordLatitude &&
            distanceInKmBetweenEarthCoordinates(lat, lon, recordLatitude, recordLongitud) * 1000 < 500) {
            var marker = L.marker([recordLatitude, recordLongitud], { icon: artIcon }).addTo(map);
            nearbyMarkers.push(marker);
            var myPopup = L.DomUtil.create('div', 'infoWindow');
            myPopup.innerHTML = popupText;
            // marker.bindPopup(`<button type="button" onclick="alert('Hello world!')">Click Me!</button>`);
            marker.bindPopup(myPopup);
            $('#popup', myPopup).on('load', function() {
                console.log("popup");
            });
        }
    });
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

    // Propagate updates to collection
    updateCollection();
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
}

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
            eventData = data;
            set_local_data_events(data, LS_EVENT_DATA);
        }
    });
}

function getServerEventData() {
    return $.ajax({
        url: `../util/getEventData.php`,
        dataType: "json",
        success: data => {
            updatedEvents = data;
            set_local_data_events(data, LS_UPDATE_EVENT_DATA);
        }
    });
}