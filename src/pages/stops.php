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
            <!-- Selection buttons -->
            <input checked type="radio" name="slide" class="control" id="Slide1" />
            <label for="Slide1" id="s1"></label>
            <input type="radio" name="slide" class="control" id="Slide2" />
            <label for="Slide2" id="s2"></label>
            <input type="radio" name="slide" class="control" id="Slide3" />
            <label for="Slide3" id="s3"></label>
            <input type="radio" name="slide" class="control" id="Slide4" />
            <label for="Slide4" id="s4"></label>

            <!-- Stop lists -->
            <div class="overflow-wrapper">
                <div class="slide options" href="#">
                    <input type="radio" name="stop-select" id="stop1">
                    <label for="stop1">Roma Street busway Station</label>
                </div>
                <div class="slide" href="#">
                    <ul>
                    <li><a href="#">Roma  Street Busway Station</a></li>
                    <li><a href="#">King George Square Station</a></li>
                    <li><a href="#">Cultural Centre Station</a></li>
                    <li><a href="#">South Bank busway Station</a></li>
                    <li><a href="#">Mater Hill Station</a></li>
                    </ul>
                </div>
                <div class="slide" href="#">
                    <ul>
                    <li><a href="#">Roma  Street Busway Station</a></li>
                    <li><a href="#">King George Square Station</a></li>
                    <li><a href="#">Cultural Centre Station</a></li>
                    <li><a href="#">South Bank busway Station</a></li>
                    <li><a href="#">Mater Hill Station</a></li>
                    </ul>
                </div>
                <div class="slide" href="#">
                    <ul>
                    <li><a href="#">Roma  Street Busway Station</a></li>
                    <li><a href="#">King George Square Station</a></li>
                    <li><a href="#">Cultural Centre Station</a></li>
                    <li><a href="#">South Bank busway Station</a></li>
                    <li><a href="#">Mater Hill Station</a></li>
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