<?php

function getRouteData($target) {
    $shape_file = "../../data/shapes.txt";
    $fd = fopen($shape_file, "r");
    $data = [];

    if ($fd) {
        // Iterate manually for memory efficieny
        while (!feof($fd)) {
            $line = fgets($fd);
    
            // Split lines on comma
            $line = explode(',', $line);
            
            // Filter for target
            if (!in_array($target, $line)) {
                continue;
            }
            
            // Pull out coordinates
            array_push($data, [(float) $line[1], (float) $line[2]]);
        }

        return json_encode($data);
    }

    return false;
}

echo getRouteData($_GET["route"]);

?>