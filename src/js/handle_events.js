/******************************************************************************
 * Functions and variables relating to the map events.                       *
 ******************************************************************************/
/* Globals */
let nearbyMarkers = []; // the event marker within a certain range of the user
let collectedEvents = [];

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
const generatePopup = (state, record) => {
    const { id, item, location, desc, image, start, end, source } = record;
    var showTime = "";
    if (!start || !end)
        showTime = "hide";
    var showSource;
    if (!source)
        showSource = "hide";

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
 * Iterate over all the given event records and draw markers for those that are near given coordinate.
 *
 * @param {any} results The event data.
 * @param {number} lat the latitude of the user's current position.
 * @param {number} lon the longitude of the user's current position.
 */
function iteratArtEvents(results, lat, lon) {
    $.each(results.result.records, function(recordID, recordValue) {
        var recordLatitude = recordValue["Latitude"];
        var recordLongitud = recordValue["Longitude"]
        var recordItem = recordValue["Item_title"];
        var recordDescription = recordValue["Description"];
        var recordLocation = recordValue["The_Location"];
        var recordImage = "/DECO1800-7180/public/assets/images/blanchflower.jpg";
        var recordSource;
        if (artImage.hasOwnProperty(recordItem)) {
            recordImage = artImage[recordItem][0];
            recordSource = artImage[recordItem][1];
        }

        var recordIcon;
        if (recordID % 2)
            recordIcon = "/DECO1800-7180/public/assets/event-icons/mona-lisa.png";
        else
            recordIcon = "/DECO1800-7180/public/assets/event-icons/art.png";
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
            image: recordImage,
            start: '',
            end: '',
            source: recordSource
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
function iterateBccEvents(results, lat, lon) {
    $.each(results, function(recordID, recordValue) {
        console.log(recordValue);
        var recordLatitude = recordValue["lat"];
        var recordLongitud = recordValue["lon"]
        var recordItem = recordValue["title"];
        var recordDescription = recordValue["description"];
        var recordLocation = recordValue["location"];
        var recordImage = "/DECO1800-7180/public/assets/images/blanchflower.jpg";
        if ('eventImage' in recordValue)
            recordImage = recordValue["eventImage"]["url"];
        var recordStartTime = recordValue["startDateTime"];
        var recordEndTime = recordValue["endDateTime"];

        var artIcon = L.icon({
            iconUrl: "/DECO1800-7180/public/assets/event-icons/party.png",
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
            icon: "/DECO1800-7180/public/assets/event-icons/party.png",
            image: recordImage,
            start: recordStartTime,
            end: recordEndTime
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