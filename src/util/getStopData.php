<?php

function getStopData($target) {
    $stop_file = "../../data/stops/".$target.".txt";
    $fd = fopen($stop_file, "r");
    $data = [];

    if ($fd) {
        // Iterate manually for memory efficiency
        while (!feof($fd)) {
            $line = fgets($fd);

            // Remove comma and quotes from stop name
            if (strpos($line, '"') !== false) {
                // Remove quotes
                $line = explode('"', $line);
                
                // Remove platform information from name
                $name = explode(',', $line[1])[0];

                // Add name back to line
                $line = $line[0] . $name . $line[2];
            }

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
                $name,                                  // Name
                $line[4]                                // URL
            ]);
        }

        return json_encode($data);
    }

    return false;
}

echo getStopData($_GET["route"]);

?>