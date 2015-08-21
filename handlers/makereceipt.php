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

$line = "Order Details: \r\n";
fwrite($fp, $line);

fclose($fp);

// TODO add order details section.

?>
