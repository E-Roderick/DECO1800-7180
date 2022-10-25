<?php

function BackButton() {
    $url = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : "/DECO1800-7180/";
    echo '
        <nav class="sub_page">
            <a href="'.$url.'" class="back_button"> &lt; Back</a>
        </nav>
    ';
}

?>