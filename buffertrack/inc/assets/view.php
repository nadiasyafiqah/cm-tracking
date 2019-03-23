<h1>Assets List</h1>
<div class="table">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Brand</th>
      <th scope="col">Model</th>
      <th scope="col">Serial</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = 'SELECT * FROM asset';
      $sql = mysqli_query($connection, $sql);
      $nmbr = 1;
      while ($row = mysqli_fetch_array($sql)) {
        $assetID = $row['assetID'];
        $assetBrand = $row['assetBrand'];
        $assetModel = $row['assetModel'];
        $assetSerial = $row['assetSerial'];
        echo "<tr>";
        echo "<th>$nmbr</th>";
        echo "<td>$assetBrand</td>";
        echo "<td>$assetModel</td>";
        echo "<td>$assetSerial</td>";
        echo "<td><a href='assets.php?action=edit&asset=$assetID'>Edit</a></td>";
        echo "</tr>";
        $nmbr++;
      }
    ?>
    
  </tbody>
</table>
<div class="flex">
  <div class="float-right">
    <?php
      // for counting asset total
      $sql = 'SELECT COUNT(*) FROM asset';
      $sql = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_assoc($sql)) {
        $totalAsset = $row['COUNT(*)'];
        echo "<small>Total $totalAsset assets found</small>";
      }
    ?>
  </div>
</div>
</div>