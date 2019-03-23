<?php
include('../config.php');
include(BT_CLASS_DIR.'class.assets.php');
$pageTitle = 'Assets';
include(BT_LAYOUT_DIR.'header.php');
 
if (isset(($_GET['action']))) {
  $action = $_GET['action'];
  if ($action == 'add') {
    include(BT_INCLUDE_DIR.'assets/add.php');
  } elseif ($action == 'edit') {
    include(BT_INCLUDE_DIR.'assets/edit.php');
  }
} else {
  include(BT_INCLUDE_DIR.'assets/view.php');
}

include(BT_LAYOUT_DIR.'footer.php'); 
?>