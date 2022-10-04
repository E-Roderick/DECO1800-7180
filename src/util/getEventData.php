<?php
/**
 * Retrieves event data from the Brisbane City Council.
 */
function getEventData() {
    $api_url ='http://www.trumba.com/calendars/brisbane-city-council.json';
    $data = file_get_contents($api_url);
    $data = json_decode($data, true);
    $location = $data[0]['location'];
    //print_r($location);
    $result = preg_match('/http:\/\/maps\.google\.com\/.+Australia/', $location, $locationUrl, PREG_OFFSET_CAPTURE);
    if ($result) {
        $locationUrl = $locationUrl[0][0];
        print_r($locationUrl);
        $api_url = $locationUrl;
        $locationData = file_get_contents($api_url);
        //echo($locationData);
        $result = preg_match('/center=-?\d+\.\d+%2C\d+\.\d+/', $locationData, $matches, PREG_OFFSET_CAPTURE);
        print_r($matches);
        $coordinates = substr($matches[0][0], 7);
        echo($coordinates);
        $coordinates = explode('%2C', $coordinates);
        print_r($coordinates);
        $data[0]['location'] = $coordinates;
        print_r($data[0]);
        return $data;
    }
    return "null";
}

echo getEventData();

?>