<?php include("../components/header_default.php"); ?>
<main id ='desktop'>
<section class="container">
    <section class="wrapper about-sec">
    <div class="tab-list">
    <h2>ABOUT OBERON</h2>
        <ul>
            <li class="current"><a href="#team">Team Member</a></li>
            <li><a href="#concepts">Concepts</a></li>
            <li><a href="#references">References</a></li>
        </ul>
        <img src="/DECO1800-7180/public/assets/avatar/ic_car.png" alt="">
        <img src="/DECO1800-7180/public/assets/avatar/ic_car-1.png" alt="">
        <img src="/DECO1800-7180/public/assets/avatar/ic_car-2.png" alt="">
        <img src="/DECO1800-7180/public/assets/avatar/ic_car-3.png" alt="">
    </div>
    <div class="tab-content">
        <article id="about-team" class="item" style="display: block;">
            <h4>- Ethan Roderick</h4>
            <h4>- Karell Usang</h4>
            <h4>- Shuo Liu</h4>
            <h4>- Yu-Hsuan Wu</h4>
            <h4>- Yen-Chen Chen</h4>
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
            <section id="about-ref-data">
                <h5>Datasets:</h5>
                <ul>
                    <li class="ref-item">
                        <span>General transit feed specification (GTFS)—South East Queensland, TransLink </span>
                        <a href="https://www.data.qld.gov.au/dataset/general-transit-feed-specification-gtfs-seq">https://www.data.qld.gov.au/dataset/general-transit-feed-specification-gtfs-seq</a>
                    </li>
                    <li class="ref-item">
                        <span>“Public Art Collection - Public Art Collection — CSV - Data | Brisbane City Council,” Queensland Government </span>
                        <a href="https://www.data.brisbane.qld.gov.au/data/dataset/public-art/resource/3c972b8e-9340-4b6d-8c7b-2ed988aa3343">https://www.data.brisbane.qld.gov.au/data/dataset/public-art/resource/3c972b8e-9340-4b6d-8c7b-2ed988aa3343</a>
                    </li>
                    <li class="ref-item">
                        <span>Trumba.com, 2022. </span>
                        <a href="http://www.trumba.com/calendars/brisbane-city-council.json">http://www.trumba.com/calendars/brisbane-city-council.json</a>
                    </li>
                </ul>
            </section>
            <section id="about-ref-refs">
                <h5>References:</h5>
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
                        <span>Zeratax (2017) gimages [Source code]. </span>
                        <a href="https://gist.github.com/zeratax/a0719af17fdf8d338f8fdd6601f90a36">https://gist.github.com/zeratax/a0719af17fdf8d338f8fdd6601f90a36</a>
                    </li>
                </ul>
            </section>
        </article>
    </div>
    </section>
</section>
</main>
<main id='mobile'>
    <section class="container-about">
        <section class="about-sec-mobile">
        <div class="tab-list-mobile">
        <h2>ABOUT OBERON</h2>
            <ul>
                <li class="current" style="display:none;"><a href="#">Team Member</a></li>
                <li><a href="#" style="display:none;">Concepts</a></li>
                <li><a href="#" style="display:none;">References</a></li>
                <a href=#><li class="current">Team Member</li></a>
                <a href=#><li>Concepts</li></a>
                <a href=#><li>References</li></a>
            </ul>
        </div>
        <div class="tab-content-mobile">
            <article class="item" style="display: block;">
            <br>
            <br>
            - Ethan Roderick<br>
            - Karell Usang<br>
            - Shuo Liu<br>
            - Yu-Hsuan Wu<br>
            - Yen-Chen Chen
            </article>
            <article class="item" style="display: none;">
                <h5>Purpose of the application:</h5>
                <p>City Mario is a web application that aims to help tourists discover Brisbane's cultural 
                experience and art collection by providing a fun and informative interface. City Mario 
                will display to users nearby events and public arts based on the location of their car 
                icons. Car icons follow the bus routes chosen by users. With a computer, tourists can 
                access the web app and use it as an enjoyable research tool before heading out in person.</p><br>

                <h5>Assumptions:</h5>
                <p>We assumed that tourists don't know much about Brisbane public transport and bus routes, 
                which is why our app wants to provide bus route recommendations based on the tourist's 
                location. However, due to time constraints, our priority for this assignment is to allow 
                users to input the bus route number of interest.</p><br>
                
                <h5>Disclaimers:</h5>
                <p>We have no control over the correctness of the information provided for events, bus routes 
                and public arts by the datasets used.Images for public arts are automatically retrieved 
                from Google Images. It is possible that the image does not match the public art in question.</p><br>
                
                <h5>Standpoints:</h5>
                <p>We chose and designed our features to be implemented as a middle-ground between what our 
                target audience needs and what we can deliver in the timeframe we are given.</p>

            </article>
            <article class="item" style="display: none;">
               <section>
                    <h5>Datasets:</h5>
                    <ul>
                        <li>
                            <span>General transit feed specification (GTFS)—South East Queensland, TransLink </span>
                            <a href="https://www.data.qld.gov.au/dataset/general-transit-feed-specification-gtfs-seq">https://www.data.qld.gov.au/dataset/general-transit-feed-specification-gtfs-seq</a>
                        </li>
                        <li>
                            <span>“Public Art Collection - Public Art Collection — CSV - Data | Brisbane City Council,” Queensland Government </span>
                            <a href="https://www.data.brisbane.qld.gov.au/data/dataset/public-art/resource/3c972b8e-9340-4b6d-8c7b-2ed988aa3343">https://www.data.brisbane.qld.gov.au/data/dataset/public-art/resource/3c972b8e-9340-4b6d-8c7b-2ed988aa3343</a>
                        </li>
                        <li>
                            <span>Trumba.com, 2022. </span>
                            <a href="http://www.trumba.com/calendars/brisbane-city-council.json">http://www.trumba.com/calendars/brisbane-city-council.json</a>
                        </li>
                    </ul>
                </section><br>
                <section>
                    <h5>References:</h5>
                    <ul>
                        <li>
                            <span>Bbecquet (2018) Leaflet.RotatedMarker [Source code]. </span>
                            <a href="https://github.com/bbecquet/Leaflet.RotatedMarker">https://github.com/bbecquet/Leaflet.RotatedMarker</a>
                        </li>
                        <li>
                            <span>C. Boisclair, Press Start 2P. 2011. Accessed: Oct. 22, 2022. [Font]. Available: </span>
                            <a href="https://fonts.google.com/specimen/Press+Start+2P">https://fonts.google.com/specimen/Press+Start+2P</a>
                        </li>
                        <li>
                            <span>D. E. Research, “Calculating the Bearing between two geospatial coordinates,” Medium, May 25, 2020. </span>
                            <a href="https://towardsdatascience.com/calculating-the-bearing-between-two-geospatial-coordinates-66203f57e4b4">https://towardsdatascience.com/calculating-the-bearing-between-two-geospatial-coordinates-66203f57e4b4</a>
                            <span> (accessed Oct. 24, 2022).</span>
                        </li>
                        <li>
                            <span>“Leaflet — an open-source JavaScript library for interactive maps,” leafletjs.com. </span>
                            <a href="https://leafletjs.com/index.html">https://leafletjs.com/index.html</a>
                        </li>
                        <li>
                            <span>Zeratax (2017) gimages [Source code]. </span>
                            <a href="https://gist.github.com/zeratax/a0719af17fdf8d338f8fdd6601f90a36">https://gist.github.com/zeratax/a0719af17fdf8d338f8fdd6601f90a36</a>
                        </li>
                    </ul>
                </section>
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
    var tab_list_mobile = document.querySelector('.tab-list-mobile');
        var list_mobile = tab_list_mobile.querySelectorAll('a');
        var items_mobile = document.querySelectorAll('.item');

        for (var i = 0; i < list_mobile.length; i++) {
            list_mobile[i].setAttribute('index',i);
            list_mobile[i].addEventListener('touchend', function() {
                for (var i = 0; i < list_mobile.length; i++) {
                    list_mobile[i].className = '';
                }
                this.className = 'current';
                var index = this.getAttribute('index');
                for (var i = 0; i < items_mobile.length; i++) {
                    items_mobile[i].style.display = 'none';
                }
                items_mobile[index].style.display = 'block';
            }
        )}
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

