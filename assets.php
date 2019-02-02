<?php
include_once('config.php');
include(CLASS_DIR.'class.assets.php');
$pageTitle = 'Assets';
include(LAYOUT_DIR.'header.php');
 
if (isset(($_GET['action']))) {
  $action = $_GET['action'];
  if ($action == 'add') {
    include(INCLUDE_DIR.'assets/add.php');
  }
} else {
  include(INCLUDE_DIR.'assets/view.php');
}

include(LAYOUT_DIR.'footer.php'); 
?>