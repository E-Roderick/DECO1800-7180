<?php 
require_once("../util/event_data.php");

// Uses the getEventData() function to serve the event data as text.
echo json_encode(getEventData());
?>