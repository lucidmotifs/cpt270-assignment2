<?php

function a2_session_test() {
  // Debugging purposes
  error_reporting( E_ALL );
  ini_set( 'display_errors', 1);

  session_start();

  // check if session_id() exists.
  if( session_id() == '' )
  {
      echo 'session_id() empty';
  }else{
      echo session_id();
  }
  echo '<hr>';

  $sessPath   = ini_get('session.save_path');
  $sessCookie = ini_get('session.cookie_path');
  $sessName   = ini_get('session.name');

  if ( isset( $_SESSION['auth'] ) ) {
    echo $_SESSION['auth']; echo " : ";
    echo $sessPath; echo " : ";
    echo $sessCookie; echo " : ";
    echo $sessName;
  } else {
    echo '[not exists]';
    $_SESSION['auth'] = 1;
  }
}

function a2_session_init() {
  // Start the session
  session_start();

  // Check if a user is logged on
  if ( isset ( $_SESSION['auth'] ) && $_SESSION['auth'] ) {
    // User logged on - continue
    return
  } else {
    // No user loogged on, check guest variables set
    if ( isset ( $_SESSION['first_name'] ) && $_SESSION['first_name'] == 'Guest' ) {
      $_SESSION['level'] = '1';
      return
    } else {
      // Set guest user variables
      $_SESSION['first_name'] = "Guest";
      $_SESSION['last_name'] = "Guest";
      $_SESSION['email'] = "guest@bridgetoofar.com";
      $_SESSION['phone'] = "0";
      $_SESSION['d1'] = 0;
      $_SESSION['d2'] = 0;
      $_SESSION['d3'] = 0;

      return
    }
  }
}

function a2_import_user_list() {
  // Open customers.txt file and return array of data.

  // return dummy data for now.
  return [
    "FirstName" => "Alice",
    "LastName" => "Liddell",
    "Email" => "alice@wonderland.com",
    "crypt" => "$1$7PggNm.5$Y0cLU4ADlrJcyefBjVpW11",
    "Phone" => "(04) 8765 4321",
    "Discount-PS1" => "3",
    "Discount-PS2" => "4",
    "Discount-PS3" => "9",
  ];
}

# Return True if the credentials match a user, false otherwise.
# Will also initialise Session vaqriables for the user.
function a2_do_logon($user, $pass) {
  $user_data = a2_import_user_list();
  $match = false;
  
  foreach $user in $user_data {
    if ( $user['FirstName'] == $user ) {
      // Match, check password.
      if ( crypt($pass) == $pass ) {
        $match == true;
      }
    }
  }
}

?>
