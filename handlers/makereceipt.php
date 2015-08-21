<?php
// Include cart related functions
include_once("src/cart.php");

// Write User/Order details to file
// line by line

$fp = fopen('data/order.txt', 'w');

$line = "Name: " . $_SESSION['user']['FirstName'] . " " . $_SESSION['user']['LastName'] . "\r\n";
fwrite($fp, $line);

$line = "Adress: " . $_POST['address'] . "\r\n";
fwrite($fp, $line);

$line = "Email: " . $_POST['email'] . "\r\n";
fwrite($fp, $line);

$line = "Phone: " . $_POST['mobile-phone'] . "\r\n\r\n";
fwrite($fp, $line);

switch ($_POST['post-method']) {
case 1:
  $pm = 'Regular Post';
  break;
case 2:
  $pm = 'Courier';
  break;
case 3:
  $pm = 'Express Courier';
  break;
default:
  $pm = 'None';
}

$line = "Delivery Method: " . $pm . "\r\n\r\n";
fwrite($fp, $line);

$line = "Order Details: \r\n\r\n";
fwrite($fp, $line);

$totalprice = 0;
foreach (a2_cart_tabulate($products) as $item) {
  $line = $item['name'];
  $line .= ' ('.$item['qty'] . ") ";
  $line .= '$'.number_format($item['price']).' ';
  $line .= '($'. number_format($item['qty'] * $item['price']) .')';
  $totalprice += $item['qty'] * $item['price'];
  $line .= "\r\n";
  fwrite($fp, $line);
}

$line = "Total Price: ";
$line .= number_format($totalprice);
fwrite($fp, $line);

fclose($fp);

// Clear the cart
$_SESSION['cart'] = array();

?>
