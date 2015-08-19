<?php
// User authentication / session script.
include_once("src/authenticate.php");
#a2_session_test();
a2_session_init();
a2_auth_init("Alice", "whi73r4bbit");
#a2_auth_test();
// Included for technical marking purposes - comment back in on submission
#include_once("/home/eh1/e54061/public_html/wp/debug.php"); ?>

<?php
// Content include files
include_once("inc/header.html");
include_once("inc/navigation.html"); ?>

<!-- Banner splitting header and content -->
<section id="banner">
  <!-- Image used under fair use for academic purposes -->
  <img src="img/banner-bridge.jpg">
</section>

<!-- Content Area -->
<main class="container">

  <section id="page-title">
    <h1>Welcome to A Bridge Too Far</h1>
  </section>

  <hr>

  <section id="copy">
  	<p>A Bridge Too Far are the finest perveyors of engineering feats, modern wonders,
      national icons and aquatic traversers - otherwise known as bridges.
      We offer products from across the globe. Simply browse our site and choose whatever
      modern marval catches your eye and now you own a bridge, or two.
    </p>
  </section><br>

  <hr>

  <section id="site-news">

    <h1>News</h1>

    <article>
      <h4 class="title">Site Launch</h4>
      <p>After months or work we are pleased to have finally released our brand new site.
        We hope our cuustomers find it even easier to find exactly what they need.</p>
      <p>Visit our <a href="products.php">products</a> page to inspect our
        first range of new products. Sate your desire for engineering excellence
        by inspecting the <a href="single_product.html">featured product</a> and
        begin your journey to true happiness.</p>
      <br>
      <p>Because everyone should own a bridge.</p>
    </article>
  </section>

</main>

<?php
# Footer include file
include_once("inc/footer.html"); ?>
