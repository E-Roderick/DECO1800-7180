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
        <div class="item" style="display: block;">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa, vero voluptatibus earum enim maxime distinctio, velit cupiditate iure ex fugiat adipisci voluptatem reiciendis dolore veniam voluptas harum recusandae magnam aliquam.
        </div>
        <div class="item" style="display: none;">
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

        </div>
        <div class="item" style="display: none;">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis corrupti pariatur nihil, ex ipsam eos aspernatur ratione asperiores doloribus ad impedit in distinctio modi, dolorem consequatur nostrum laudantium eligendi repellendus.
        </div>
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

