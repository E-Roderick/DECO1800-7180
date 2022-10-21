<?php include("../components/header_default.php"); ?>

<?php
$ROUTES = array(
    "61" => "610142",
    "66" => "660047",
    "111" => "1110001",
    "222" => "2220001",
    "444" => "4440002",
    "P206" => "P2060002",
);
?>

<main class="route-page">
    <section class="container all-height all-width">
        <article class="sub_page">
            <a href="javascript:history.back()" class="back_button"> &lt; Back</a>
        </article>
        <section class="wrapper main-features">
            <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_route_selection.svg" alt="">
            <h4>SEARCH FOR A ROUTE</h4>
            
            <form method="post" action="/DECO1800-7180/src/pages/explore.php" >
                <select name="route">
                    <option value="none" selected disabled hidden>
                        Select a route
                    </option>
                    
                    <?php
                        foreach($ROUTES as $route => $id) {
                            echo "<option value={$id}>{$route}</option>";
                        }
                     ?>
                </select>
                <input type="submit" name="submit" value="Next Step">
            </form>
        </section>
    </section>

</main>
<?php include("../components/footer_default.php"); ?>