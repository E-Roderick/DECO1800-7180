function iterateRecords(data) {
    // Record labels
    const DESC = "DESCRIPTION"
    const LATITUDE = "LATITUDE"
    const LONGITUDE = "LONGITUDE"

    console.log(data);
    $.each(data.result.records, function(recordKey, recordValue) {
        // Obtain information from records
        let record_desc = recordValue[DESC];
        let record_lat = recordValue[LATITUDE];
        let record_long = recordValue[LONGITUDE];

        if (!(record_desc && record_lat && record_long)) {
            // Invalid record
            return;
        }

        $("#records").append(
            $('<section class="record">').append(
                $('<h2>').text(record_desc),
                $('<p>').text(record_lat),
                $('<p>').text(record_long),
            )
        );
    });
}

$(document).ready(function() {

    var data = {
        resource_id: "e2a32ebc-94a6-4c7e-9f0b-4385280ed083",
        limit: 50
    }

    $.ajax({
        url: "https://www.data.brisbane.qld.gov.au/data/api/3/action/datastore_search",
        data: data,
        dataType: "jsonp", // We use "jsonp" to ensure AJAX works correctly locally (otherwise XSS).
        cache: true,
        success: function(data) {
            iterateRecords(data);
        }
    });

});

// Data source: https://www.data.qld.gov.au/dataset/crash-data-from-queensland-roads/resource/e88943c0-5968-4972-a15f-38e120d72ec0