<?php
include_once('config.php');
include(CLASS_DIR.'class.transactions.php');
$pageTitle = 'Transactions';
include(LAYOUT_DIR.'header.php');
 
if (isset(($_GET['action']))) {
  $action = $_GET['action'];
  switch ($action) {
    case 'checkin':
      include(INCLUDE_DIR.'transactions/checkin.php');
      break;
    case 'checkout':
      include(INCLUDE_DIR.'transactions/checkout.php');
      break;
    case 'transfer':
      include(INCLUDE_DIR.'transactions/transfer.php');
      break;
  }
} else {
  include(INCLUDE_DIR.'transactions/view.php');
}

include(LAYOUT_DIR.'footer.php');
?>