/******************************************************************************
 * Functions and variables relating to the home page of the site              *
 ******************************************************************************/

/* Constants */
const HOME_HELP_TIP = "home_help"

/* Functions */

/**
 * Set the home help understood cookie to a particular value
 * @param {bool} value a bool indicating if the help has been accepted.
 */
function setHomeHelpCookie(value) {
  setCookie(HOME_HELP_TIP, value);
}

/**
 * Check if the user has accepted the home help.
 * @returns true if the home help has been accepted. False otherwise.
 */
function isHomeHelpUnderstood() {
  // Check if the home help tip value is like true
  console.log(getCookie(HOME_HELP_TIP));
  return getCookie(HOME_HELP_TIP) === "true";
}

/**
 * Add the accepted class to the home help popup
 */
function addHomeHelpAcceptedClass() {
  document.getElementById("welcome-tip").classList.add("accepted");
}

/**
 * Set the welcome tip on the home page to be accepted and not for future visits
 * using cookies.
 */
function setHomeHelpAccepted() {
  addHomeHelpAcceptedClass();
  setHomeHelpCookie(true);
  console.log(document.cookie)
}