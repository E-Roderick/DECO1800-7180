<?php 
require_once("../util/route_data.php");

// Uses the getRouteData() function to serve the route data as text.
echo json_encode(getRouteData($_GET["route"]));
?>