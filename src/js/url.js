const PARAM_START = '?';

function urlToObj(url) {
    let params = url.split(PARAM_START)[1];
    params = params.replace(/&/g, '","').replace(/=/g, '":"');
    return JSON.parse(`{"${params}"}`);
}

function getUrlParam(url, target) {
    return urlToObj(url)[target];
} 