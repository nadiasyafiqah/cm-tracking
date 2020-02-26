<?php
class SparePart {

  public static function getCheckinDate($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepartlog`.`sparePartLogDate`, `sparepartlog`.`sparePartID`, `sparepartlog`.`txnTypeID` ";
    $sql .= "FROM `sparepartlog` ";
    $sql .= "WHERE sparepartlog.sparePartID = $sparePartID AND sparepartlog.txnTypeID = 1";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkinDate = $row['sparePartLogDate'];
    }
    if (empty($checkinDate)) {
      $checkinDate = '';
    }
    echo $checkinDate;
  }

  public static function getCheckinRemarks($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepartlog`.`sparePartLogID`, `sparepart`.`sparePartID`, `sparepartlog`.`txnTypeID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `sparepartlog` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepartlog`.`sparePartID` = `sparepart`.`sparePartID` ";
    $sql .= "LEFT JOIN `sparepartlog_has_remarks` ON `sparepartlog_has_remarks`.`sparePartLogID` = `sparepartlog`.`sparePartLogID` ";
    $sql .= "LEFT JOIN `remarks` ON `sparepartlog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
    $sql .= "WHERE (`sparepartlog`.`txnTypeID` = 1) ";
    $sql .= "AND (`sparepart`.`sparePartID` = $sparePartID)";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkinRemarks = $row['remarksContent'];
    }
    if (empty($checkinRemarks)) {
      $checkinRemarks = '';
    }
    echo $checkinRemarks;
  }

  public static function getTransferDate($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepartlog`.`sparePartLogDate`, `sparepartlog`.`sparePartID`, `sparepartlog`.`txnTypeID` ";
    $sql .= "FROM `sparepartlog` ";
    $sql .= "WHERE sparepartlog.sparePartID = $sparePartID AND sparepartlog.txnTypeID = 2";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $transferDate = $row['sparePartLogDate'];
    }
    if (empty($transferDate)) {
      $transferDate = '';
    }
    echo $transferDate;
  }

  public static function getTransferRemarks($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepartlog`.`sparePartLogID`, `sparepart`.`sparePartID`, `sparepartlog`.`txnTypeID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `sparepartlog` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepartlog`.`sparePartID` = `sparepart`.`sparePartID` ";
    $sql .= "LEFT JOIN `sparepartlog_has_remarks` ON `sparepartlog_has_remarks`.`sparePartLogID` = `sparepartlog`.`sparePartLogID` ";
    $sql .= "LEFT JOIN `remarks` ON `sparepartlog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
    $sql .= "WHERE (`sparepartlog`.`txnTypeID` = 2) ";
    $sql .= "AND   (`sparepart`.`sparePartID` = $sparePartID)";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $transferRemarks = $row['remarksContent'];
    }
    if (empty($transferRemarks)) {
      $transferRemarks = '';
    }
    echo $transferRemarks;
  }
  
  public static function getCheckoutDate($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepartlog`.`sparePartLogDate`, `sparepartlog`.`sparePartID`, `sparepartlog`.`txnTypeID` ";
    $sql .= "FROM `sparepartlog` ";
    $sql .= "WHERE sparepartlog.sparePartID = $sparePartID AND sparepartlog.txnTypeID = 3";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkoutDate = $row['sparePartLogDate'];
    }
    if (empty($checkoutDate)) {
      $checkoutDate = '';
    }
    echo $checkoutDate;
  }

  public static function getCheckoutRemarks($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepartlog`.`sparePartLogID`, `sparepart`.`sparePartID`, `sparepartlog`.`txnTypeID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `sparepartlog` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepartlog`.`sparePartID` = `sparepart`.`sparePartID` ";
    $sql .= "LEFT JOIN `sparepartlog_has_remarks` ON `sparepartlog_has_remarks`.`sparePartLogID` = `sparepartlog`.`sparePartLogID` ";
    $sql .= "LEFT JOIN `remarks` ON `sparepartlog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
    $sql .= "WHERE (`sparepartlog`.`txnTypeID` = 3) ";
    $sql .= "AND (`sparepart`.`sparePartID` = $sparePartID)";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $checkoutRemarks = $row['remarksContent'];
    }
    if (empty($checkoutRemarks)) {
      $checkoutRemarks = '';
    }
    echo $checkoutRemarks;
  }

  public static function getActiveSparePartBrandAndModel() {
    global $connection;
    $sql = "SELECT `brand`.`brandID`, `brand`.`brandName`, `model`.`modelID`, `model`.`modelName` ";
    $sql .= "FROM `sparepart` ";
    $sql .= "LEFT JOIN `brand` ON `sparepart`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `sparepart`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE (`sparepart`.`statusID` = 1)";
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
      echo "<td><a href='sparepart.php?action=viewsp&brand={$brandID}&model={$modelID}'>Show serials</a></td>";
      echo "</tr>";
      $num++;
    }
    
  }
  

  public static function getSparePartList() {
    global $connection;
    $sql = "SELECT `sparepart`.`sparePartID`, `brand`.`brandName`, `model`.`modelName`, `serial`.`serialName`, `location`.`locationName`, `spareparttype`.`sparePartTypeName` ";
    $sql .= "FROM `status` ";
    $sql .= "JOIN `sparepart` ON `sparepart`.`statusID` = `status`.`statusID` ";
    $sql .= "JOIN `brand` ON `sparepart`.`brandID` = `brand`.`brandID` ";
    $sql .= "JOIN `location` ON `sparepart`.`locationID` = `location`.`locationID` ";
    $sql .= "JOIN `model` ON `sparepart`.`modelID` = `model`.`modelID` ";
    $sql .= "JOIN `serial` ON `sparepart`.`serialID` = `serial`.`serialID` ";
    $sql .= "JOIN `spareparttype` ON `sparepart`.`sparePartTypeID`= `spareparttype`.`sparePartTypeID`";
    $sql .= "WHERE (`status`.`statusName` = 'Active') ";
    $sql .= "ORDER BY `brand`.`brandName` ASC, `model`.`modelName` ASC, `serial`.`serialName` ASC ";
    $sql = mysqli_query($connection, $sql);
    $num = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $sparePartID = $row['sparePartID'];
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $serialName = $row['serialName'];
      $currentLocation = $row['locationName'];
      echo "<tr>";
      echo "<td>{$num}</td>";
      echo "<td>{$brandName}</td>";
      echo "<td>{$modelName}</td>";
      echo "<td><a href='sparepart.php?action=viewsp&sparepart={$sparePartID}'>{$serialName}</a></td>";
      echo "<td>{$currentLocation}</td>";
      echo "</tr>";
      $num++;
    }
  }

  public static function getSparePartNameByBrandIDAndModelID($brandID, $modelID) {
    global $connection;
    $sql = "SELECT DISTINCT `brand`.`brandName`, `model`.`modelName` ";
    $sql .= "FROM `brand` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepart`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `sparepart`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE `brand`.`brandID` = {$brandID} AND `model`.`modelID` = {$modelID}";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $sparePartName = $brandName.'&nbsp'.$modelName;
    }
    echo $sparePartName;
  }

  public static function getSparePartNameBySparePartID($sparePartID) {
    global $connection;
    $sql = "SELECT DISTINCT `brand`.`brandName`, `model`.`modelName` ";
    $sql .= "FROM `brand` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepart`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `sparepart`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE `sparepart`.`sparePartID` = {$sparePartID}";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $sparepartName = $brandName.'&nbsp'.$modelName;
    }
    echo $sparepartName;
  }

  public static function getSparePartSerial($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepart`.`sparePartID`, `serial`.`serialName` ";
    $sql .= "FROM `sparepart` ";
    $sql .= "LEFT JOIN `serial` ON `sparepart`.`serialID` = `serial`.`serialID` ";
    $sql .= "WHERE `sparepart`.`sparePartID` = {$sparePartID}";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $sparepartSerial = $row['serialName'];
    }
    echo $sparepartSerial;
  }

  public static function getSparePartSerialList($brandID, $modelID) {
    global $connection;
    $sql = "SELECT `brand`.`brandName`, `model`.`modelName`, `serial`.`serialName`, `sparepart`.`sparePartID` ";
    $sql .= "FROM `serial` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepart`.`serialID` = `serial`.`serialID` ";
    $sql .= "LEFT JOIN `brand` ON `sparepart`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `sparepart`.`modelID` = `model`.`modelID` ";
    $sql .= "WHERE `brand`.`brandID` = {$brandID} AND `model`.`modelID` = {$modelID} AND `sparepart`.`statusID` = 1";
    $sql = mysqli_query($connection, $sql);
    $num = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $serialName = $row['serialName'];
      $sparePartID = $row['sparePartID'];

      echo "<tr>";
      echo "  <td>$num</td>";
      echo "  <td>{$serialName}</td>";
      echo "  <td><a href='sparepart.php?action=detailssp&sparepart={$sparePartID}'>Details</a></td>";
      echo "</tr>";
      $num++;
    }
  }

  public static function getSparePartCurrentLocation($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepart`.`sparePartID`, `location`.`locationName` ";
    $sql .= "FROM `sparepart` ";
    $sql .= "LEFT JOIN `location` ON `sparepart`.`locationID` = `location`.`locationID` ";
    $sql .= "WHERE (`sparepart`.`sparePartID` = $sparePartID)";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $currentLocation = $row['locationName'];
    }
    echo $currentLocation;
  }

  public static function getArchivedSparePartList() {
    global $connection;
    $sql = "SELECT `sparepart`.`sparePartID`, `brand`.`brandName`, `model`.`modelName`, `serial`.`serialName` ";
    $sql .= "FROM `status` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepart`.`statusID` = `status`.`statusID` ";
    $sql .= "LEFT JOIN `brand` ON `sparepart`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `sparepart`.`modelID` = `model`.`modelID` ";
    $sql .= "LEFT JOIN `serial` ON `sparepart`.`serialID` = `serial`.`serialID` ";
    $sql .= "WHERE (`status`.`statusID` = 2) "; 
    $sql .= "ORDER BY `brand`.`brandName` ASC, `model`.`modelName` ASC, `serial`.`serialName` ASC";
    $sql = mysqli_query($connection, $sql);
    $num = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
      $sparePartID = $row['sparePartID'];
      $brandName = $row['brandName'];
      $modelName = $row['modelName'];
      $serialName = $row['serialName'];
      echo "<tr>";
      echo "  <td>{$num}</td>";
      echo "  <td>{$brandName}&nbsp{$modelName}</td>";
      echo "  <td><a href='sparepart.php?action=detailssp&sparepart={$sparePartID}'>{$serialName}</a></td>";
      echo "</tr>";
      $num++;
    }
  }

  public static function isArchived($sparePartID) {
    global $connection;
    $sql = "SELECT `sparepart`.`sparePartID`, `status`.`statusName` ";
    $sql .= "FROM `sparepart` ";
    $sql .= "LEFT JOIN `status` ON `sparepart`.`statusID` = `status`.`statusID` ";
    $sql .= "WHERE (`sparepart`.`sparePartID` = {$sparePartID})";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $sparePartStatus = $row['statusName'];
    }
    if ($sparePartStatus == 'Archived') {
      return true;
    } else {
      return false;
    }
  }

  public static function disableInputOnArchivedSparePart($sparePartID) {
    if (SparePart::isArchived($sparePartID)) {
      echo "readonly";
    }
  }

  public static function searchSparePartBySerial($searchString) {
    global $connection;
    $sql = "SELECT `sparepart`.`sparePartID`, `status`.`statusName`, `serial`.`serialName`, `brand`.`brandName`, `model`.`modelName` ";
    $sql .= "FROM `serial` ";
    $sql .= "LEFT JOIN `sparepart` ON `sparepart`.`serialID` = `serial`.`serialID` ";
    $sql .= "LEFT JOIN `status` ON `sparepart`.`statusID` = `status`.`statusID` ";
    $sql .= "LEFT JOIN `brand` ON `sparepart`.`brandID` = `brand`.`brandID` ";
    $sql .= "LEFT JOIN `model` ON `sparepart`.`modelID` = `model`.`modelID` ";
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
        $sparePartID = $row['sparePartID'];
        $brandName = $row['brandName'];
        $modelName = $row['modelName'];
        $serialName = $row['serialName'];
        
        echo "    <tr>";
        echo "      <td>{$brandName}&nbsp{$modelName}&nbsp<a href='sparepart.php?action=detailssp&sparepart={$sparePartID}'>{$serialName}</a></td>";
        echo "    </tr>";
      }
      echo "  </tbody>";
      echo "</table>";
      } elseif (mysqli_num_rows($sql) == 1) {
          while ($row = mysqli_fetch_assoc($sql)) {
            $sparePartID = $row['sparePartID'];
          }
        header("Location: sparepart.php?action=detailssp&sparepart={$sparePartID}");
      } else {
        echo "<h1>Serial Search Results</h1>";
        echo "<p>No result</p>";
      }
  }
}
?>