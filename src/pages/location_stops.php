<?php include("../components/header_default.php"); ?>

<?php
require_once("../util/stop_data.php");
require_once("../util/route_data.php");
require_once("../components/nav.php");

/* Hardcoding stop data for now */
// Specify three stops along route 66 closest to expo location
$STOPS = [1880, 18055];
// Get stop data for route 66
$STOP_DATA = getStopData("660047");

?>

<main>
<section class="container">
    <?php BackButton("/DECO1800-7180/src/pages/routes.php") ?>
    <form class="wrapper main-features" id="stop-select-form">
        <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_nearby_bus_stops.svg" alt="">
        <h4>SELECT A BUS STOP NEAR YOUR CURRENT LOCATION</h4>
        <div id="slider-wrapper">
        <div class="inner-wrapper">
            <!-- Stop lists -->
            <div class="overflow-wrapper">
                <div class="slide options" href="#">
                    <ul>
                    <?php

                    // Load each stop as a list item radio button
                    foreach ($STOPS as $stop) {
                        $stop = getStopInfoByID($STOP_DATA, $stop);
                        echo '<li class="flex-center">';
                        echo '<input type="radio" name="stop-select" id="'.$stop[0].'">';
                        echo '<label for="'.$stop[0].'" class="flex-center">'.$stop[2].'</label>';
                        echo '</li>';
                    }

                    ?>
                    </ul>
                </div>
            </div>
        </div>
        </div>

        <input class="select_stop btn" type="submit" value="NEXT STEP" disabled>
    </form>
</section>
</main>

<script>
    let form = document.getElementById("stop-select-form");

    // Handle form changing
    form.addEventListener('change', ()=> {
        form.querySelector('input[type="submit"]').disabled = false;
    });

    // Handle form submission
    form.onsubmit = event => {
        // Cancel immediate submission
        event.preventDefault();

        // Get new page location
        const sel = document.querySelector('input[name="stop-select"]:checked');

        if (sel && sel.id != "none") {
            const url = `/DECO1800-7180/src/pages/location-routes.php?stop=${sel.id}`;
            // Route to new page
            window.location.href = url
        }
    };
</script>

<?php include("../components/footer_default.php"); ?>