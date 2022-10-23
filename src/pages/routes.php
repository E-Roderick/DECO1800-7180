<?php include("../components/header_default.php"); ?>
<?php require_once("../components/nav.php"); ?>
<?php require_once("../util/route_data.php"); ?>

<main class="route-page">
    <section class="container all-height all-width">
        <?php BackButton("/DECO1800-7180/") ?>
        <section class="wrapper main-features">
            <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_route_selection.svg" alt="">
            <h4>SEARCH FOR A ROUTE</h4>
            
            <form method="post" id="select-form">
                <select id="route-select" name="route">
                    <option value="none" selected disabled hidden>
                        Select a route
                    </option>
                    
                    <?php
                        foreach($ROUTES as $route => $id) {
                            echo "<option value={$id}>{$route}</option>";
                        }
                    ?>
                </select>
                <input type="submit" name="submit" value="NEXT STEP">
            </form>
        </section>
    </section>

</main>

<script>
    document.getElementById("select-form").onsubmit = event => {
        // Cancel immediate submission
        event.preventDefault();

        // Get new page location
        const sel = document.getElementById("route-select");
        const url = `/DECO1800-7180/src/pages/stops.php?route=${sel.value}`;

        if (sel.value != "none") {
            // Route to new page
            window.location.href = url
        }
    };
</script>

<?php include("../components/footer_default.php"); ?>