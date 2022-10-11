<?php
    // Don't need a header on this page, so only include bare HTML information
    include("../components/html_pre.php"); 
    // Need to include </head> and <body> tag now that header is not included 
?>

<!-- Stylesheets -->
<link rel='stylesheet' href='/DECO1800-7180/styles/map.css' />

</head>
    <body>
        <main class="explore-page">
            <article id="map-help" class="flex-center flex-col">
                <h2>The Explore Page is Loading</h2>
                <p>Please wait while the explore page loads...</p>
                <button id="help-skip-btn" onclick="helpSkipOnClick()" type="button" disabled>
                    Loading...
                </button>
            </article>

            <!-- Container for the map -->
            <section id="map"></section>

            <!-- Container for collected events -->
            <section id="collection"></section>
        
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
        <script src="/DECO1800-7180/src/js/url.js"></script> -->
        
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
                if (eventData != "null" && updatedEvents != "null") {
                    console.log("Source: localStorage");
                    // Load busline data from server
                    getServerRouteData(route);
                } else {
                    console.log("Source: API");
                    $.when(get_remote_data_events(), getServerEventData()).done(function() {
                        // Load busline data from server
                        getServerRouteData(route);
                    });
                }
            });
        </script>
    </body>

<?php include("../components/html_post.php"); ?>