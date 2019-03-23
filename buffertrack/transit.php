<?php
include('../config.php');
include(BT_CLASS_DIR.'class.transit.php');
$pageTitle = 'Transit';
include(BT_LAYOUT_DIR.'header.php');
 
if (isset(($_GET['action']))) {
  $action = $_GET['action'];
  if ($action == 'add') {
    include(BT_INCLUDE_DIR.'transits/add.php');
  }
} else {
  include(BT_INCLUDE_DIR.'transits/view.php');
}

include(BT_LAYOUT_DIR.'footer.php'); 
?>