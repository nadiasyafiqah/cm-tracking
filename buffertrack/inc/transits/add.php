<h1>Register Transit</h1>
<?php
  if (isset($_POST['Submit'])) {
    $logDate = trimInput($_POST['logDate']);
    $assetID = trimInput($_POST['assetID']);
    $txnTypeID = trimInput($_POST['txnTypeID']);
    $locationID = trimInput($_POST['locationID']);

    //add data into database
    $sql = "INSERT INTO log(logDate, assetID, txnTypeID, locationID) ";
    $sql .= "VALUES ('{$logDate}', '{$assetID}', '{$txnTypeID}', '{$locationID}')";
    validateForm($_POST, 'transits.php');
  }
?>
<form action="" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="logDate">Date</label>
    <div class="col-sm-10">
      <input class="form-control" type="date" name="logDate" id="">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="assetID">Asset</label>
    <div class="col-sm-10">
      <select class="form-control" name="assetID" id="">
        <option value="">PLEASE SELECT</option>
        <?php
          //fetch assets from database
          $sql = "SELECT * FROM asset ";
          $sql .= "ORDER by assetBrand ASC, assetModel ASC, assetSerial ASC";
          $sql = mysqli_query($connection, $sql);
          while ($row = mysqli_fetch_assoc($sql)) {
            $assetID = $row['assetID'];
            $assetBrand = $row['assetBrand'];
            $assetModel = $row['assetModel'];
            $assetSerial = $row['assetSerial'];
            echo "<option value='$assetID'>{$assetBrand}&nbsp;|&nbsp;{$assetModel}&nbsp;|&nbsp;{$assetSerial}</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="txnTypeID">Transit Mode</label>
    <div class="col-sm-10">
      <select class="form-control" name="txnTypeID" id="">
        <option value="">PLEASE SELECT</option>
        <option value="1">Checkin</option>
        <option value="2">Checkout</option>
        <option value="3">Transfer</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="locationID">Target Location</label>
    <div class="col-sm-10">
      <select class="form-control" name="locationID" id="">
        <option value="">PLEASE SELECT</option>
        <?php
          //fetch locations from database
          $sql = "SELECT location.locationID, location.locationState, location.locationName, locationtype.locationTypeName FROM location ";
          $sql .= "JOIN locationtype on locationtype.locationTypeID = location.locationTypeID ";
          $sql .= "ORDER BY locationtype.locationTypeName ASC, location.locationState ASC, location.locationName ASC";
          $sql = mysqli_query($connection, $sql);
          while ($row = mysqli_fetch_assoc($sql)) {
            $locationID = $row['locationID'];
            $locationState = $row['locationState'];
            $locationName = $row['locationName'];
            $locationTypeName = $row['locationTypeName'];
            echo "<option value='$locationID'>{$locationState}&nbsp;|&nbsp;{$locationName}&nbsp;|&nbsp;{$locationTypeName}</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
</form>