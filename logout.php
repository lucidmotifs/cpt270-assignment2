<?php
// User authentication / session script.
include_once("src/authenticate.php");

// Initialise session.
a2_session_init();
// Logout User
a2_auth_end();

// Testing - should always be guest
//echo $_SESSION['user']['FirstName'];

header('Location: https://titan.csit.rmit.edu.au/~s3550097/wp/a2/index.php');

?>
