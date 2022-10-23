<?php
/**
 * Retrieves event data from the Brisbane City Council.
 */
function getEventData() {
    $api_url ='http://www.trumba.com/calendars/brisbane-city-council.json';
    $data = file_get_contents($api_url);
    $data = json_decode($data, true);
    //print_r($data);
    $count = 0;
    foreach($data as $id => $val) {
        $coordinateFlag = false;
        $customFields = $val['customFields'];
        foreach($customFields as $seq => $content) {
            if ($content['fieldID'] == 22505) {
                $result = preg_match('/-\d{2}\.\d{6},\d{3}.\d{6}/', $content['value'], $coordinate, PREG_OFFSET_CAPTURE);
                if ($result) {
                    $coordinateFlag = true;
                    $count = $count + 1;
                    $coordinate = $coordinate[0][0];
                    $coordinate = explode(',', $coordinate);
                    // print_r($coordinate);
                }
                break;
            }
        }
        if ($coordinateFlag) {
            $data[$id]['lat'] = $coordinate[0];
            $data[$id]['lon'] = $coordinate[1];
            unset($data[$id]['eventID']);
            unset($data[$id]['customFields']);
            unset($data[$id]['allDay']);
            unset($data[$id]['template']);
            unset($data[$id]['locatinoType']);
            unset($data[$id]['webLink']);
            unset($data[$id]['startDateTime']);
            unset($data[$id]['endDateTime']);
            unset($data[$id]['startTimeZoneOffset']);
            unset($data[$id]['endTimeZoneOffset']);
            unset($data[$id]['canceled']);
            unset($data[$id]['openSignUp']);
            unset($data[$id]['reservationFull']);
            unset($data[$id]['pastDeadline']);
            unset($data[$id]['pastCancelDeadline']);
            unset($data[$id]['requiresPayment']);
            unset($data[$id]['refundsAllowed']);
            unset($data[$id]['waitingListAvailable']);
            unset($data[$id]['permaLinkUrl']);
            unset($data[$id]['eventActionUrl']);
            unset($data[$id]['categoryCalendar']);
            unset($data[$id]['registrationTransferTargetCount']);
            unset($data[$id]['regAllowChanges']);
            unset($data[$id]['detailImage']);
            unset($data[$id]['seriesID']);
            unset($data[$id]['locationType']);
        } else {
            unset($data[$id]);
        }
    }

    return $data;
}

?>