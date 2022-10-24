/******************************************************************************
 * Numerical functions for distance and angles.                               *
 ******************************************************************************/

function degreesToRadians(degrees) {
    return degrees * Math.PI / 180;
}

function radiansToDegrees(rads) {
    return rads * 180 / Math.PI;
}

function distanceInKmBetweenCoords(lat1, lon1, lat2, lon2) {
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

function angleBetweenCoordinates(coord1, coord2) {
    const [lat1, lon1] = coord1;
    const [lat2, lon2] = coord2;

    const dy = lon2 - lon1;
    // Convert lat/lon into appropriate x coordinate
    const x = Math.cos(lat2) * Math.sin(dy);
    const y = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(dy)
    //const dx = Math.cos(degreesToRadians(lon1)) * (lat2 - lat1);

    return radiansToDegrees(Math.atan2(y, x));
}

/**
 * Invert an angle as in rotate it 180 degrees.
 * @param {*} angle the reference angle.
 * @returns A wrapped, inverted angle.
 */
const invertAngle = angle => (angle + 180) % 360;