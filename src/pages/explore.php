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
        <a href="./routes.php" class="back_button"> &lt; Back</a>
        <section class="sub_container">
            <img class="features_icon" src="/DECO1800-7180/public/assets/ui/icons/ic_outline_route_selection.svg" alt="">
            <h3 class="route_title">Route <dfn id="route_number">61</dfn></h3>
        </section>
        <article class="map_container">
            <svg viewBox="0 0 1240 572" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="1240" height="572" rx="64" fill="#D9D9D9"/>
                <rect x="160" y="20" width="928" height="532" rx="16" fill="#C3C3C3"/>
                <rect x="182" y="29" width="884" height="514" rx="8" fill="black"/>
                <rect x="190" y="37" width="868" height="498" fill="#C4C4C4"/>
                <path opacity="0.1" d="M1148.8 130C1146.59 130 1144.8 131.791 1144.8 134V150.8H1128C1125.79 150.8 1124 152.591 1124 154.8V169.2C1124 171.409 1125.79 173.2 1128 173.2H1144.8V190C1144.8 192.209 1146.59 194 1148.8 194H1163.2C1165.41 194 1167.2 192.209 1167.2 190V173.2H1184C1186.21 173.2 1188 171.409 1188 169.2V154.8C1188 152.591 1186.21 150.8 1184 150.8H1167.2V134C1167.2 131.791 1165.41 130 1163.2 130H1148.8Z" fill="black"/>
                <rect opacity="0.1" x="109.543" y="517" width="29.832" height="29.832" rx="4" fill="black"/>
                <path d="M1160 389V397H1152V389H1160Z" fill="#C3C3C3"/>
                <path d="M1160 421V401H1152V421H1160Z" fill="#C3C3C3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1156 437C1173.67 437 1188 422.673 1188 405C1188 387.327 1173.67 373 1156 373C1138.33 373 1124 387.327 1124 405C1124 422.673 1138.33 437 1156 437ZM1156 381C1142.75 381 1132 391.745 1132 405C1132 418.255 1142.75 429 1156 429C1169.25 429 1180 418.255 1180 405C1180 391.745 1169.25 381 1156 381Z" fill="#C3C3C3"/>
                <rect opacity="0.1" x="99.543" y="29.832" width="32.318" height="14.916" rx="4" fill="black"/>
                <path opacity="0.1" d="M82.922 125.709C84.5215 123.781 87.4785 123.781 89.078 125.709L120.397 163.445C122.561 166.052 120.707 170 117.319 170H54.6808C51.2932 170 49.4393 166.052 51.6027 163.445L82.922 125.709Z" fill="black"/>
                <path opacity="0.1" d="M89.078 446.291C87.4785 448.219 84.5215 448.219 82.922 446.291L51.6027 408.555C49.4393 405.948 51.2932 402 54.6807 402H117.319C120.707 402 122.561 405.948 120.397 408.555L89.078 446.291Z" fill="black"/>
                <g opacity="0.1">
                <path d="M94 300L105.178 303.361L102.5 314.722" stroke="black" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M113 284C113 269.088 100.912 257 86 257C71.0883 257 59 269.088 59 284C59 298.912 71.0883 311 86 311C93.246 311 99.8253 308.146 104.675 303.5" stroke="black" stroke-width="5" stroke-linecap="round"/>
                </g>
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