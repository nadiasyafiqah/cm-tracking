<?php
include_once('config.php');
include(CLASS_DIR.'class.transactions.php');
$pageTitle = 'Transactions';
include(LAYOUT_DIR.'header.php');
 
if (!empty($_GET['action'])) {
  include(INCLUDE_DIR.'transactions/add.php');
} else {
  include(INCLUDE_DIR.'transactions/view.php');
}

include(LAYOUT_DIR.'footer.php'); 
?>