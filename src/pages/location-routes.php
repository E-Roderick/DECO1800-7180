<?php include("../components/header_default.php"); ?>
<?php require_once("../components/nav.php"); ?>
<?php require_once("../util/route_data.php"); ?>

<main class="route-page">
    <section class="container all-height all-width">
        <?php BackButton("/DECO1800-7180/") ?>
        <section class="wrapper main-features">
            <img src="/DECO1800-7180/public/assets/ui/icons/ic_outline_route_selection.svg" alt="">
            <h4>SELECT A BUS ROUTE THAT PASSES YOUR STOP</h4>
            
            <form method="post" id="select-form">
                <select id="route-select" name="route">
                    <option value="none" selected disabled hidden>
                        Select a route
                    </option>
                    <option value=660047>66</option>
                </select>
                <input type="submit" class="btn" name="submit" value="NEXT STEP" disabled>
            </form>
        </section>
    </section>

</main>

<script>
    let form = document.getElementById("select-form");

    // Handle form changing
    form.addEventListener('change', ()=> {
        form.querySelector('input[type="submit"]').disabled = false;
    });

    // Handle form submission
    form.onsubmit = event => {
        // Cancel immediate submission
        event.preventDefault();

        // Get new page location
        const stop = "<?php echo $_GET["stop"] ?>";
        const sel = document.getElementById("route-select");
        const url = `/DECO1800-7180/src/pages/explore.php?route=${sel.value}&stop=${stop}`;

        if (sel.value != "none") {
            // Route to new page
            window.location.href = url
        }
    };
</script>

<?php include("../components/footer_default.php"); ?>