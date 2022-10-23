<?php

/**
 * Return stop information based on a stop ID. Precondition is that the ID
 * exists within the array.
 * @param stops All stop information to search through, as an array.
 * @param id The target stop's ID. 
 */
function getStopInfoByID($stops, $id) {
    return array_values(array_filter($stops, function($stop) use ($id) {
        return $stop[0] == $id;
    }))[0];
}

/**
 * Return JSON encoded data relating to all of the stops for a specific bus 
 * route.
 */
function getStopData($target) {
    $stop_file = "../../data/stops/".$target.".txt";
    $fd = fopen($stop_file, "r");
    $data = [];

    if ($fd) {
        // Iterate manually for memory efficiency
        while (!feof($fd)) {
            $line = fgets($fd);

            // Split lines on comma
            $line = explode(',', $line);

            // Ignore invalid lines
            if (count($line) === 1) {
                continue;
            }

            // Pull out data
            array_push($data, [
                $line[0],                               // Stop ID
                [(float) $line[1], (float) $line[2]],   // LatLng
                $line[3],                               // Name
                $line[4]                                // URL
            ]);
        }

        return $data;
    }

    return false;
}

?>