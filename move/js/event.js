var artIcon = L.icon({
    iconUrl: 'images/mona-lisa.png',
    // shadowUrl: 'images/mona-lisa.png',

    iconSize: [40, 40], // size of the icon
    // shadowSize:   [50, 64], // size of the shadow
    iconAnchor: [20, 20], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [0, -20] // point from which the popup should open relative to the iconAnchor
});

var nearbyMarkers = []; // the event marker within a certain range of the user

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

        var popupText = `<h3>${recordItem}</h3>
        <div>
            <p>${recordLocation}</p>
            <img src="images/blanchflower.jpg" alt="blanchflower" />
            <p>${recordDescription}</p>
        </div>
        <div class="wrapper">
            <input type="checkbox" class="heart-checkbox" id="heart-checkbox">
            <label id = ${recordID} class="heart" for="heart-checkbox" onclick="myFunction(this.id);"></label>
        </div>
        <button type="button" class="button" onclick="alert('Hello angel!')">Click Me!</button>`;

        // Make sure the event coordinates exist and it's within 500m from the user's position.  
        if (recordLatitude && recordLatitude &&
            distanceInKmBetweenEarthCoordinates(lat, lon, recordLatitude, recordLongitud) * 1000 < 500) {
            var marker = L.marker([recordLatitude, recordLongitud], { icon: artIcon }).addTo(map)
            nearbyMarkers.push(marker);
            // marker.bindPopup(`<button type="button" onclick="alert('Hello world!')">Click Me!</button>`);
            marker.bindPopup(popupText);
        }
    });
    // var hearts = document.getElementsByClassName("heart");
    // console.log(hearts);

    // for (var i = 0; i < hearts.length ; i++) {
    //     hearts[i].addEventListener("click", myFunction);
    // }
}

function myFunction(id) {
    console.log(id);
    alert('Saved!');
}

console.log(updatedEvents)
$(document).ready(function() {
    var eventData = JSON.parse(localStorage.getItem("eventData"));

    if (eventData) {
        console.log("Source: localStorage");
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
                localStorage.setItem("eventData", JSON.stringify(data));
            }
        });
    }
});