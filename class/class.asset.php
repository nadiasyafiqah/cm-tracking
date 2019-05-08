<?php
class Asset {

  public static function getCheckinDate($assetID) {
    global $connection;
    $sql = "SELECT `assetLog`.`assetLogDate`, `assetLog`.`assetID`, `assetLog`.`txnTypeID` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "WHERE assetLog.assetID = $assetID AND assetLog.txnTypeID = 1";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkinDate = $row['assetLogDate'];
    }
    if (empty($checkinDate)) {
      $checkinDate = '';
    }
    echo $checkinDate;
  }

  public static function getCheckinRemarks($assetID) {
    global $connection;
    $sql = "SELECT `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "LEFT JOIN `remarks` ON `remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
    $sql .= "WHERE ((`assetLog`.`assetID` = $assetID) AND (`assetLog`.`txnTypeID` = 1))";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkinRemarks = $row['remarksContent'];
    }
    if (empty($checkinRemarks)) {
      $checkinRemarks = '';
    }
    echo $checkinRemarks;
  }

  public static function getTransferDate($assetID) {
    global $connection;
    $sql = "SELECT `assetLog`.`assetLogDate`, `assetLog`.`assetID`, `assetLog`.`txnTypeID` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "WHERE assetLog.assetID = $assetID AND assetLog.txnTypeID = 2";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $transferDate = $row['assetLogDate'];
    }
    if (empty($transferDate)) {
      $transferDate = '';
    }
    echo $transferDate;
  }

  public static function getTransferRemarks($assetID) {
    global $connection;
    $sql = "SELECT `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "LEFT JOIN `remarks` ON `remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
    $sql .= "WHERE ((`assetLog`.`assetID` = $assetID) AND (`assetLog`.`txnTypeID` = 2))";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $transferRemarks = $row['remarksContent'];
    }
    if (empty($transferRemarks)) {
      $transferRemarks = '';
    }
    echo $transferRemarks;
  }
  
  public static function getCheckoutDate($assetID) {
    global $connection;
    $sql = "SELECT `assetLog`.`assetLogDate`, `assetLog`.`assetID`, `assetLog`.`txnTypeID` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "WHERE assetLog.assetID = $assetID AND assetLog.txnTypeID = 3";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkoutDate = $row['assetLogDate'];
    }
    if (empty($checkoutDate)) {
      $checkoutDate = '';
    }
    echo $checkoutDate;
  }

  public static function getCheckoutRemarks($assetID) {
    global $connection;
    $sql = "SELECT `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "LEFT JOIN `remarks` ON `remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
    $sql .= "WHERE ((`assetLog`.`assetID` = $assetID) AND (`assetLog`.`txnTypeID` = 3))";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkoutRemarks = $row['remarksContent'];
    }
    if (empty($checkoutRemarks)) {
      $checkoutRemarks = '';
    }
    echo $checkoutRemarks;
  }

  public static function getDistinctAssetBrandAndModel() {
    global $connection;
    $sql = "SELECT DISTINCT `asset`.`brandID`, `asset`.`modelID`, `brand`.`brandName`, `model`.`modelName` ";
    $sql .= "FROM `brand` ";
    $sql .= "LEFT JOIN `asset` ON `asset`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `asset`.`modelID` = `model`.`modelID`";
    $sql = mysqli_query($connection, $sql);
    $num = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandID = $row['brandID'];
      $modelID = $row['modelID'];
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];

      echo "<tr>";
      echo "<td>{$num}</td>";
      echo "<td>{$brandName}&nbsp{$modelName}</td>";
      echo "<td><a href='assets.php?action=view&brand={$brandID}&model={$modelID}'>Show serials</a></td>";
      echo "</tr>";
      $num++;
    }
    
  }

  public static function getAssetList() {
    global $connection;
    $sql = "SELECT `asset`.`assetID`, `brand`.`brandName`, `model`.`modelName`, `serial`.`serialName`, `location`.`locationName` ";
    $sql .= "FROM `status` ";
    $sql .= "JOIN `asset` ON `asset`.`statusID` = `status`.`statusID` ";
    $sql .= "JOIN `brand` ON `asset`.`brandID` = `brand`.`brandID` ";
    $sql .= "JOIN `location` ON `asset`.`locationID` = `location`.`locationID` ";
    $sql .= "JOIN `model` ON `asset`.`modelID` = `model`.`modelID` ";
    $sql .= "JOIN `serial` ON `asset`.`serialID` = `serial`.`serialID` ";
    $sql .= "WHERE (`status`.`statusName` = 'Active') ";
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
      echo "<td><a href='assets.php?action=view&asset={$assetID}'>{$serialName}</a></td>";
      echo "<td>{$currentLocation}</td>";
      echo "</tr>";
      $num++;
    }
  }

  public static function getAssetNameByBrandIDAndModelID($brandID, $modelID) {
    global $connection;
    $sql = "SELECT DISTINCT `brand`.`brandName`, `model`.`modelName` ";
    $sql .= "FROM `brand` ";
    $sql .= "LEFT JOIN `asset` ON `asset`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `asset`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE `brand`.`brandID` = {$brandID} AND `model`.`modelID` = {$modelID}";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $assetName = $brandName.'&nbsp'.$modelName;
    }
    echo $assetName;
  }

  public static function getAssetNameByAssetID($assetID) {
    global $connection;
    $sql = "SELECT DISTINCT `brand`.`brandName`, `model`.`modelName` ";
    $sql .= "FROM `brand` ";
    $sql .= "LEFT JOIN `asset` ON `asset`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `asset`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE `asset`.`assetID` = {$assetID}";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $assetName = $brandName.'&nbsp'.$modelName;
    }
    echo $assetName;
  }

  public static function getAssetSerial($assetID) {
    global $connection;
    $sql = "SELECT `asset`.`assetID`, `serial`.`serialName` ";
    $sql .= "FROM `asset` ";
    $sql .= "LEFT JOIN `serial` ON `asset`.`serialID` = `serial`.`serialID` ";
    $sql .= "WHERE `asset`.`assetID` = {$assetID}";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $assetSerial = $row['serialName'];
    }
    echo $assetSerial;
  }

  public static function getAssetSerialList($brandID, $modelID) {
    global $connection;
    $sql = "SELECT `brand`.`brandName`, `model`.`modelName`, `serial`.`serialName`, `asset`.`assetID` ";
    $sql .= "FROM `serial` ";
    $sql .= "LEFT JOIN `asset` ON `asset`.`serialID` = `serial`.`serialID` ";
    $sql .= "LEFT JOIN `brand` ON `asset`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `asset`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE `brand`.`brandID` = {$brandID} AND `model`.`modelID` = {$modelID} AND `asset`.`statusID` = 1";
    $sql = mysqli_query($connection, $sql);
    $num = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $serialName = $row['serialName'];
      $assetID = $row['assetID'];

      echo "<tr>";
      echo "  <td>$num</td>";
      echo "  <td>{$serialName}</td>";
      echo "  <td><a href='assets.php?action=details&asset={$assetID}'>Details</a></td>";
      echo "</tr>";
      $num++;
    }
  }

  public static function getAssetCurrentLocation($assetID) {
    global $connection;
    $sql = "SELECT `asset`.`assetID`, `location`.`locationName` ";
    $sql .= "FROM `asset` ";
    $sql .= "LEFT JOIN `location` ON `asset`.`locationID` = `location`.`locationID` ";
    $sql .= "WHERE (`asset`.`assetID` = $assetID)";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $currentLocation = $row['locationName'];
    }
    echo $currentLocation;
  }

  public static function getArchivedAssetList() {
    global $connection;
    $sql = "SELECT `asset`.`assetID`, `brand`.`brandName`, `model`.`modelName`, `serial`.`serialName` ";
    $sql .= "FROM `status` ";
    $sql .= "LEFT JOIN `asset` ON `asset`.`statusID` = `status`.`statusID` ";
    $sql .= "LEFT JOIN `brand` ON `asset`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `asset`.`modelID` = `model`.`modelID` ";
    $sql .= "LEFT JOIN `serial` ON `asset`.`serialID` = `serial`.`serialID` ";
    $sql .= "WHERE (`status`.`statusID` = 2) "; 
    $sql .= "ORDER BY `brand`.`brandName` ASC, `model`.`modelName` ASC, `serial`.`serialName` ASC";
    $sql = mysqli_query($connection, $sql);
    $num = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $assetID = $row['assetID'];
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $serialName = $row['serialName'];
      echo "<tr>";
      echo "  <td>{$num}</td>";
      echo "  <td>{$brandName}&nbsp{$modelName}</td>";
      echo "  <td><a href='assets.php?action=details&asset={$assetID}'>{$serialName}</a></td>";
      echo "</tr>";
      $num++;
    }
  }

  public static function isArchived($assetID) {
    global $connection;
    $sql = "SELECT `asset`.`assetID`, `status`.`statusName` ";
    $sql .= "FROM `asset` ";
    $sql .= "LEFT JOIN `status` ON `asset`.`statusID` = `status`.`statusID` ";
    $sql .= "WHERE (`asset`.`assetID` = {$assetID})";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $assetStatus = $row['statusName'];
    }
    if ($assetStatus == 'Archived') {
      return true;
    } else {
      return false;
    }
  }

  public static function disableInputOnArchivedAsset($assetID) {
    if (Asset::isArchived($assetID)) {
      echo "readonly";
    }
  }

  public static function searchAssetBySerial($searchString) {
    global $connection;
    $sql = "SELECT `asset`.`assetID`, `status`.`statusName`, `serial`.`serialName`, `brand`.`brandName`, `model`.`modelName` ";
    $sql .= "FROM `serial` ";
    $sql .= "LEFT JOIN `asset` ON `asset`.`serialID` = `serial`.`serialID` ";
    $sql .= "LEFT JOIN `status` ON `asset`.`statusID` = `status`.`statusID` ";
    $sql .= "LEFT JOIN `brand` ON `asset`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `asset`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE `serial`.`serialName` LIKE '%{$searchString}%'";
    $sql = mysqli_query($connection, $sql);
    if (mysqli_num_rows($sql) > 1) {
      echo "      <h1>Serial Search Results</h1>";
      echo "<table class='table table-striped table-hover'>";
      echo "  <thead>";
      echo "    <tr>";
      echo "    </tr>";
      echo "  </thead>";
      echo "  <tbody>";
      while ($row = mysqli_fetch_assoc($sql)) {
        $assetID = $row['assetID'];
        $brandName = $row['brandName'];
        $modelName = $row['modelName'];
        $serialName = $row['serialName'];
        
        echo "    <tr>";
        echo "      <td>{$brandName}&nbsp{$modelName}&nbsp<a href='assets.php?action=details&asset={$assetID}'>{$serialName}</a></td>";
        echo "    </tr>";
      }
      echo "  </tbody>";
      echo "</table>";
      } elseif (mysqli_num_rows($sql) == 1) {
          while ($row = mysqli_fetch_assoc($sql)) {
            $assetID = $row['assetID'];
          }
        header("Location: assets.php?action=details&asset={$assetID}");
      } else {
        echo "<h1>Serial Search Results</h1>";
        echo "<p>No result</p>";
      }
  }
}
?>