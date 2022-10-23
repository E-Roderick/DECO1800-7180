<?php include("../components/header_default.php"); ?>

<?php
$STOPS = array(
    "610142" => [2481, 19050, 1960],
    "660047" => [1880, 10793, 19051],
    "1110001" => [10823, 10813, 10792],
    "2220001" => [6291, 3001, 10792],
    "4440002" => [10793, 4641, 19910],
    "P2060002" => [5902, 228, 3071],
);

$target = "610142";
?>

<main>
<section class="container">
    <article class="sub_page">
        <a href="#!" class="back_button"> &lt; Back</a>
    </article>
    <section class="wrapper main-features">
        <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_nearby_bus_stops.svg" alt="">
        <h4>SELECT A NEARBY 61 BUS STOP</h4>
        <div id="slider-wrapper">
        <div class="inner-wrapper">
            <!-- Stop lists -->
            <div class="overflow-wrapper">
                <div class="slide options" href="#">
                    <ul>
                    <?php

                    foreach ($STOPS[$target] as $stop) {
                        echo '<li>';
                        echo '<input type="radio" name="stop-select" id="stop'.$stop.'">';
                        echo '<label for="stop'.$stop.'">Roma Street busway Station</label>';
                        echo '<li>';
                    }
                    ?>

                    </ul>
                </div>
            </div>
        </div>
        </div>

        <input class="select_stop btn" type="submit" value="NEXT STEP">
    </section>
</section>
</main>

<?php include("../components/footer_default.php"); ?>