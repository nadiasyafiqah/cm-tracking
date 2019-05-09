<?php include(CLASS_DIR.'/class.asset.php'); ?>
<h1>Asset List</h1>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php Asset::getActiveAssetBrandAndModel(); ?>
  </tbody>
</table>