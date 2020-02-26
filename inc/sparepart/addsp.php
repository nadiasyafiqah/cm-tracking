<?php
include(CLASS_DIR.'/class.formsp.php');
include(CLASS_DIR.'/class.dal.php');

if (isset($_POST['submit'])) {
    DAL::addSparePart($_POST);
}
?>

<h2>Add New Spare Part</h2>
<form action="" method="post">

<div class="form-group row">
    <label for="sparepart" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-6">
      <select class="form-control" type="text" name="sparePartTypeID" id="spareType">
      <?php Formsp::getsparePartTypeListIntoSelect(1);?>
    </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="sparePartLogDate" class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-6">
      <input class="form-control" type="date" name="sparePartLogDate" id="">
    </div>
  </div>

  <div class="form-group row">
    <label for="brandID" class="col-sm-2 col-form-label">Brand</label>
    <div class="col-sm-6">
      <select class="form-control" name="brandID" id="">
        <?php Formsp::getBrandListIntoSelect(1); //brand's scopeID as parameter ?>
      </select>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="modelID" class="col-sm-2 col-form-label">Model</label>
    <div class="col-sm-6">
    <select class="form-control" name="modelID" id="">
      <?php Formsp::getModelListIntoSelect(1); //brand's scopeID as parameter?>
    </select>
    </div>
  </div>


  <div class="form-group row">
    <label for="serialName" class="col-sm-2 col-form-label">Serial</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="serialName" id="">
      <input type="checkbox" name="generateSeria;" value="generateSerial"> Generate Serial
    </div>
    
  </div>
  <div class="form-group row">
    <label for="locationID" class="col-sm-2 col-form-label">Checked-in Store</label>
    <div class="col-sm-6">
      <select class="form-control" name="locationID" id="">
        <?php Formsp::getStoreListIntoSelect(); ?>
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
      <button class="btn btn-primary" type="submit" name="submit">Add Spare Part</button>
    </div>
  </div>
</form>