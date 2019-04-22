<?php
include('config.php');
include('inc/layout/header.php');
if (!isset($_GET['action'])) {
  include(ASSETS_INC.'/lists.php');
} else {
  switch ($_GET['action']) {
    case 'add':
      include(ASSETS_INC.'/add.php');
      break;
    
    case 'view':
      include(ASSETS_INC.'/view.php');
      break;

    case 'details':
      include(ASSETS_INC.'/details.php');
      break;

    default:
      include(ASSETS_INC.'/lists.php');
      break;
  }
}
include('inc/layout/footer.php');
?>