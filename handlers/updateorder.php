<?php
// User authentication / session script.
include_once("../src/authenticate.php");

a2_session_init();

// Include cart related functions
include_once("../src/cart.php");

echo a2_cart_update_item($_POST['quantity'], $_POST['product']);

?>
