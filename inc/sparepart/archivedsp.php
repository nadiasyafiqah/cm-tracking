<?php include(CLASS_DIR.'/class.sparepart.php'); ?>
<h1>Archived Spare Part</h1>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Description</th>
      <th scope="col">Serial</th>
    </tr>
  </thead>
  <tbody>
    <?php SparePart::getArchivedSparePartList(); ?>
  </tbody>
</table>