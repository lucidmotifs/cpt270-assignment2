<?php
// User authentication / session script.
include_once("src/authenticate.php");
include_once("src/products.php");
include_once("src/cart.php");

a2_session_init();
a2_check_cart();

// Included for technical marking purposes - comment back in on submission
#include_once("/home/eh1/e54061/public_html/wp/debug.php"); ?>

<?php
# Content include files
include_once("inc/header.html");
include_once("inc/navigation.html"); ?>

<!-- Banner splitting header and content -->
<section id="banner">
  <h3>Selling Dreams</h3>
  <!-- Image used under fair use for academic purposes -->
  <img alt="Brige Banner" src="img/banner-bridge.jpg">
</section>

<!-- Content Area -->
<main class="container">

  <section id="page-title">
    <h1>Site Map</h1>
  </section>

  <hr>

  <section id="site-map">

    <ul id="page-list">

<?php

// regex for directories to ignore
$ignore_dirs = '/^(\.\.|\.git|css|data|handlers|inc|js|src)$/';
$ignore_files = '/^(.*\.md|login\.php|logout\.php)$/';
global $ignore_dirs;
global $ignore_files;

// Site map functions

function is_directory($location) {
  if ( @dir($location) !== false ) {
    return true;
  } else {
    return false;
  }
}

// I tried building a recursive search, but ran out of time...
function get_subdirs($directory) {
  global $ignore_dirs;

  $filenames=get_files($directory);
  $kmax=$filenames[0]; // The number of files and subdirectories
  $j=1;
  $k=1;
  while ($k < $kmax) { // For all items in the $filenames array
    //var_dump($filenames);
    $filename=pathinfo($filenames[$k]);

    if ( preg_match($ignore_dirs, $filename["basename"]) ) {
      $k++;
      continue;
    }

    // If entry is a directory
    if ( is_directory($filenames[$k]) ) {
      // not . or ..
      if ( ($filename["basename"] !== ".") && ($filename["basename"] !== "..")) {
        $dirnames[$j]=$filenames[$k];
        $dirnames[$j]=rtrim($dirnames[$j],"/")."/";
        $j++;
      }
    }
    $k++;
  }

  $dirnames[0]=$j-1;
  return $dirnames;
}

function get_files($directory) {
  global $ignore_files;
  global $ignore_dirs;

  // Open the specified directory and read the file names and subdirectories
  // it contains into an array filenames
  $dir=dir($directory);
  $k=1;
  while ( ($file = $dir->read()) !== false ) {
    if ( preg_match($ignore_files, $file) || preg_match($ignore_dirs, $file) ) {
      continue;
    }

    $filenames[$k] = $file;
    if ( is_directory($directory.$file) )
      $filenames[$k] .= '/';
    $k++;
  }
  sort($filenames);
  $filenames[0]=$k-1;
  $dir->close();
  return $filenames;
}

$dirs = get_subdirs("./");
$subdirs = array();

foreach ($dirs as $k => $dir) {
  // skip first
  if ($k == 0) continue;
  $subdirs[$dir] = get_subdirs($dir);
}

// var_dump(get_subdirs("./"));

foreach(get_files("./") as $k => $link):
  if ($k == 0) continue;
?>
      <li><a href="<?=$link?>"><?=$link?></a></li>

<?php endforeach; ?>

    </ul>

  </section>

</main>

<?php
# Footer include file
include_once("inc/footer.html"); ?>
