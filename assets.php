<?php
include(INC_DIR.'/functions.php');
include('inc/layout/header.php');
if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'add':
      include(ASSETS_INC.'/add.php');
      break;
    
    default:
      # code...
      break;
  }
}
include('inc/layout/footer.php');
?>