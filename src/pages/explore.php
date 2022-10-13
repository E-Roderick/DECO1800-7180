<?php include("../components/header_default.php"); ?>
<main class="explore-page">
<section class="container">
    <article id="map-help" class="flex-center flex-col">
        <h2>The Explore Page is Loading</h2>
        <p>Please wait while the explore page loads...</p>
        <button id="help-skip-btn" onclick="helpSkipOnClick()" type="button" disabled>
            Loading...
        </button>
    </article>

    <article class="sub_page">
        <a href="./routes.php" class="back_button"> &lt; Back</a>
        <section class="sub_container">
            <img class="features_icon" src="/DECO1800-7180/public/assets/images/ic_outline_route_selection.svg" alt="">
            <h3 class="route_title">Route <dfn id="route_number">61</dfn></h3>
        </section>
        <article class="map_container">
            <svg viewBox="0 0 1240 572" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="1240" height="572" rx="64" fill="#D9D9D9"/>
                <rect opacity="0.1" x="160" y="20" width="928" height="532" rx="16" fill="black"/>
                <rect x="182" y="29" width="884" height="514" rx="8" fill="black"/>
                <rect x="190" y="37" width="868" height="498" fill="#C4C4C4"/>
                <path opacity="0.1" d="M1148.8 130C1146.59 130 1144.8 131.791 1144.8 134V150.8H1128C1125.79 150.8 1124 152.591 1124 154.8V169.2C1124 171.409 1125.79 173.2 1128 173.2H1144.8V190C1144.8 192.209 1146.59 194 1148.8 194H1163.2C1165.41 194 1167.2 192.209 1167.2 190V173.2H1184C1186.21 173.2 1188 171.409 1188 169.2V154.8C1188 152.591 1186.21 150.8 1184 150.8H1167.2V134C1167.2 131.791 1165.41 130 1163.2 130H1148.8Z" fill="black"/>
                <rect opacity="0.1" x="109.543" y="517" width="29.832" height="29.832" rx="4" fill="black"/>
                <path d="M1160 389V397H1152V389H1160Z" fill="#C3C3C3"/>
                <path d="M1160 421V401H1152V421H1160Z" fill="#C3C3C3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1156 437C1173.67 437 1188 422.673 1188 405C1188 387.327 1173.67 373 1156 373C1138.33 373 1124 387.327 1124 405C1124 422.673 1138.33 437 1156 437ZM1156 381C1142.75 381 1132 391.745 1132 405C1132 418.255 1142.75 429 1156 429C1169.25 429 1180 418.255 1180 405C1180 391.745 1169.25 381 1156 381Z" fill="#C3C3C3"/>
                <rect opacity="0.1" x="99.543" y="29.832" width="32.318" height="14.916" rx="4" fill="black"/>
                <path opacity="0.1" d="M82.922 185.709C84.5215 183.781 87.4785 183.781 89.078 185.709L120.397 223.445C122.561 226.052 120.707 230 117.319 230H54.6808C51.2932 230 49.4393 226.052 51.6027 223.445L82.922 185.709Z" fill="black"/>
                <path opacity="0.1" d="M89.078 386.291C87.4785 388.219 84.5215 388.219 82.922 386.291L51.6027 348.555C49.4393 345.948 51.2932 342 54.6807 342H117.319C120.707 342 122.561 345.948 120.397 348.555L89.078 386.291Z" fill="black"/>
            </svg>
            <!-- Container for the map -->
            <section id="map"></section>

            <!-- Container for collected events -->
            <section id="collection"></section>
        </article>

    </article>
    <!-- <article class="wrapper main_features">
        
    </article> -->
</section>       
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script 
    src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" 
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" 
    crossorigin="">
</script>
<script src="/DECO1800-7180/src/js/map.js"></script>
<script src="/DECO1800-7180/src/js/distance.js"></script>
<script src="/DECO1800-7180/src/js/handle_file.js"></script>
<script src="/DECO1800-7180/src/js/events.js"></script>
<script src="/DECO1800-7180/src/js/url.js"></script>

<script>
    /* Main page logic */            
    $( window ).on( "load", function() {              
        // Create the map and load tiles
        createMap();

        // Load event data
        // TODO Combine the get local and get remote into one get call
        // TODO Neaten up all functions and naming
        eventData = get_local_data_events(LS_EVENT_DATA);
        updatedEvents = get_local_data_events(LS_UPDATE_EVENT_DATA);

        const route = getUrlParam(window.location.href, "route");
        if (eventData && updatedEvents) {
            console.log("Source: localStorage");
            // Load busline data from server
            console.log(route);
            getServerRouteData(route);
        } else {
            console.log("Source: API");
            $.when(get_remote_data_events(), getServerEventData()).done(function() {
                // Load busline data from server
                console.log(route);
                getServerRouteData(route);
            });
        }
    });
</script>
<?php include("../components/footer_default.php"); ?>