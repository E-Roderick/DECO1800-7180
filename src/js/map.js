// Globally store the map
let map;

function createMap() {
    map = L.map("map").setView([-27.491457, 153.102629], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
        attribution: '© OpenStreetMap'
    }).addTo(map);
}

function handleMapLoad() {
    $("#help-skip-btn").prop("disabled", false); // Enable button
    $("#help-skip-btn").text("Skip Tutorial"); // Update text
}

function helpSkipOnClick() {
    $("#map-help").addClass("complete");
}