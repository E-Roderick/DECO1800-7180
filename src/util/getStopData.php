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
                (float) $line[0],   // Lat
                (float) $line[1],   // Lon
                $line[2],           // Name
                $line[3]            // URL
            ]);
        }

        return json_encode($data);
    }

    return false;
}

echo getStopData($_GET["route"]);

?>