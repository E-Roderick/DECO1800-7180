<?php 
require_once("../util/stop_data.php");

// Uses the getStopData() function to serve the stop data as text.
echo getStopData($_GET["route"]);
?>