<?php
// User authentication / session script.
include_once("src/authenticate.php");
include_once("src/products.php");
include_once("src/cart.php");

a2_session_init();

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
    <h1>Checkout</h1>
  </section>

  <hr>

  <section id="shop-cart">

    <form id="checkout-form" action="checkout.php" method="post">

      <div class="form-group">
        <label for="first-name">First Name: </label>
        <input id="first-name" type="text" value="<?=$_SESSION['user']['FirstName']?>" required/>
        <label for="last-name">First Name: </label>
        <input id="last-name" type="text" value="<?=$_SESSION['user']['LastName']?>" required/>
      </div>

      <div class="form-group">
        <label for="address">Address: </label> <br>
        <textarea id="address" required></textarea>
      </div>

      <div class="form-group">
        <button class="btn btn-lg btn-primary" id="add">Checkout</button>
      </div>

    </form>

  </section>

</main>

<?php
# Footer include file
include_once("inc/footer.html"); ?>
