<?php require_once("../util/events.php") ?>

<?php include("../components/header.php"); ?>

    <main class="explore-page">
        <!-- Container for the map -->
        <section id="map"></section>
        
        <!-- Grab events data from Brisbane Events API -->
        <script> var updatedEvents = <?php echo(getEventData()); ?>; </script>

        <!-- Container for collected events -->
        <section id="collection">
            <figure>
                <p>Hello</p>
            </figure>
        </section>
    
    </main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="/site/src/js/map.js"></script>
    <script src="/site/src/js/distance.js"></script>
    <script src="/site/src/js/events.js"></script>
    <script src="/site/src/js/handle_file.js"></script>

<?php include("../components/footer.php"); ?>