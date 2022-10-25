<?php

function BackButton($url) {
    echo '
        <nav class="sub_page">
            <a href="'.$url.'" class="back_button"> &lt; Back</a>
        </nav>
    ';
}

function DynamicBackButton() {
    $url = $_SERVER['HTTP_REFERER'] ? 
        htmlspecialchars($_SERVER['HTTP_REFERER']) : 
        "/DECO1800-7180/";
    BackButton($url);
}

?>