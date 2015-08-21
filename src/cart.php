<?php

function a2_cart_add_item($q, $id) {
  array_push($_SESSION['cart'], array("id" => $id, "quantity" => $q));

  return count($_SESSION['cart']);
}

function a2_cart_update_item($q, $id) {
  foreach($_SESSION['cart'] as $k => $item) {
    if ($item['id'] == $id)
      $_SESSION['cart'][$k]['quantity'] = $q;
  }
  return 1;
}

function a2_check_cart() {
  foreach($_SESSION['cart'] as $k => $item)
    if ($item['quantity'] == 0)
      unset($_SESSION['cart'][$k]);
}

function a2_cart_tabulate($products) {
  $item = array();
  // Loop through cart creating item array for each.
  foreach ($_SESSION['cart'] as $k => $value) {
    $_p = Null;
    foreach ($products as $p) {
      if ($p['id'] == $value['id']) {
        // Apply discount
        if ( isset($_SESSION['auth']) ) {
          // If logged on as a user and the product is set to discounted
          if ( ( $_SESSION['auth'] ) && ( $p['discounted'] ) ) {
            // Apply applicable discount
            $p['price'] *= (100 - $_SESSION['user']["Discount-PS" . $p['id']]) / 100;
          }
        }
        $_p = $p;
      }
    }

    if ( empty($items[$_p['id']]) ) {
      $items[$_p['id']] = array (
        'id' => $_p['id'],
        'qty' => $value['quantity'],
        'name' => $_p['name'],
        'price' => $_p['price'],
        'subtotal' => ($value['quantity'] * $_p['price']),
      );
    } else {
      $items[$_p['id']]['qty'] += $value['quantity'];
    }
  }
  return $items;
}

?>
