/******************************************************************************
 * Creation of map icons to display on the map.                          *
 ******************************************************************************/

/* Constants */
const ICON_PLAYER_WIDTH = 56;
const ICON_PLAYER_HEIGHT = 75;
const ICON_STOP_SIZE = 40;
const ICON_EVENT_SIZE = 50;

/* Icons */
const playerIcon = L.icon({
    iconUrl: "/DECO1800-7180/public/assets/avatar/player.svg",
    // SPecify size of the icon
    iconSize: [ICON_PLAYER_WIDTH, ICON_PLAYER_HEIGHT],
    // Specify where in the icon will be tied to the map
    iconAnchor: [ICON_PLAYER_WIDTH/2, ICON_PLAYER_HEIGHT/2],
    // Specify where in the icon popup's should originate (rel to iconAnchor)
    popupAnchor: [-3, -76]
});

const busStopIcon = L.icon({
    iconUrl: "/DECO1800-7180/public/assets/ui/icons/ic_bus_stop.svg",
    iconSize: [ICON_STOP_SIZE, ICON_STOP_SIZE],
    iconAnchor: [ICON_STOP_SIZE/2, ICON_STOP_SIZE/2],
    popupAnchor: [0, 0],
});

const artEventIcon = L.icon({
    iconUrl: "/DECO1800-7180/public/assets/event-icons/ic_art.svg",
    iconSize: [ICON_EVENT_SIZE, ICON_EVENT_SIZE],
    iconAnchor: [ICON_EVENT_SIZE/2, ICON_EVENT_SIZE/2],
    popupAnchor: [0, 0],
});

const culturalEventIcon = L.icon({
    iconUrl: "/DECO1800-7180/public/assets/event-icons/ic_event.svg",
    iconSize: [ICON_EVENT_SIZE, ICON_EVENT_SIZE],
    iconAnchor: [ICON_EVENT_SIZE/2, ICON_EVENT_SIZE/2],
    popupAnchor: [0, 0],
});