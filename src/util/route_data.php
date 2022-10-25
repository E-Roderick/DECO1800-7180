<?php

$ROUTES = array(
    "61" => "610142",
    "66" => "660047",
    "111" => "1110001",
    "222" => "2220001",
    "444" => "4440002",
    "P206" => "P2060002",
);

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

/**
 * Returns the signboard for a route (the public route number) based on a route
 * ID.
 * @param route The route ID of the target route.
 */
$getRouteSignById = function($route) use ($ROUTES){
    return array_search($route, $ROUTES);
}

?>