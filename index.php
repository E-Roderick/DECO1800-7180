<?php include("src/components/header_default.php"); ?>
      <main class="home-page">
        <section class="container">
          <article class="wrapper "><img class="main_title" src="./public/assets/images/main_title_l.png" alt=""></article>
          <section class="wrapper main_features">
            <a class="feature_box" href="src/pages/routes.php">
              <div class="box_touch_area"></div>
              <section class="feature_content">
                <picture class="feature_icon">
                  <img src="./public/assets/images/ic_outline_route_selection.svg" alt="">
                </picture>
                <h4 class="feature_title">Route selections</h4>
              </section>
            </a>
            <a class="feature_box" href="src/pages/location.php">
              <div class="box_touch_area"></div>
              <section class="feature_content">
                <picture class="feature_icon">
                  <img src="./public/assets/images/ic_outline_nearby_bus_stops.svg" alt="">
                </picture>
                <h4 class="feature_title">Nearby bus stops</h4>
              </section>
            </a>
          </section>
        </section>
      </main>
      
<?php include("src/components/footer_default.php"); ?>