<h1>Add New Location</h1>

<?php
  if(isset($_POST['Submit'])){
    $locationState = $_POST['locationState'];
    $locationName = $_POST['locationName'];
    $locationTypeID = $_POST['locationTypeID'];

    //add record into database
    $sql = "INSERT INTO location(locationState, locationName, locationTypeID) ";
    $sql .= "VALUES ('{$locationState}', '{$locationName}', '{$locationTypeID}')";
    $sql = mysqli_query($connection, $sql);

    if ($sql) {
      echo 'Data Submitted';
      echo "<script>window.setTimeout(function() {window.location = 'locations.php'; }, 2000);</script>";
    } else {
      echo 'Failed to submit';
    }
  }
?>

<form class="" action="" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="locationState">State</label>
    <div class="col-sm-10">
    <select class="form-control" name="locationState" id="">
      <option>Johor</option>
      <option>Melaka</option>
      <option>Negeri Sembilan</option>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="locationName">Location Name</label>
    <div class="col-sm-10">
    <input class="form-control" type="text" name="locationName" id="">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="locationTypeID">Location Type</label>
    <div class="col-sm-10">
    <select class="form-control" name="locationTypeID" id="">
      <option value="1">School</option>
      <option value="2">Store</option>
    </select>
    </div>
  </div>
  <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
</form>