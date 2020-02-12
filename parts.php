<?php
include('config-sample.php');
include('inc/layout/header.php');
if (!isset($_GET['action'])) {
 //include(PARTS_INC.'/lists.php'); 
} else {
  switch ($_GET['action']) {
    case 'add':
      include(PARTS_INC.'/add.php');
      break;
    
    case 'view':
      include(PARTS_INC.'/view.php');
      break;

    case 'details':
      include(PARTS_INC.'/details.php');
      break;

    case 'archived':
      include(PARTS_INC.'/archived.php');
      break;

    default:
      include(PARTS_INC.'/lists.php');
      break;
  }
}
include('inc/layout/footer.php');
?>