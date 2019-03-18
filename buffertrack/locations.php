<?php
include_once('config.php');
include(CLASS_DIR.'class.locations.php');
$pageTitle = 'Locations';
include(LAYOUT_DIR.'header.php');
 
if (isset(($_GET['action']))) {
  $action = $_GET['action'];
  if ($action == 'add') {
    include(INCLUDE_DIR.'locations/add.php');
  }
} else {
  include(INCLUDE_DIR.'locations/view.php');
}

include(LAYOUT_DIR.'footer.php'); 
?>