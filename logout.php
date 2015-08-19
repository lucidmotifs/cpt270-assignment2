<?php
// User authentication / session script.
include_once("src/authenticate.php");

// Initialise session.
a2_session_init();
// Logout User
a2_auth_end();

// Testing - should always be guest
echo $_SESSION['user']['FirstName'];

?>

<a href="index.php">Go Back</a>
