<?php include("../components/header_default.php"); ?>

<?php
require_once("../util/stop_data.php");

$STOPS = array(
    "610142" => [2481, 19050, 1960],
    "660047" => [1880, 10793, 19051],
    "1110001" => [10823, 10813, 10792],
    "2220001" => [6291, 3001, 10792],
    "4440002" => [10793, 4641, 19910],
    "P2060002" => [5902, 228, 3071],
);

$target = "610142";

$STOP_DATA = json_decode(getStopData($target));
?>

<main>
<section class="container">
    <article class="sub_page">
        <a href="#!" class="back_button"> &lt; Back</a>
    </article>
    <form class="wrapper main-features" id="stop-select-form">
        <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_nearby_bus_stops.svg" alt="">
        <h4>SELECT A BUS STOP ALONG ROUTE 61</h4>
        <div id="slider-wrapper">
        <div class="inner-wrapper">
            <!-- Stop lists -->
            <div class="overflow-wrapper">
                <div class="slide options" href="#">
                    <ul>
                    <?php

                    foreach ($STOPS[$target] as $stop) {
                        $stop = getStopInfoByID($STOP_DATA, $stop);
                        echo '<li>';
                        echo '<input type="radio" name="stop-select" id="'.$stop[0].'">';
                        echo '<label for="'.$stop[0].'">'.$stop[2].'</label>';
                        echo '<li>';
                    }

                    ?>
                    </ul>
                </div>
            </div>
        </div>
        </div>

        <input class="select_stop btn" type="submit" value="NEXT STEP">
    </form>
</section>
</main>

<script>
    document.getElementById("stop-select-form").onsubmit = event => {
        // Cancel immediate submission
        event.preventDefault();

        // Get new page location
        const route = <?php echo $target; ?>;
        const sel = document.querySelector('input[name="stop-select"]:checked');
        const url = `/DECO1800-7180/src/pages/explore.php?route=${route}&stop=${sel.id}`;

        if (sel.id != "none") {
            // Route to new page
            window.location.href = url
        }
    };
</script>

<?php include("../components/footer_default.php"); ?>