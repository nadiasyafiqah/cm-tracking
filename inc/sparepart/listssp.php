<?php include(CLASS_DIR.'/class.sparepart.php'); ?>
<h1>Spare Part List</h1>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php SparePart::getActiveSparePartBrandAndModel(); ?>
  </tbody>
</table>