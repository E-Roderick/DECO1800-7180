<?php

function getRouteData($target) {
    $route_file = "../../data/routes/".$target.".txt";
    $fd = fopen($route_file, "r");
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
            
            // Pull out coordinates
            array_push($data, [(float) $line[0], (float) $line[1]]);
        }

        return $data;
    }

    return false;
}

?>