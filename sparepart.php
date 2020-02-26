<?php
include('config.php');
include('inc/layout/header.php');
if (!isset($_GET['action'])) {
  include(SPAREPART_INC.'/listssp.php');
} else {
  switch ($_GET['action']) {
    case 'addsp':
      include(SPAREPART_INC.'/addsp.php');
      break;
    
    case 'viewsp':
      include(SPAREPART_INC.'/viewsp.php');
      break;

    case 'detailssp':
      include(SPAREPART_INC.'/detailssp.php');
      break;

    case 'archivedsp':
      include(SPAREPART_INC.'/archivedsp.php');
      break;

    default:
      include(SPAREPART_INC.'/listssp.php');
      break;
  }
}
include('inc/layout/footer.php');
?>