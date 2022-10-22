<?php include("../components/header_default.php"); ?>
<main class="explore-page">
<section class="container">
    <article id="map-help" class="flex-center flex-col">
        <h2>The Explore Page is Loading</h2>
        <p>Please wait while the explore page loads...</p>
        <button id="help-skip-btn" onclick="helpSkipOnClick()" type="button" disabled>
            Loading...
        </button>
    </article>

    <article class="sub_page">
        <a href="javascript:history.back()" class="back_button"> &lt; Back</a>
        <section class="sub_container">
            <img class="features_icon" src="/DECO1800-7180/public/assets/ui/icons/ic_outline_route_selection.svg" alt="">
            <h3 class="route_title">Route <dfn id="route_number">61</dfn></h3>
        </section>
        <article class="map_container">
            <svg viewBox="0 0 1240 572" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Game screen -->
                <rect width="1240" height="572" rx="64" fill="#D9D9D9"/>
                <rect x="160" y="20" width="928" height="532" rx="16" fill="#C3C3C3"/>
                <rect x="182" y="29" width="884" height="514" rx="8" fill="black"/>
                <rect x="190" y="37" width="868" height="498" fill="#C4C4C4"/>

                <!-- Draw the inventory icon... -->
                <a href="#!" id="ic_inventory">
                    <g>
                    <rect x="1133" y="130" width="62" height="22" rx="4" fill="black"/>
                    <path d="M1139 154H1189V184C1189 186.209 1187.21 188 1185 188H1143C1140.79 188 1139 186.209 1139 184V154Z" fill="black"/>
                    <path d="M1154 162H1174V169H1154V162Z" fill="#D9D9D9"/>
                    </g>
                </a>
                <!-- ...with inventory count -->
                <a href="#!" id="" id="inventory_number">
                    <circle cx="1191" cy="131" r="17" fill="#FF2C52"/>
                    <path d="M1195.31 130.529V132.621C1195.31 133.623 1195.21 134.479 1195.01 135.188C1194.82 135.891 1194.53 136.462 1194.17 136.901C1193.8 137.341 1193.35 137.663 1192.84 137.868C1192.33 138.073 1191.76 138.176 1191.12 138.176C1190.62 138.176 1190.15 138.111 1189.72 137.982C1189.29 137.854 1188.9 137.651 1188.56 137.376C1188.21 137.101 1187.92 136.746 1187.67 136.312C1187.43 135.873 1187.24 135.349 1187.11 134.739C1186.98 134.13 1186.91 133.424 1186.91 132.621V130.529C1186.91 129.521 1187.01 128.672 1187.21 127.98C1187.41 127.283 1187.7 126.718 1188.07 126.284C1188.43 125.845 1188.87 125.525 1189.38 125.326C1189.9 125.127 1190.47 125.027 1191.11 125.027C1191.62 125.027 1192.08 125.092 1192.51 125.221C1192.95 125.344 1193.33 125.54 1193.67 125.81C1194.02 126.079 1194.31 126.431 1194.55 126.864C1194.8 127.292 1194.99 127.811 1195.11 128.42C1195.24 129.023 1195.31 129.727 1195.31 130.529ZM1193.19 132.92V130.213C1193.19 129.703 1193.16 129.255 1193.1 128.868C1193.04 128.476 1192.96 128.145 1192.84 127.875C1192.73 127.6 1192.59 127.377 1192.42 127.207C1192.25 127.031 1192.05 126.905 1191.84 126.829C1191.62 126.747 1191.38 126.706 1191.11 126.706C1190.78 126.706 1190.49 126.771 1190.23 126.899C1189.97 127.022 1189.75 127.222 1189.58 127.497C1189.4 127.772 1189.27 128.136 1189.17 128.587C1189.08 129.032 1189.04 129.574 1189.04 130.213V132.92C1189.04 133.436 1189.07 133.89 1189.13 134.282C1189.19 134.675 1189.28 135.012 1189.39 135.293C1189.51 135.568 1189.65 135.797 1189.81 135.979C1189.98 136.154 1190.18 136.283 1190.39 136.365C1190.62 136.447 1190.86 136.488 1191.12 136.488C1191.46 136.488 1191.75 136.424 1192.01 136.295C1192.27 136.166 1192.49 135.961 1192.66 135.68C1192.84 135.393 1192.97 135.021 1193.06 134.563C1193.15 134.106 1193.19 133.559 1193.19 132.92Z" fill="white"/>
                </a>

                <!-- Info button -->
                <a href="#!" id="ic_info">
                    <circle cx="1164" cy="414" r="31" fill="black"/>
                    <rect x="1160" y="398" width="8" height="8" fill="#D9D9D9"/>
                    <rect x="1160" y="410" width="8" height="20" fill="#D9D9D9"/>
                </a>

                <!-- CONTROLS -->
                <!-- Forward button -->
                <a id="ic_forward" class="game_btn" >
                    <path d="M82.922 125.709C84.5215 123.781 87.4785 123.781 89.078 125.709L120.397 163.445C122.561 166.052 120.707 170 117.319 170H54.6808C51.2932 170 49.4393 166.052 51.6027 163.445L82.922 125.709Z" fill="black"/>
                </a>

                <!-- Change direction -->
                <a id="ic_rotate" class="game_btn" >
                    <g>
                    <path d="M96.0632 298.558L110.86 299.991L108.028 314.584" stroke="black" stroke-width="9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M104.675 304.5C99.8253 309.146 93.246 312 86 312C71.0883 312 59 299.912 59 285C59 270.088 71.0883 258 86 258C97.942 258 108.073 265.753 111.635 276.5" stroke="black" stroke-width="9" stroke-linecap="square"/>
                    </g>
                </a>

                <!-- Backward button -->
                <a id="ic_backward" class="game_btn" >
                    <path d="M89.078 446.291C87.4785 448.219 84.5215 448.219 82.922 446.291L51.6027 408.555C49.4393 405.948 51.2932 402 54.6807 402H117.319C120.707 402 122.561 405.948 120.397 408.555L89.078 446.291Z" fill="black"/>
                </a>

                <!-- Extra shapes for console style -->
                <rect opacity="0.1" x="109.543" y="517" width="29.832" height="29.832" rx="4" fill="black"/>
                <rect opacity="0.1" x="99.543" y="29.832" width="32.318" height="14.916" rx="4" fill="black"/>
            </svg>
            <!-- Container for the map -->
            <section id="map"></section>

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
    /* Main page logic */            
    $( window ).on( "load", function() {
        doPageOperation();
    });
</script>
<?php include("../components/footer_default.php"); ?>