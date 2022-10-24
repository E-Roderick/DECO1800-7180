<?php include("src/components/header_default.php"); ?>
   
<script src="/DECO1800-7180/src/js/cookie.js"></script>
<script src="/DECO1800-7180/src/js/home.js"></script>

<main class="home-page">
  <article id="welcome-tip" class="info-popup flex-center">
    <section class="info-content">
      <h4>Welcome to City Mario!</h4>
      <p>City Mario is a game about exploring Brisbane to find new and fun events to do.</p>
      <p>To begin, select a method for finding a TransLink bus route to follow. 
        "Route Selection" should be chosen if you are familiar with TransLink. Otherwise, choose the "Nearby Bus Stops" option.</p>
      <p>Currently only the "Route Selection" option is implemented.</p>
      <button class="btn" onclick="setHomeHelpAccepted()">UNDERSTOOD</button>
    </section>
  </article>
  <section class="container">
    <article class="wrapper "><img class="main_title" src="./public/assets/images/main_title_l.png" alt=""></article>
    <nav class="wrapper main_features">
      <a class="feature_box" href="src/pages/routes.php">
        <div class="box_touch_area"></div>
        <section class="feature_content">
          <picture class="feature_icon">
            <img src="./public/assets/ui/icons/ic_outline_route_selection.svg" alt="">
          </picture>
          <h4 class="feature_title">Route Selection</h4>
        </section>
      </a>
      <a class="feature_box" href="src/pages/location.php">
        <div class="box_touch_area"></div>
        <section class="feature_content">
          <picture class="feature_icon">
            <img src="./public/assets/ui/icons/ic_outline_nearby_bus_stops.svg" alt="">
          </picture>
          <h4 class="feature_title">Nearby Bus Stops</h4>
        </section>
      </a>
    </nav>
  </section>
</main>

<script>
  if (isHomeHelpUnderstood()) {
    addHomeHelpAcceptedClass();
  }
</script>

<?php include("src/components/footer_default.php"); ?>