<?php

function a2_cart_add_item($q, $id) {
  array_push($_SESSION['cart'], array("id" => $id, "quantity" => $q));

  return count($_SESSION['cart']);
}

?>
