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
    <h1>Your Cart</h1>
  </section>

  <hr>

  <section id="shop-cart">

    <form id="order-form" method="post" action="checkout.php">
      <table id="order-list">
        <tr>
          <th width="60%">Item</th>
          <th>Quantity</th>
          <th width="15%">Price Per Unit</th>
          <th width="15%">Subtotal</th>
        </tr>

<?php if ( empty($_SESSION['cart']) ): ?>

        <tr>
          <td colspan="4">There are no items in your cart!</td>
        </tr>

<?php else: ?>

<?php foreach (a2_cart_tabulate($products) as $item): ?>

        <tr>
          <td><?=$item['name']?></td>
          <td class="right">
            <!-- add plus minus buttons -->
            <input type="number" id ="qty-<?=$item['id']?>" name="qty" min="0" max="100" step="1" value="<?=$item['qty']?>"
              onchange="updateOrder(<?=$item['id']?>)" required/>
          </td>
          <td id="price-<?=$item['id']?>" class="right priceformat"><?=$item['price']?></td>
          <td id="subtotal-<?=$item['id']?>" class="subtotal right priceformat"><?=$item['subtotal']?></td>
        </tr>

<?php endforeach;

endif; ?>

      </table>


      <div id="total-cost">
        <span class="heading">Total Cost</span>
        <span class="value" id="order-total">$100</span>
        <div class="form-group">
          <button class="btn btn-lg btn-primary" id="add">Confirm</button>
        </div>
      </div>
    </form>

  </section>

  <script>
    // Price adjustments
    function adjustTotals(pid) {
      q = $("#qty-"+pid).val();
      p = $("#price-"+pid).text();
      // JS being weird not converting string properly...
      p = p.replace('$','').replace(/,/g,'');

      $("#subtotal-"+pid).html(q * p).priceFormat({prefix: '$', centsLimit: 0});

      getOrderTotal();
    }

    function getOrderTotal() {
      total = 0;
      $(".subtotal").each(function( index ) {
        total += +$(this).text().replace('$','').replace(/,/g,'');
      });
      $("#order-total").html(total).priceFormat({prefix: '$', centsLimit: 0});
    }

    // Convert numbers to prices
    $(".priceformat").each(function( index ) {
      $(this).priceFormat({prefix: '$', centsLimit: 0});
    });

    getOrderTotal();

    // Order update AJAX Handler
    function updateOrder(pid) {
      q = $("#qty-"+pid).val();
      $.post(
        "handlers/updateorder.php",
        { quantity: q, product: pid },
        function(returnedData, status) {
          if (status=="success") {
            adjustTotals(pid);
          } else {
            $("#add_err").css('display', 'inline', 'important');
            $("#add_err").html("<img src='img/alert.png' /> Errors");
          }
        });
    }
  </script>

</main>

<?php
# Footer include file
include_once("inc/footer.html"); ?>
