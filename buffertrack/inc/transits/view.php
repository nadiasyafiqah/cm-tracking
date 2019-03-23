<h1>Transit Log</h1>
<div class="table">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Asset</th>
      <th scope="col">Transit Type</th>
      <th scope="col">Target Location</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT log.logDate, asset.assetBrand, asset.assetModel, asset.assetSerial, txntype.txnName, location.locationName FROM log ";
      $sql .= "JOIN asset ON asset.assetID = log.assetID ";
      $sql .= "JOIN txntype ON txntype.txnID = log.txnTypeID ";
      $sql .= "JOIN location ON location.locationID = log.locationID ";
      $sql .= "ORDER by log.logDate DESC";
      $sql = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_array($sql)) {
        $logDate = $row['logDate'];
        $assetBrand = $row['assetBrand'];
        $assetModel = $row['assetModel'];
        $assetSerial = $row['assetSerial'];
        $txnName = $row['txnName'];
        $locationName = $row['locationName'];
        echo "<tr>";
        echo "<th>$logDate</th>";
        echo "<td>$assetBrand&nbsp;$assetModel&nbsp;$assetSerial</td>";
        echo "<td>$txnName</td>";
        echo "<td>$locationName</td>";
        echo "</tr>";
      }
    ?>
    
  </tbody>
</table>
<div class="flex">
  <div class="float-right">
    <?php
      // for counting asset total
      $sql = 'SELECT COUNT(*) FROM log';
      $sql = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_assoc($sql)) {
        $totalLog = $row['COUNT(*)'];
        echo "<small>Total $totalLog logs found</small>";
      }
    ?>
  </div>
</div>
</div>