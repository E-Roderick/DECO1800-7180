<?php

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

        return json_encode($data);
    }

    return false;
}

echo getStopData($_GET["route"]);

?>