<?php
include_once('../config.php');
$pageTitle = 'Search';
include(BT_LAYOUT_DIR.'header.php');
?>
<?php
  if (isset($_POST['serialSearchInput'])) {
    $serialSearchInput = $_POST['serialSearchInput'];
  }
?>
<h1>Search Result</h1>
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
      $sql = "SELECT log.logDate, asset.assetBrand, asset.assetModel, asset.assetSerial, txntype.txnName, location.locationName, remarks.remarkContent FROM log ";
      $sql .= "JOIN asset ON asset.assetID = log.assetID ";
      $sql .= "JOIN txntype ON txntype.txnID = log.txnTypeID ";
      $sql .= "JOIN location ON location.locationID = log.locationID ";
      $sql .= "LEFT JOIN remarks ON remarks.logID = log.logID ";
      $sql .= "WHERE asset.assetSerial = '$serialSearchInput' ";
      $sql .= "ORDER by log.logDate DESC";
      $sql = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_array($sql)) {
        $logDate = $row['logDate'];
        $assetBrand = $row['assetBrand'];
        $assetModel = $row['assetModel'];
        $assetSerial = $row['assetSerial'];
        $txnName = $row['txnName'];
        $locationName = $row['locationName'];
        $remarkContent = $row['remarkContent'];
        echo "<tr>";
        echo "<th>$logDate</th>";
        echo "<td>$assetBrand&nbsp;$assetModel&nbsp;$assetSerial</td>";
        echo "<td>$txnName</br><small>$remarkContent</small></td>";
        echo "<td>$locationName</td>";
        echo "</tr>";
      }
    ?>
    
  </tbody>
</table>
<?php include(BT_LAYOUT_DIR.'footer.php'); ?>