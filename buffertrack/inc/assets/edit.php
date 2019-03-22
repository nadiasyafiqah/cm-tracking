<h1>Edit Asset</h1>
<?php
  if (isset($_GET['asset'])) {
    $assetID = $_GET['asset'];
    
    $sql = "SELECT * FROM asset WHERE assetID = $assetID";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $assetID = $row['assetID'];
      $assetBrand = $row['assetBrand'];
      $assetModel = $row['assetModel'];
      $assetSerial = $row['assetSerial'];
    }
  }

  if (isset($_POST['Submit'])) {
    $assetBrand = $_POST['assetBrand'];
    $assetModel = $_POST['assetModel'];
    $assetSerial = $_POST['assetSerial'];

    $sql = "UPDATE asset SET assetBrand = '{$assetBrand}', assetModel = '{$assetModel}', assetSerial = '{$assetSerial}' ";
    $sql .= "WHERE assetID = {$assetID}";
    $sql = mysqli_query($connection, $sql);
    if ($sql) {
      echo "Data Submitted. Redirecting..";
      echo "<script>window.setTimeout(function() {window.location = 'assets.php'; }, 2000);</script>";
    } else {
      die;
    }
  }
?>
<form class="" action="" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="assetBrand">Brand</label>
    <div class="col-sm-10">
      <select class="form-control" name="assetBrand" id="">
        <?php
          $brands = array('HP', 'Lenovo', 'DELL');
          foreach ($brands as $brand) {
            echo "<option value=$brand ";
            if ($brand == $assetBrand) {
              echo "selected";
            }
            echo ">$brand</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="assetModel">Model</label>
    <div class="col-sm-10">
      <input class="form-control" type="text" name="assetModel" value="<?php echo $assetModel; ?>" id="">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="assetSerial">Serial</label>
    <div class="col-sm-10">
      <input class="form-control" type="text" name="assetSerial" value="<?php echo $assetSerial; ?>" id="">
    </div>
  </div>
  <input class="btn btn-primary" type="submit" name=Submit value="Submit">
</form>