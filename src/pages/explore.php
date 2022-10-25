<?php include("../components/header_default.php"); ?>
<?php require_once("../components/nav.php"); ?>
<?php require_once("../util/route_data.php"); ?>

<?php $route = $_GET["route"]?>

<main class="explore-page">
<section class="container">
    <article id="map-help" class="flex-center">
        <h4>Exploration Tutorial</h4>
        <article id="tutorial-content">
            <section class="tutorial-step flex-col">
                <img src="/DECO1800-7180/public/assets/images/tute_1.jpeg">
                <h5>Step One</h5>
                <p>
                    Navigate the map using the keyboard or on screen controls.
                    To move forward, use 'W' or the button  labelled 'A'. To 
                    move backward use 'S' or the button labelled 'B'. To turn 
                    around use 'R' or the button labeled as labelled 'C'.
                </p>
            </section>
            <section class="tutorial-step flex-col">
                <img src="/DECO1800-7180/public/assets/images/tute_2.jpeg">
                <h5>Step Two</h5>
                <p>
                    Explore the map to find events. Events are markers on the
                    map, and come in two types. The Green markers represent a 
                    local cultural event, and the purple markers represent a
                    public art-piece.
                </p>
            </section>
            <section class="tutorial-step flex-col">
                <img src="/DECO1800-7180/public/assets/images/tute_3.jpeg">
                <h5>Step Three</h5>
                <p>
                    Click on an event to find more details. If you decide that 
                    you like the event, you can add the item to your inventory 
                    using the heart button.
                </p>
            </section>
        </article>
        <section id="tutorial-load-info">
            <p>The explore page is loading. This may take up to 30 seconds.</p>
            <button id="help-skip-btn" class="btn" onclick="helpSkipOnClick()" type="button" disabled>
                Loading...
            </button>
        </section>
    </article>

    <article class="sub_page" id="desktop">
        <?php DynamicBackButton() ?>
        <section class="sub_container">
            <img class="features_icon" src="/DECO1800-7180/public/assets/ui/icons/ic_outline_route_selection.svg" alt="">
            <h3 class="route_title">Route <span id="route_number"><?php echo $getRouteSignById($route)?></span></h3>
        </section>
        <article class="map_container" id="desktop">
            <svg viewBox="0 0 1240 572" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Game screen -->
                <rect width="1240" height="572" rx="64" fill="#D9D9D9"/>
                <rect x="160" y="20" width="928" height="532" rx="16" fill="#C3C3C3"/>
                <rect x="182" y="29" width="884" height="514" rx="8" fill="black"/>
                <rect x="190" y="37" width="868" height="498" fill="#C4C4C4"/>

                <!-- Draw the inventory icon... -->
                <a href="/DECO1800-7180/src/pages/inventory.php" id="ic_inventory">
                    <g>
                    <rect x="1133" y="130" width="62" height="22" rx="4" fill="black"/>
                    <path d="M1139 154H1189V184C1189 186.209 1187.21 188 1185 188H1143C1140.79 188 1139 186.209 1139 184V154Z" fill="black"/>
                    <path d="M1154 162H1174V169H1154V162Z" fill="#D9D9D9"/>
                    </g>
                </a>
                <!-- ...with inventory count -->
                <a href="/DECO1800-7180/src/pages/inventory.php" id="inventory_number">
                    <circle cx="1191" cy="131" r="17" fill="#FF2C52"/>
                    <foreignObject id="inv_count_text" x="1167" y="125" width="50" height="30">0</foreignObject>
                </a>

                <!-- Info button -->
                <a href="/DECO1800-7180/src/pages/information.php" id="ic_info">
                    <circle cx="1164" cy="414" r="31" fill="black"/>
                    <rect x="1160" y="398" width="8" height="8" fill="#D9D9D9"/>
                    <rect x="1160" y="410" width="8" height="20" fill="#D9D9D9"/>
                </a>

                <!-- CONTROLS -->
                <!-- Forward button -->
                <a id="ic_forward" class="game_btn">
                    <path d="M82.922 125.709C84.5215 123.781 87.4785 123.781 89.078 125.709L120.397 163.445C122.561 166.052 120.707 170 117.319 170H54.6808C51.2932 170 49.4393 166.052 51.6027 163.445L82.922 125.709Z" fill="black"/>
                </a>

                <!-- Change direction -->
                <a id="ic_rotate" class="game_btn">
                    <g>
                    <path d="M96.0632 298.558L110.86 299.991L108.028 314.584" stroke="black" stroke-width="9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M104.675 304.5C99.8253 309.146 93.246 312 86 312C71.0883 312 59 299.912 59 285C59 270.088 71.0883 258 86 258C97.942 258 108.073 265.753 111.635 276.5" stroke="black" stroke-width="9" stroke-linecap="square"/>
                    </g>
                </a>

                <!-- Backward button -->
                <a id="ic_backward" class="game_btn">
                    <path d="M89.078 446.291C87.4785 448.219 84.5215 448.219 82.922 446.291L51.6027 408.555C49.4393 405.948 51.2932 402 54.6807 402H117.319C120.707 402 122.561 405.948 120.397 408.555L89.078 446.291Z" fill="black"/>
                </a>

                <!-- Extra shapes for console style -->
                <rect opacity="0.1" x="109.543" y="517" width="29.832" height="29.832" rx="4" fill="black"/>
                <rect opacity="0.1" x="99.543" y="29.832" width="32.318" height="14.916" rx="4" fill="black"/>
            </svg>
            <!-- Container for the map -->
            <section id="map_desktop"></section>

            <!-- Container for collected events -->
            <section id="collection"></section>
        </article>
    </article>
    <article class="sub_page_mobile" id="mobile">
        <?php BackButton("/DECO1800-7180/src/pages/stops.php?route=".$route) ?>
        <article class="map_container_mobile">
            <!-- <h3 class="route_title">Route <span id="route_number"><?php echo $getRouteSignById($route)?></span></h3> -->
            <svg viewBox="0 0 1240 720" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Game screen -->
                <rect width="1240" height="698" rx="64" fill="#D9D9D9"/>
                <rect x="160" y="20" width="928" height="590" rx="16" fill="#C3C3C3"/>
                <rect x="182" y="29" width="884" height="565" rx="8" fill="black"/>
                <rect x="190" y="37" width="868" height="548" fill="#C4C4C4"/>

                <!-- Draw the inventory icon... -->
                <a href="/DECO1800-7180/src/pages/inventory.php" id="ic_inventory">
                    <g>
                    <rect x="1133" y="130" width="62" height="22" rx="4" fill="black"/>
                    <path d="M1139 154H1189V184C1189 186.209 1187.21 188 1185 188H1143C1140.79 188 1139 186.209 1139 184V154Z" fill="black"/>
                    <path d="M1154 162H1174V169H1154V162Z" fill="#D9D9D9"/>
                    </g>
                </a>
                <!-- ...with inventory count -->
                <a href="/DECO1800-7180/src/pages/inventory.php" id="inventory_number">
                    <circle cx="1191" cy="131" r="17" fill="#FF2C52"/>
                    <foreignObject id="inv_count_text_m" x="1167" y="125" width="50" height="30">0</foreignObject>
                </a>

                <!-- Info button -->
                <a href="/DECO1800-7180/src/pages/information.php" id="ic_info">
                    <circle cx="1164" cy="414" r="31" fill="black"/>
                    <rect x="1160" y="398" width="8" height="8" fill="#D9D9D9"/>
                    <rect x="1160" y="410" width="8" height="20" fill="#D9D9D9"/>
                </a>

                <!-- CONTROLS -->
                <!-- Forward button -->
                <a id="ic_forward_mobile" class="game_btn">
                    <path d="M82.922 125.709C84.5215 123.781 87.4785 123.781 89.078 125.709L120.397 163.445C122.561 166.052 120.707 170 117.319 170H54.6808C51.2932 170 49.4393 166.052 51.6027 163.445L82.922 125.709Z" fill="black"/>
                </a>

                <!-- Change direction -->
                <a id="ic_rotate_mobile" class="game_btn">
                    <g>
                    <path d="M96.0632 298.558L110.86 299.991L108.028 314.584" stroke="black" stroke-width="9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M104.675 304.5C99.8253 309.146 93.246 312 86 312C71.0883 312 59 299.912 59 285C59 270.088 71.0883 258 86 258C97.942 258 108.073 265.753 111.635 276.5" stroke="black" stroke-width="9" stroke-linecap="square"/>
                    </g>
                </a>

                <!-- Backward button -->
                <a id="ic_backward_mobile" class="game_btn">
                    <path d="M89.078 446.291C87.4785 448.219 84.5215 448.219 82.922 446.291L51.6027 408.555C49.4393 405.948 51.2932 402 54.6807 402H117.319C120.707 402 122.561 405.948 120.397 408.555L89.078 446.291Z" fill="black"/>
                </a>

                <!-- Extra shapes for console style -->
                <rect opacity="0.1" x="109.543" y="517" width="29.832" height="29.832" rx="4" fill="black"/>
                <rect opacity="0.1" x="99.543" y="29.832" width="32.318" height="14.916" rx="4" fill="black"/>
            </svg>
            <!-- Container for the map -->
            <section id="map_mobile"></section>

            <!-- Container for collected events -->
            <section id="collection"></section>
        </article>
    </article>
    <!-- <article class="wrapper main_features">
        
    </article> -->
</section>       
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script 
    src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" 
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" 
    crossorigin="">
</script>
<script src="/DECO1800-7180/src/js/package/leaflet.rotatedmarker.js"></script>
<script src="/DECO1800-7180/src/js/distance.js"></script>
<script src="/DECO1800-7180/src/js/map_icons.js"></script>
<script src="/DECO1800-7180/src/js/map.js"></script>
<script src="/DECO1800-7180/src/js/handle_routes.js"></script>
<script src="/DECO1800-7180/src/js/handle_data.js"></script>
<script src="/DECO1800-7180/src/js/handle_events.js"></script>
<script src="/DECO1800-7180/src/js/url.js"></script>
<script src="/DECO1800-7180/src/js/explore.js"></script>

<script>
    /* Detect mobile */
    let mobile = false;
    let oDiv1=document.getElementById("desktop");
    let oDiv2=document.getElementById("mobile");

    if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
        // Mobile device
        oDiv1.style.display = "none";
        oDiv2.style.display = "block";
        mobile = true;
    }else{
        // Desktop
        oDiv1.style.display = "block";
        oDiv2.style.display = "none";
    }

    /* Detect direction */ 
    if(window.innerHeight > window.innerWidth){
        alert("Please use Landscape!");
    }

    /* Main page logic */            
    $(window).on( "load", function() {
        doPageOperation();

        if (mobile) {
            // Stop displaying header/footer/back
            document.getElementsByClassName("back_button")[1].style.display = "none";
            document.getElementById("default-header").style.display = "none";
            document.getElementById("default-footer").style.display = "none";
        }
    });
</script>
<?php include("../components/footer_default.php"); ?>