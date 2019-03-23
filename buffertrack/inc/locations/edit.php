<h1>Add New Location</h1>

<?php
  if (isset($_GET['location'])) {
    $locationID = $_GET['location'];

    $sql = "SELECT * FROM location WHERE locationID = {$locationID}";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $locationID = $row['locationID'];
      $locationName = $row['locationName'];
      $locationState = $row['locationState'];
      $locationTypeID = $row['locationTypeID'];
    }
  }

  if(isset($_POST['Submit'])){
    $locationState = $_POST['locationState'];
    $locationName = $_POST['locationName'];
    $locationTypeID = $_POST['locationTypeID'];

    //update record into database
    $sql = "UPDATE location SET locationState = '{$locationState}', locationName = '{$locationName}', locationTypeID = '{$locationTypeID}' ";
    $sql .= "WHERE locationID = {$locationID}";
    $sql = mysqli_query($connection, $sql);

    if ($sql) {
      echo "Data Submitted. Redirecting..";
      echo "<script>window.setTimeout(function() {window.location = 'locations.php'; }, 2000);</script>";
    } else {
      die;
    }
  }
?>

<form class="" action="" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="locationState">State</label>
    <div class="col-sm-10">
    <select class="form-control" name="locationState" id="">
    <?php
      $statesName = array('Johor', 'Melaka', 'Negeri Sembilan');
      foreach ($statesName as $stateName) {
        echo '<option value="'.htmlspecialchars($stateName).'" ';
        if ($stateName == $locationState) {
          echo "selected";
        }
        echo ">$stateName</option>";
      }
    ?>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="locationName">Location Name</label>
    <div class="col-sm-10">
    <input class="form-control" type="text" name="locationName" value='<?php echo $locationName; ?>' id="">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="locationTypeID">Location Type</label>
    <div class="col-sm-10">
    <select class="form-control" name="locationTypeID" id="">
      <?php
        $ArrLocationType = array('1'=>'School', '2'=>'Store');
        foreach ($ArrLocationType as $ArrLocationTypeID => $ArrLocationTypeName) {
          echo "<option value=$ArrLocationTypeID ";
            if ($locationTypeID == $ArrLocationTypeID) {
              echo "selected";
            }
          echo ">$ArrLocationTypeName</option>";
        }
      ?>
    </select>
    </div>
  </div>
  <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
</form>