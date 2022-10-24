<?php include("../components/header_default.php"); ?>
<main>
<section class="container">
    <section class="wrapper about-sec">
    <div class="tab-list">
    <h2>ABOUT OBERON</h2>
        <ul>
            <li class="current"><a href="#">Team Member</a></li>
            <li><a href="#">Concepts</a></li>
            <li><a href="#">References</a></li>
        </ul>
        <img src="/DECO1800-7180/public/assets/avatar/ic_car.png" alt="">
        <img src="/DECO1800-7180/public/assets/avatar/ic_car-1.png" alt="">
        <img src="/DECO1800-7180/public/assets/avatar/ic_car-2.png" alt="">
        <img src="/DECO1800-7180/public/assets/avatar/ic_car-3.png" alt="">
    </div>
    <div class="tab-content">
        <article id="about-team" class="item" style="display: block;">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa, vero voluptatibus earum enim maxime distinctio, velit cupiditate iure ex fugiat adipisci voluptatem reiciendis dolore veniam voluptas harum recusandae magnam aliquam.
        </article>
        <article id="about-concept" class="item" style="display: none;">
            <h5>Purpose of the application:</h5><br>
            <p>City Mario is a web application that aims to help tourists discover Brisbane's cultural 
            experience and art collection by providing a fun and informative interface. City Mario 
            will display to users nearby events and public arts based on the location of their car 
            icons. Car icons follow the bus routes chosen by users. With a computer, tourists can 
            access the web app and use it as an enjoyable research tool before heading out in person.</p><br>

            <h5>Assumptions:</h5><br>
            <p>We assumed that tourists don't know much about Brisbane public transport and bus routes, 
            which is why our app wants to provide bus route recommendations based on the tourist's 
            location. However, due to time constraints, our priority for this assignment is to allow 
            users to input the bus route number of interest.</p><br>
            
            <h5>Disclaimers:</h5><br>
            <p>We have no control over the correctness of the information provided for events, bus routes 
            and public arts by the datasets used.Images for public arts are automatically retrieved 
            from Google Images. It is possible that the image does not match the public art in question.</p><br>
            
            <h5>Standpoints:</h5><br>
            <p>We chose and designed our features to be implemented as a middle-ground between what our 
            target audience needs and what we can deliver in the timeframe we are given.</p>

        </article>
        <article id="about-ref" class="item" style="display: none;">
            <ul>
                <li class="ref-item">
                    <span>Bbecquet (2018) Leaflet.RotatedMarker [Source code]. </span>
                    <a href="https://github.com/bbecquet/Leaflet.RotatedMarker">https://github.com/bbecquet/Leaflet.RotatedMarker</a>
                </li>
                <li class="ref-item">
                    <span>C. Boisclair, Press Start 2P. 2011. Accessed: Oct. 22, 2022. [Font]. Available: </span>
                    <a href="https://fonts.google.com/specimen/Press+Start+2P">https://fonts.google.com/specimen/Press+Start+2P</a>
                </li>
                <li class="ref-item">
                    <span>D. E. Research, “Calculating the Bearing between two geospatial coordinates,” Medium, May 25, 2020. </span>
                    <a href="https://towardsdatascience.com/calculating-the-bearing-between-two-geospatial-coordinates-66203f57e4b4">https://towardsdatascience.com/calculating-the-bearing-between-two-geospatial-coordinates-66203f57e4b4</a>
                    <span> (accessed Oct. 24, 2022).</span>
                </li>
                <li class="ref-item">
                    <span>“Leaflet — an open-source JavaScript library for interactive maps,” leafletjs.com. </span>
                    <a href="https://leafletjs.com/index.html">https://leafletjs.com/index.html</a>
                </li>
                <li class="ref-item">
                    <span>“Public Art Collection - Public Art Collection — CSV - Data | Brisbane City Council,” Queensland Government </span>
                    <a href="https://www.data.brisbane.qld.gov.au/data/dataset/public-art/resource/3c972b8e-9340-4b6d-8c7b-2ed988aa3343">https://www.data.brisbane.qld.gov.au/data/dataset/public-art/resource/3c972b8e-9340-4b6d-8c7b-2ed988aa3343</a>
                </li>
                <li class="ref-item">
                    <span>Trumba.com, 2022. </span>
                    <a href="http://www.trumba.com/calendars/brisbane-city-council.json">http://www.trumba.com/calendars/brisbane-city-council.json</a>
                    <span> (accessed Oct. 24, 2022)</span>
                </li>
                <li class="ref-item">
                    <span>Zeratax (2017) gimages [Source code]. </span>
                    <a href="https://gist.github.com/zeratax/a0719af17fdf8d338f8fdd6601f90a36">https://gist.github.com/zeratax/a0719af17fdf8d338f8fdd6601f90a36</a>
                </li>
            </ul>
        </article>
    </div>
    </section>
</section>
</main>
<script>
    var tab_list = document.querySelector('.tab-list');
    var list = tab_list.querySelectorAll('li');
    var items = document.querySelectorAll('.item');

    for (var i = 0; i < list.length; i++) {
        list[i].setAttribute('index',i);
        list[i].onclick = function() {
            for (var i = 0; i < list.length; i++) {
                list[i].className = '';
            }
            this.className = 'current';
            var index = this.getAttribute('index');
            for (var i = 0; i < items.length; i++) {
                items[i].style.display = 'none';
            }
            items[index].style.display = 'block';
        }
    }
    
    </script> 
<?php include("../components/footer_default.php"); ?>

