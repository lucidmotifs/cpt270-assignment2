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

<?php
$error = array();

if ( !empty($_POST['submit']) ) {

  // Do server-side verification of user input

  // fist name section
  if (empty($_POST['first-name']))
    $error[] = 'First Name must not be empty';

  // last name section
  if (empty($_POST['last-name']))
    $error[] = 'Last Name must not be empty';

  // address set
  if (empty($_POST['address']))
    $error[] = 'Address must not be empty';

  // email set, pattern
  if (empty($_POST['email']))
    $error[] = 'Email must not be empty';
    $regex = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    if ( !preg_match( $regex, $_POST['email'] ) )
      $error[] = 'Email must be valid';

  // mobile phone set, pattern
  if (empty($_POST['mobile-phone']))
    $error[] = 'First Name must not be empty';
    $regex = '/^(?:\(?04\)?|\(?\+614\)?\s?)[\s](?:[\-\s]?\d\d\d\d){2}$/';
    if ( !preg_match( $regex, $_POST['mobile-phone'] ) )
      $error[] = 'Mobile Number must be valid';

  // delivery method between 1-3
  if (empty($_POST['post-method']))
    $error[] = 'Postage Method must not be empty';
    if ( !($_POST['post-method'] >= 1) || !($_POST['email'] <= 3) )
      $error[] = 'Postage Method must be valid';

  // credit card set, pattern
  if (empty($_POST['first-name']))
    $error[] = 'First Name must not be empty';
    $regex = '/^[\d\s]{13,19}$/';
    if ( !preg_match( $regex, $_POST['credit-card-no'] ) )
      $error[] = 'Credit Card Number must be valid';

  // expiry month set, 1-12
  if (empty($_POST['expiry-month']))
    $error[] = 'Expiry Month must not be empty';
    if ( !($_POST['expiry-month'] >= 1) || !($_POST['expiry-month'] <= 12) )
      $error[] = 'Expiry Month must be valid';

  // expiry year set, 15 or greater
  if (empty($_POST['expiry-year']))
    $error[] = 'Expiry Year must not be empty';
    if ( !($_POST['expiry-year'] >= 15) )
      $error[] = 'Expiry Year must be valid';

  // date is greater than now()
  $now = time();
  // Set to last day of the expiry month
  $expiry = mktime(0, 0, 0, $_POST['expiry-month']+1, 0, $_POST['expiry-year']);

  if ( time() > date('U', $expiry) )
    $error[] = 'Credit Card has expired';

}

?>

<?php if ( empty($error) && !empty($_POST['submit']) ): ?>

<!-- Content Area -->
<main class="container">

  <section id="page-title">
    <h1>Order Complete!</h1>
  </section>

  <hr>

  <section id="receipt">

    <fieldset>
      <legend>Order Receipt</fieldset>

      <label>Name: </label>
      <span>
        <?=$_POST['first-name']?>
        <?=$_POST['last-name']?>
      </span>

      <br>

      <label>Address: </label>
      <span>
        <?=$_POST['address']?>
      </span>

      <br>

      <label>Phone: </label>
      <span>
        <?=$_POST['mobile-phone']?>
      </span>

      <br>

      <label>Delivery Method: </label>
      <span>
<?php
  switch ($_POST['post-method']) {
	case 1:
		echo 'Regular Post';
		break;
	case 2:
		echo 'Courier';
		break;
	case 3:
		echo 'Express Courier';
		break;
	default:
		echo 'Error';
	}
?>
      </span>

      <br><br>

      <label>Items Ordered:</label>

<?php foreach (a2_cart_tabulate($products) as $item): ?>

      <div>
        - <span class="receipt-qty"><?=$item['qty']?>x</span>
        <span class="receipt-item"><?=$item['name']?> @ </span>
        <span class="receipt-price priceformat"><?=$item['price']?></span>
        &#40;<span class="receipt-subtotal priceformat"><?=$item['qty'] * $item['price']?></span>&#41;
      </div>

<?php endforeach; ?>

      <div>
        <span>Total Price: </span>
        <span class="priceformat" id="order-total"></span>
      </div>

    </fieldset>

    <hr>

  </section>

  <script>
    function getOrderTotal() {
      total = 0;
      $(".receipt-subtotal").each(function( index ) {
        total += +$(this).text().replace('$','').replace(/,/g,'');
      });
      $("#order-total").html(total).priceFormat({prefix: '$', centsLimit: 0});
    }
    getOrderTotal();
    $("#cartitems").html(0);

    // Convert numbers to prices
    $(".priceformat").each(function( index ) {
      $(this).priceFormat({prefix: '$', centsLimit: 0});
    });
  </script>

<?php include_once("handlers/makereceipt.php"); ?>

<?php elseif ( !empty($error) || empty($_POST['submit']) ): ?>

  <section id="page-title">
    <h1>Checkout</h1>
  </section>

  <hr>

  <section id="shop-cart">

    <div id="errors">
<?php foreach ($error as $e): ?>
      <p><?=$e?></p>
<?php endforeach; ?>
    </div>

    <br>

    <form id="checkout-form" action="checkout.php" method="post">

      <fieldset>
        <legend>User Details</legend>

        <div class="form-group">
          <label for="first-name">First Name: </label>
          <input id="first-name" name="first-name" type="text" value="<?=$_SESSION['user']['FirstName']?>" required/>
          <label for="last-name">First Name: </label>
          <input id="last-name" name="last-name" type="text" value="<?=$_SESSION['user']['LastName']?>" required/>
        </div>

        <div class="form-group">
          <label for="address">Address: </label> <br>
          <textarea
            id="address"
            name="address"
            style="width:471px;height:100px;"
            required><?=!empty($_POST['address']) ? $_POST['address'] : ''?>
          </textarea>
        </div>

        <div class="form-group">
          <label for="email">Email: </label>
          <input type="email" id="email" name="email" value="<?=$_SESSION['user']['Email']?>" required/>
          <label for="mobile-phone">Mobile: </label>
          <input type="type" id="mobile-phone" name="mobile-phone" pattern="^(?:\(?04\)?|\(?\+614\)?\s?)[\s](?:[\-\s]?\d\d\d\d){2}$" value="<?=$_SESSION['user']['Phone']?>" required />
        </div>

      </fieldset>

      <fieldset>
        <legend>Shipping Details</legend>

        <div class="form-group">
          <label for="post-method">Delivery Method: </label> <br>
          <input type="radio" name="post-method" id="post-method" value="1" checked>Regular Post <br>
          <input type="radio" name="post-method" id="post-method" value="2" >Courier <br>
          <input type="radio" name="post-method" id="post-method" value="3" >Express Courier <br>
        </div>

      </fieldset>

      <fieldset>
        <legend>Payment Details</legend>

        <div class="form-group">
          <label for="credit-card-no">Credit Card Number: </label>
          <input type="text" name="credit-card-no" id="credit-card-no" pattern="^[\d\s]{13,19}$" required />
        </div>

        <div class="form-group">
          <label for="expiry-month">Expiry: </label>
          <select name="expiry-month" id="expiry-month">
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>
            <option value="5">05</option>
            <option value="6">06</option>
            <option value="7">07</option>
            <option value="8">08</option>
            <option value="9">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          /
          <select name="expiry-year" id="expiry-year">
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
          </select>
        </div>
      </fieldset>

      <div class="form-group">
        <input type="checkbox" name="newsletter" id="newsletter" value="yes">
          Please sign me up for the newsletter!
        </input>
      </div>

      <div class="form-group">
        <button class="btn btn-lg btn-primary" id="add" name="submit" value="true">Checkout</button>
      </div>

    </form>

  </section>

<?php else: ?>

  <!-- shouldn't be here? naybe handle in future -->

<?php endif; ?>

</main>

<?php
# Footer include file
include_once("inc/footer.html"); ?>
