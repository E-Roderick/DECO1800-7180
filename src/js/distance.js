function degreesToRadians(degrees) {
    return degrees * Math.PI / 180;
}

function radiansToDegrees(rads) {
    return rads * 180 / Math.PI;
}

function distanceInKmBetweenEarthCoordinates(lat1, lon1, lat2, lon2) {
    var earthRadiusKm = 6371;

    var dLat = degreesToRadians(lat2 - lat1);
    var dLon = degreesToRadians(lon2 - lon1);

    lat1 = degreesToRadians(lat1);
    lat2 = degreesToRadians(lat2);

    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return earthRadiusKm * c;
}

/**
 * This is not strictly accurate, but assuming a flat Euclidean plane it's fine.
 * 
 */
function angleBetweenCoordinates(coord1, coord2) {
    console.log(coord2);
    const [lat1, lon1] = coord1;
    const [lat2, lon2] = coord2;

    const dy = lon2 - lon1;
    // Convert lat/lon into appropriate x coordinate
    const dx = Math.cos(degreesToRadians(lon1)) * (lat2 - lat1);

    return radiansToDegrees(Math.atan(dx / dy));
}