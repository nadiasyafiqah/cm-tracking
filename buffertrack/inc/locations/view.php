<h1>Location List</h1>



<div class="table">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">States</th>
      <th scope="col">Location Name</th>
      <th scope="col">Type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT location.locationID, location.locationName, location.locationState, locationtype.locationTypeName FROM location ";
    $sql .= "JOIN locationtype ON locationtype.locationTypeID = location.locationTypeID ";
    $sql .= "ORDER BY locationTypeName ASC, locationState ASC, locationName ASC";
    $sql = mysqli_query($connection, $sql);
    $nmbr=1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $locationID = $row['locationID'];
      $locationName = $row['locationName'];
      $locationState = $row['locationState'];
      $locationTypeName = $row['locationTypeName'];

      echo "<tr>";
      echo "<th>$nmbr</th>";
      echo "<td>$locationState</td>";
      echo "<td>$locationName</td>";
      echo "<td>$locationTypeName</td>";
      echo "<td><a href='locations.php?action=edit&location=$locationID'>Edit</a>&nbsp<a href='#'>Delete</a></td>";
      echo "</tr>";
      $nmbr++;
    };
    ?>
  </tbody>
</table>
<div class="flex">
  <div class="float-right">
  <?php
      // for counting asset total
      $sql = 'SELECT COUNT(*) FROM location';
      $sql = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_assoc($sql)) {
        $totalLocation = $row['COUNT(*)'];
        echo "<small>Total $totalLocation locations found</small>";
      }
    ?>
  </div>
</div>
</div>