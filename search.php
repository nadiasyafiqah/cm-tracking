<?php
include('config.php');
include(CLASS_DIR.'/class.asset.php');
include('inc/layout/header.php');

if (isset($_POST['search'])) {
  $searchString = $_POST['search'];
  Asset::searchAssetBySerial($searchString);
}

include('inc/layout/footer.php');
?>