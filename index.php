<?php include("src/components/header_default.php"); ?>
      <main class="home-page">
        <article id="welcome-tip" class="info-popup flex-center accepted">
          <section class="info-content">
            <h4>Welcome to City Mario!</h4>
            <p>City mario is a game.</p>
            <button class="btn">UNDERSTOOD</button>
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
                <h4 class="feature_title">Route selections</h4>
              </section>
            </a>
            <a class="feature_box" href="src/pages/location.php">
              <div class="box_touch_area"></div>
              <section class="feature_content">
                <picture class="feature_icon">
                  <img src="./public/assets/ui/icons/ic_outline_nearby_bus_stops.svg" alt="">
                </picture>
                <h4 class="feature_title">Nearby bus stops</h4>
              </section>
            </a>
          </nav>
        </section>
      </main>
      
<?php include("src/components/footer_default.php"); ?>