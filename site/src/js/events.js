var artIcon = L.icon({
    iconUrl: "/DECO1800-7180/site/public/assets/art-icons/mona-lisa.png",
    // shadowUrl: 'images/mona-lisa.png',

    iconSize: [40, 40], // size of the icon
    // shadowSize:   [50, 64], // size of the shadow
    iconAnchor: [20, 20], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [0, -20] // point from which the popup should open relative to the iconAnchor
});

var nearbyMarkers = []; // the event marker within a certain range of the user
var collectFlags = new Array(100).fill(0);
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
        if (collectFlags[recordID]) {
            checkState = 'checked';
        }
        var popupText = `<div id='popup'>
            <h3>${recordItem}</h3>
            <div>
                <p>${recordLocation}</p>
                <img src="/DECO1800-7180/site/public/assets/images/blanchflower.jpg" alt="blanchflower" />
                <p>${recordDescription}</p>
            </div>
            <div class="wrapper">
                <input type="checkbox" class="heart-checkbox" id="heart-checkbox" ${checkState}>
                <label id = ${recordID} class="heart" for="heart-checkbox" onclick="collectCallback(this.id);"></label>
            </div>
        </div>`;

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
    // var hearts = document.getElementsByClassName("heart");
    // console.log(hearts);

    // for (var i = 0; i < hearts.length ; i++) {
    //     hearts[i].addEventListener("click", collectCallback);
    // }

    // let markers = document.querySelectorAll(".leaflet-marker-icon");
    // console.log(markers);
    // for (i = 0; i < markers.length; ++i) {
    //     markers[i].addEventListener('click', markerCallback);
    // }
}
// function markerCallback() {
//     //let popup = document.querySelectorAll(".leaflet-popup-pane");
//     console.log("popup");
// }

function collectCallback(id) {
    console.log(id);
    console.log(collectFlags[id]);
    collectFlags[id] = 1 - collectFlags[id];
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