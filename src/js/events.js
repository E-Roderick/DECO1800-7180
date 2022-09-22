var artIcon = L.icon({
    iconUrl: "/DECO1800-7180/public/assets/art-icons/mona-lisa.png",
    // shadowUrl: 'images/mona-lisa.png',

    iconSize: [40, 40], // size of the icon
    // shadowSize:   [50, 64], // size of the shadow
    iconAnchor: [20, 20], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [0, -20] // point from which the popup should open relative to the iconAnchor
});

var nearbyMarkers = []; // the event marker within a certain range of the user
let collectedEvents = [];

// Function to find a collected event
const findCollectedEvent = (ce, id) => ce.id === id; 

/**
 * Generates HTML for an event's popup.
 * @param {str} state Whether this event has been collected yet.
 * @param {Any} record Record obj containing the event's information.
 * @returns String of popup's inner HTML.
 */
const generatePopup = (state, record) => {
    const { id, item, location, desc } = record;
    return `
        <div id='popup'>
            <h3>${item}</h3>
            <div>
                <p>${location}</p>
                <img src="/DECO1800-7180/public/assets/images/blanchflower.jpg" alt="blanchflower" />
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

        var checkState = '';
        if (collectedEvents.find(record => findCollectedEvent(record, recordID))) {
            checkState = 'checked';
        }

        let record = {
            id: recordID, 
            item: recordItem, 
            location: recordLocation, 
            desc: recordDescription
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

function updateCollection() {
    // Empty container
    $("#collection").empty();

    // Add all icons
    collectedEvents.forEach(collected => {
        $("#collection").append(
            $('<section class="collected-event">').append(
                '<img src="/DECO1800-7180/public/assets/art-icons/mona-lisa.png" height="64px" width="64px">'
            )
        );
    });
}

console.log(updatedEvents)
$(document).ready(function() {
    eventData = JSON.parse(localStorage.getItem("eventData"));

    if (eventData) {
        console.log("Source: localStorage");
        $.ajax({
            type: "GET",
            url: "/DECO1800-7180/data/shapes.txt",
            dataType: "text",
            success: function(data) {
                dataLoad(data);
            }
        });
    } else {
        var data = {
            resource_id: "3c972b8e-9340-4b6d-8c7b-2ed988aa3343",
            limit: 100
        }

        $.ajax({
            url: "https://www.data.brisbane.qld.gov.au/data/api/3/action/datastore_search",
            data: data,
            dataType: "jsonp",
            cache: true,
            success: function(data) {
                eventData = data;
                localStorage.setItem("eventData", JSON.stringify(data));
                $.ajax({
                    type: "GET",
                    url: "/DECO1800-7180/data/shapes.txt",
                    dataType: "text",
                    success: function(data) {
                        dataLoad(data);
                    }
                });
            }
        });
    }
});