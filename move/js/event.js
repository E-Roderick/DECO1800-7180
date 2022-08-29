function getYear(year) {
    if (year) {
        return year.match(/[\d]{4}/); // This is regex: https://en.wikipedia.org/wiki/Regular_expression
    }
}

var artIcon = L.icon({
    iconUrl: 'images/mona-lisa.png',
    // shadowUrl: 'images/mona-lisa.png',

    iconSize: [40, 40], // size of the icon
    // shadowSize:   [50, 64], // size of the shadow
    iconAnchor: [20, 20], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62], // the same for the shadow
    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var nearbyMarkers = [];

function iterateRecords1(results, lat, lon) {

    console.log(results);

    // Iterate over each record and add a marker using the Latitude field (also containing longitude)
    $.each(results.result.records, function(recordID, recordValue) {
        var recordLatitude = recordValue["Latitude"];
        var recordLongitud = recordValue["Longitude"]
        var recordItem = recordValue["Item_title"];
        var recordDescription = recordValue["Description"];
        var recordLocation = recordValue["The_Location"];
        //console.log(recordLatitude, recordLongitud);
        //console.log(distanceInKmBetweenEarthCoordinates(lat, lon, recordLatitude, recordLongitud) * 1000);
        if (recordLatitude && recordLatitude &&
            distanceInKmBetweenEarthCoordinates(lat, lon, recordLatitude, recordLongitud) * 1000 < 500) {
            var marker = L.marker([recordLatitude, recordLongitud], { icon: artIcon }).addTo(map)
            nearbyMarkers.push(marker);
            marker.bindPopup(`<b>${recordItem}</b><br>${recordLocation}<br>${recordDescription}`);
            //marker.bindPopup(`<b>${recordItem}</b><br>${distanceInKmBetweenEarthCoordinates(lat, lon, recordLatitude, recordLongitud) * 1000}`);
        }


    });

}



$(document).ready(function() {

    var eventData = JSON.parse(localStorage.getItem("eventData"));

    if (eventData) {
        console.log("Source: localStorage");
        //iterateRecords1(eventData);
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
                //iterateRecords1(data);
            }
        });
    }
});