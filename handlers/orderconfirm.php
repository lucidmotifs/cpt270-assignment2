<?php
// User authentication / session script.
include_once("../src/authenticate.php");

a2_session_init();

// Include cart related functions
include_once("../src/cart.php");

// Write User/Order details to file
// line by line

$fp = fopen('../data/order.txt', 'w');

$line = "Name: " . $_SESSION['user']['FirstName'] . $_SESSION['user']['LastName']; ."\n";
fwrite($fp, $line);

$line = ""

?>
