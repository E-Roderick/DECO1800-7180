/******************************************************************************
 * Functions and variables relating to dealing with cookies                   *
 ******************************************************************************/

/* Functions */

/**
 * Set a cookie to a value.
 * @param {*} cookie The cookie to set/
 * @param {*} value The value to set for the cookie.
 */
function setCookie(cookie, value) {
  document.cookie = `${cookie}=${value}`;
}

/**
 * Gets a cookie value for a given cookie name.
 * @param {str} cookie the cookie to look for.
 * @returns The cookie value or null if not found.
 */
function getCookie(cookie) {
  const cookies = document.cookie.split(';');
  // Split each cookie into key value and search for the target

  const result =  cookies.map(_cookie => _cookie.split('='))
    .filter(_cookie => _cookie[0] === cookie);
  
  // Pull item out of array, then return value
  return result && result[0] ? result[0][1] : null;
}