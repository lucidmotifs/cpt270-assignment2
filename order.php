<?php
// User authentication / session script.
include_once("src/authenticate.php");
#a2_session_test();
a2_session_init();
#a2_auth_init("Alice", "whi73r4bbit");
#a2_auth_test();
// Included for technical marking purposes - comment back in on submission
#include_once("/home/eh1/e54061/public_html/wp/debug.php"); ?>

<?php var_dump($_SESSION['cart']); ?>
