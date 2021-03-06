<?php
// User authentication / session script.
include_once("src/authenticate.php");
include_once("src/products.php");
include_once("src/cart.php");

a2_session_init();
a2_check_cart();

// Included for technical marking purposes - comment back in on submission
#include_once("/home/eh1/e54061/public_html/wp/debug.php"); ?>

<?php
# Content include files
include_once("inc/header.html");
include_once("inc/navigation.html"); ?>

<!-- Banner splitting header and content -->
<section id="banner">
  <h3>Selling Dreams</h3>
  <!-- Image used under fair use for academic purposes -->
  <img alt="Brige Banner" src="img/banner-bridge.jpg">
</section>

<!-- Content Area -->
<main class="container">

<?php

include_once("src/products.php");

if ( isset($_GET['p']) && $_GET['p'] > 0 ) {
  $p = $products[$_GET['p']-1];
  include_once("inc/product.html");
} else { ?>

  <section id="page-title">
    <h1>Our Products</h1>
  </section>

  <hr>

  <section id="products">

    <ul id="product-list">

<?php

foreach ($products as $p) {
  if ( isset($_SESSION['auth']) ) {
    // If logged on as a user and the product is set to discounted
    if ( ( $_SESSION['auth'] ) && ( $p['discounted'] ) ) {
      // Apply applicable discount
      $p['price'] *= (100 - $_SESSION['user']["Discount-PS" . $p['id']]) / 100;
    }
  }

?>
      <!-- Product Template -->
      <li>
        <a href="products.php?p=<?= $p['id']; ?>">
          <!-- Image used under fair use for academic purposes -->
          <img alt="<?= $p['name']; ?>" src="<?= $p['img']; ?>">
        </a>
        <div class="product-meta">
          <h2>
            <a href="products.php?p=<?= $p['id']; ?>">
              <?= $p['name']; ?>
            </a>
          </h2>
          <small class="loc-small"><?= $p['loc'] ?></small>
          <small><?= $p['meta'] ?></small>
          <div class="row-fluid">
            <div class="price">
              <?= number_format($p['price']) ?> AUD
              <br>
              <?= ($p['discounted'] && $_SESSION['auth']) ? "Valued member discount: " . $_SESSION['user']["Discount-PS" . $p['id']] . "%" : '' ?>
            </div>
            <div class="pull-right"></div>
          </div>
        </div>
      </li>

<?php } ?>

    </ul>
  </section>

<?php } // end of single product view else clause ?>

</main>

<?php
# Footer include file
include_once("inc/footer.html"); ?>
