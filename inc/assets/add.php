<?php
include(CLASS_DIR.'/class.form.php');
include(CLASS_DIR.'/class.dal.php');

if (isset($_POST['submit'])) {
  if (empty($_POST['remarksContent'])) {
    DAL::addAssetWithoutRemarks($_POST);
  } else {
    DAL::addAssetWithRemarks($_POST);
  }
}
?>

<h2>Add New Asset</h2>
<form action="" method="post">
  <div class="form-group row">
    <label for="assetLogDate" class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-6">
      <input class="form-control" type="date" name="assetLogDate" id="">
    </div>
  </div>
  <div class="form-group row">
    <label for="brandID" class="col-sm-2 col-form-label">Brand</label>
    <div class="col-sm-6">
      <select class="form-control" name="brandID" id="">
        <?php Form::getBrandListIntoSelect(); ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="modelID" class="col-sm-2 col-form-label">Model</label>
    <div class="col-sm-6">
    <select class="form-control" name="modelID" id="">
      <?php Form::getModelListIntoSelect(); ?>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="serialName" class="col-sm-2 col-form-label">Serial</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="serialName" id="">
    </div>
  </div>
  <div class="form-group row">
    <label for="locationID" class="col-sm-2 col-form-label">Checked-in Store</label>
    <div class="col-sm-6">
      <select class="form-control" name="locationID" id="">
        <?php Form::getStoreListIntoSelect(); ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="remarksContent" class="col-sm-2 col-form-label">Remarks</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="remarksContent" id="">
    </div>
  </div>
  <div class="form-group row">
    <div class="col">
      <button class="btn btn-primary" type="submit" name="submit">Add Asset</button>
    </div>
  </div>
</form>