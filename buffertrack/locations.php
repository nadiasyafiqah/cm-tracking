<?php
include_once('../config.php');
include(BT_CLASS_DIR.'class.locations.php');
$pageTitle = 'Locations';
include(BT_LAYOUT_DIR.'header.php');
 
if (isset(($_GET['action']))) {
  $action = $_GET['action'];
  if ($action == 'add') {
    include(BT_INCLUDE_DIR.'locations/add.php');
  } elseif ($action == 'edit') {
    include(BT_INCLUDE_DIR.'locations/edit.php');
  }
} else {
  include(BT_INCLUDE_DIR.'locations/view.php');
}

include(BT_LAYOUT_DIR.'footer.php'); 
?>