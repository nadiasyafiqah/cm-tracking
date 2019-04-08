<?php
function checkSQL($sql) {
  global $connection;
  if (!$sql) {
    die('SQL Failed. '.mysqli_error($connection));
  }
}

function fetchAssetList() {
  global $connection;
  $sql = "SELECT `asset`.`assetID`, `brand`.`brandName`, `model`.`modelName`, `serial`.`serialName`, `location`.`locationName` ";
  $sql .= "FROM `assetstatus` ";
  $sql .= "LEFT JOIN `asset` ON `asset`.`assetStatusID` = `assetstatus`.`assetStatusID` ";
  $sql .= "LEFT JOIN `brand` ON `asset`.`brandID` = `brand`.`brandID` ";
  $sql .= "LEFT JOIN `location` ON `asset`.`locationID` = `location`.`locationID` ";
  $sql .= "LEFT JOIN `model` ON `asset`.`modelID` = `model`.`modelID` ";
  $sql .= "LEFT JOIN `serial` ON `asset`.`serialID` = `serial`.`serialID` ";
  $sql .= "WHERE (`assetstatus`.`assetStatusName` = 'Active') ";
  $sql .= "ORDER BY `brand`.`brandName` ASC, `model`.`modelName` ASC, `serial`.`serialName` ASC ";
  $sql = mysqli_query($connection, $sql);
  $num = 1;
  while ($row = mysqli_fetch_assoc($sql)) {
    $assetID = $row['assetID'];
    $brandName = $row['brandName'];
    $modelName = $row['modelName'];
    $serialName = $row['serialName'];
    $currentLocation = $row['locationName'];
    echo "<tr>";
    echo "<td>{$num}</td>";
    echo "<td>{$brandName}</td>";
    echo "<td>{$modelName}</td>";
    echo "<td>{$serialName}</td>";
    echo "<td>{$currentLocation}</td>";
    echo "</tr>";
    $num++;
  }
}
?>