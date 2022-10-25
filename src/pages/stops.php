<?php include("../components/header_default.php"); ?>

<?php
require_once("../util/stop_data.php");
require_once("../util/route_data.php");
require_once("../components/nav.php");

$STOPS = array(
    "610142" => [2481, 19050, 1960],
    "660047" => [1880, 10793, 19051],
    "1110001" => [10823, 10813, 10792],
    "2220001" => [6291, 3001, 10792],
    "4440002" => [10793, 4641, 19910],
    "P2060002" => [5902, 228, 3071],
);

$target = $_GET["route"];

$STOP_DATA = getStopData($target);
?>

<main id="desktop">
<section class="container">
    <?php BackButton("/DECO1800-7180/src/pages/routes.php") ?>
    <form class="wrapper main-features" id="stop-select-form">
        <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_nearby_bus_stops.svg" alt="">
        <h4>SELECT A BUS STOP ALONG ROUTE <?php echo $getRouteSignById($target)?></h4>
        <div id="slider-wrapper">
        <div class="inner-wrapper">
            <!-- Stop lists -->
            <div class="overflow-wrapper">
                <div class="slide options" href="#">
                    <ul>
                    <?php

                    // Load each stop as a list item radio button
                    foreach ($STOPS[$target] as $stop) {
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
<main id="mobile">
<section class="container">
    <?php BackButton("/DECO1800-7180/src/pages/routes.php") ?>
    <form class="wrapper main-features" id="stop-select-form">
        <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_nearby_bus_stops.svg" alt="">
        <h4>SELECT A BUS STOP ALONG ROUTE <?php echo $getRouteSignById($target)?></h4>
        <div id="slider-wrapper">
        <div class="stop-inner-wrapper">
            <!-- Stop lists -->
            <div class="overflow-wrapper">
                <div id="slide-mobile" class="slide options" href="#">
                    <ul>
                    <?php

                    // Load each stop as a list item radio button
                    foreach ($STOPS[$target] as $stop) {
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
        const route = "<?php echo $target; ?>";
        const sel = document.querySelector('input[name="stop-select"]:checked');

        if (sel && sel.id != "none") {
            const url = `/DECO1800-7180/src/pages/explore.php?route=${route}&stop=${sel.id}`;
            // Route to new page
            window.location.href = url
        }
    };
    var oDiv1=document.getElementById("desktop");
    var oDiv2=document.getElementById("mobile");
    
    if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
    //Mobile device
        oDiv1.style.display="none";
        oDiv2.style.display="block";
        }else{
        oDiv1.style.display="block";
        oDiv2.style.display="none";
    }
</script>

<?php include("../components/footer_default.php"); ?>