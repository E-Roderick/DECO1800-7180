<?php
require("../components/nav.php");

function UnderConstruction($url) {

    echo '<section class="container">';
        DynamicBackButton();
    echo '
        <article class="wrapper">
            <h2>This Page is Under Construction</h2>
            <p>This page is currently under construction. Please check back later!</p>
        </article>
    </section>
    ';
}

?>