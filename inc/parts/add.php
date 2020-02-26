<?php
include(CLASS_DIR.'/class.form.php');
include(CLASS_DIR.'/class.dal.php');

if (isset($_POST['submit'])) {
    DAL::addParts($_POST);
}
?>

<h2>Add New Parts</h2>
<form action="" method="post">
    
  <div class="form-group row">
    <label for="sparepart" class="col-sm-2 col-form-label">Sparepart</label>
    <div class="col-sm-6">
      <input class="form-control" type="" name="sparePartID" id="">
        
    </div>
  </div>
    
  <div class="form-group row">
    <label for="partLogDate" class="col-sm-2 col-form-label">Part Log Date</label>
    <div class="col-sm-6">
      <input class="form-control" type="date" name="sparePartLogDate" id="">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="brandID" class="col-sm-2 col-form-label">Parts Brand</label>
    <div class="col-sm-6">
      <select class="form-control" name="brandID" id="">
        <?php Form::getBrandListIntoSelect(1); //brand's scopeID as parameter ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="modelID" class="col-sm-2 col-form-label">Part Model</label>
    <div class="col-sm-6">
    <select class="form-control" name="modelID" id="">
      <?php Form::getModelListIntoSelect(1); //brand's scopeID as parameter?>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="serialID" class="col-sm-2 col-form-label">Part Serial</label><br>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="serialID" id="">
    </div>
  </div>
    
  <div class="form-group row">
    <label for="locationID" class="col-sm-2 col-form-label">Part Location</label>
    <div class="col-sm-6">
      <select class="form-control" name="locationID" id="">
        <?php Form::getStoreListIntoSelect(); ?>
      </select>
    </div>
  </div>
    
  <div class="form-group row">
    <label for="sparePartTypeID" class="col-sm-2 col-form-label">Part Type</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="sparePartTypeID" id="">
      
    </div>
  </div>
    
     <div class="form-group row">
    <label for="statusID" class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="statusID" id="">
     
    </div>
  </div>
    

  <div class="form-group row">
    <div class="col">
      <button class="btn btn-primary" type="submit" name="submit">Add Parts</button>
    </div>
  </div>
</form>