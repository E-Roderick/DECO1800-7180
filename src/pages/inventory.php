<?php require_once("../components/nav.php") ?>

<?php include("../components/header_default.php"); ?>
<main id="desktop" class="inventory-page">
<section class="container">
    <?php DynamicBackButton() ?>
    <section class="wrapper main-features">
        <h4>Inventory</h4>
        
            <div class="inventory-sec" id="slider-wrapper">
            <div class="inner-wrapper" id="inner-wrapper">
                <input checked type="radio" name="slide" class="control" id="Slide1" />
                <label for="Slide1" id="s1"></label>
                <input type="radio" name="slide" class="control" id="Slide2" />
                <label for="Slide2" id="s2"></label>
                <input type="radio" name="slide" class="control" id="Slide3" />
                <label for="Slide3" id="s3"></label>
                <input type="radio" name="slide" class="control" id="Slide4" />
                <label for="Slide4" id="s4"></label>
                <div class="overflow-wrapper">
                <div class="slide" href="#">
                    <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    </ul>
                    </div>
                <div class="slide" href="#">
                    <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    </ul>
                    </div>
                <div class="slide" href="#">
                    <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    </ul>
                </div>
                <div class="slide" href="#">
                    <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
    </section>
</section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/DECO1800-7180/src/js/handle_data.js"></script>
<script>  
    if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
    //Mobile device
        document.getElementById("desktop").className = "inventory-mobile-page";
        document.getElementById("slider-wrapper").className = "inventory-sec-mobile";
        document.getElementById("inner-wrapper").className = "inner-wrapper-mobile";
        let labels = document.querySelectorAll("label");
        for (let i = 0; i < labels.length; i++) {
            labels[i].style.display = "none";
        }
    }

    /* Inventory page logic */            
    $( window ).on( "load", function() {
        let collectedEvents = getLocalStorage(LS_EVENT_COLLECTED);
        console.log(collectedEvents);

        for (let i = 0; i < collectedEvents.length; i++) {
            let content = `<a href="#" class="myLink">
                        <img class="modalImg" src=${collectedEvents[i]["icon"]} alt="">
                        <p>${collectedEvents[i]["item"]}</p>   
                        </a>
                        <div class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" src=${collectedEvents[i]["image"]} alt="">
                            <div id="caption">
                                <p>
                                    ${collectedEvents[i]["desc"]}
                                </p>
                            </div>
                        </div>
                        `;
            $(`.slide:nth-child(${Math.floor(i/4) + 1}) li:nth-child(${i % 4 + 1})`).html(content); // Update text
        }

        let modal = document.querySelector(".modal");
        let labels = document.querySelectorAll(".inner-wrapper label");
        console.log(labels);

        // Make sure this page contains modal images.
        if (document.contains(modal)) {
            for (let i = 0; i < collectedEvents.length; i++) {
                // Get the modal.
                let modal = document.getElementsByClassName("modal")[i];
                // Get the image.
                let myLink = document.getElementsByClassName("myLink")[i];
                // Get the <span> element that closes the modal
                let span = document.getElementsByClassName("close")[i];

                // Displays the modal container and uses the same path for the
                // modal image.
                myLink.addEventListener("click", function () {
                    modal.style.display = "block";
                    for (let i = 0; i < labels.length; i++) {
                        labels[i].style.display = "none";
                    }
                });

                // When the user clicks on <span> (x), close the modal.
                span.onclick = function () {
                    modal.style.display = "none";
                    for (let i = 0; i < labels.length; i++) {
                        labels[i].style.display = "block";
                    }
                };
            }
        }
    });
</script>
<?php include("../components/footer_default.php"); ?>
