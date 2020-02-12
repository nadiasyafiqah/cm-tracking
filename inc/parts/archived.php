<?php include(CLASS_DIR.'/class.parts.php'); ?>
<h1>Archived Asset</h1>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Description</th>
      <th scope="col">Serial</th>
    </tr>
  </thead>
  <tbody>
    <?php Asset::getArchivedAssetList(); ?>
  </tbody>
</table>