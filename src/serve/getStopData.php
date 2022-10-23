<?php 
require_once("../util/getStopData.php");

// Uses the getStopData() function to serve the stop data as text.
echo getStopData($_GET["route"]);
?>