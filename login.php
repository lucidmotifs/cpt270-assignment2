<?php
// User authentication / session script.
include_once("src/authenticate.php");

## Basic Login Handler for AJAX queries

// Initialise session.
a2_session_init();

// Login User
$result = a2_auth_init($_POST['username'], $_POST['password']);
echo $result;

// AJAX request requires a definitive result. Might be cleaner to use 0/1
/*if ($result) {
  echo 'true';
} else {
  echo 'false';
}*/

?>
