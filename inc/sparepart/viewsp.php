<?php 
  include(CLASS_DIR.'/class.sparepart.php');
  if (isset($_GET['brand']) && isset($_GET['model'])) {
    $brandID = $_GET['brand'];
    $modelID = &$_GET['model'];
  }
?>
<h1>Serial List for <?php SparePart::getSparePartNameByBrandIDAndModelID($brandID, $modelID); ?></h1>
<table class="table table-striped table-hover">
  <thead>
    <th scope="col">#</th>
    <th scope="col">Serial</th>
    <th scope="col">Action</th>
  </thead>
  <tbody>
    <?php SparePart::getSparePartSerialList($brandID, $modelID); ?>
  </tbody>
</table>
