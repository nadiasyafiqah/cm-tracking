<h1>Add New Asset</h1>
<?php
  if (isset($_POST['Submit'])) {
    $assetBrand = trimInput($_POST['assetBrand']);
    $assetModel = trimInput($_POST['assetModel']);
    $assetSerial = trimInput($_POST['assetSerial']);
    
    //add record into database
    $sql = "INSERT INTO asset(assetBrand, assetModel, assetSerial) ";
    $sql .= "VALUES ('{$assetBrand}', '{$assetModel}', '{$assetSerial}')";
    validateForm($_POST,'assets.php');
  }


?>
<form class="" action="" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="assetBrand">Brand</label>
    <div class="col-sm-10">
      <select class="form-control" name="assetBrand" id="">
        <option>HP</option>
        <option>Lenovo</option>
        <option>DELL</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="assetModel">Model</label>
    <div class="col-sm-10">
      <input class="form-control" type="text" name="assetModel" id="">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="assetSerial">Serial</label>
    <div class="col-sm-10">
      <input class="form-control" type="text" name="assetSerial" id="">
    </div>
  </div>
  <input class="btn btn-primary" type="submit" name=Submit value="Submit">
</form>