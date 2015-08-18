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
    $_SESSION['auth'] = true;
  }
}

function a2_session_init() {
  // Start the session
  session_start();

  // Check if a user is logged on
  if ( isset ( $_SESSION['auth'] ) && $_SESSION['auth'] ) {
    // User logged on - continue
    return;
  } else {
    // No user loogged on, check guest variables set
    if ( isset ( $_SESSION['first_name'] ) && $_SESSION['first_name'] == 'Guest' ) {
      $_SESSION['level'] = '1';
      return;
    } else {

      // Set guest user variables
      $_SESSION['user']['first_name'] = "Guest";
      $_SESSION['user']['last_name'] = "Guest";
      $_SESSION['user']['email'] = "guest@bridgetoofar.com";
      $_SESSION['user']['phone'] = "0";
      $_SESSION['user']['d1'] = 0;
      $_SESSION['user']['d2'] = 0;
      $_SESSION['user']['d3'] = 0;

      return;
    }
  }
}

function a2_import_user_list() {
  // Open customers.txt file and return array of data.

  // return dummy data for now.
  $data[0] = [
    "FirstName" => "Alice",
    "LastName" => "Liddell",
    "Email" => "alice@wonderland.com",
    "crypt" => '$1$7PggNm.5$Y0cLU4ADlrJcyefBjVpW11',
    "Phone" => "(04) 8765 4321",
    "Discount-PS1" => "3",
    "Discount-PS2" => "4",
    "Discount-PS3" => "9",
  ];

  return $data;
}

# Return True if the credentials match a user, false otherwise.
# Will also initialise Session variables for the user.
function a2_auth_init($username, $password) {
  $user_data = a2_import_user_list();
  $match = false;

  foreach ($user_data as $user) {
    $hash = $user['crypt'];
    if ( ( $user['FirstName'] == $username ) &&
       ( hash_equals($hash, crypt($password, $hash)) ) ) {
      // found match, end loop
      $match = true;

      // Initialise Session variables;
      $_SESSION['auth'] = true;
      $_SESSION['user'] = $user;

      break;
    } else {
      $match = false;
      //echo $hash;
    }
  }

  return $match;
}

function a2_auth_test() {
  if ( isset( $_SESSION['auth'] ) && $_SESSION['auth'] ) {
    echo $_SESSION['auth']; echo " : ";
    echo $_SESSION['user']['FirstName'];
  } else {
    echo '[not logged on]';
  }

  echo '<hr>';
}

?>
