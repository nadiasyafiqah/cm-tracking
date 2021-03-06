<?php
class Form {
  public static function getCheckoutLocationIntoSelect($assetID) {
    global $connection;
    $sql1 = "SELECT `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `location`.`locationName`, `location`.`locationID` ";
    $sql1 .= "FROM `assetLog` ";
    $sql1 .= "JOIN `location` ON `assetLog`.`locationID` = `location`.`locationID` ";
    $sql1 .= "WHERE ((`assetLog`.`assetID` = $assetID) AND (`assetLog`.`txnTypeID` = 3))";
    $sql1 = mysqli_query($connection, $sql1);
    while ($row = mysqli_fetch_assoc($sql1)) {
      echo $assetLocationID = $row['locationID'];
    }

    if (isset($assetLocationID)) {
      $sql2 = "SELECT `location`.`locationName`, `location`.`locationTypeID`, `location`.`locationID` ";
      $sql2 .= "FROM `location` ";
      //$sql2 .= "WHERE (`location`.`locationTypeID` = 1) ";
      $sql2 .= "ORDER BY `location`.`locationName` ASC";
      $sql2 = mysqli_query($connection, $sql2);
      while ($row = mysqli_fetch_assoc($sql2)) {
        $locationName = $row['locationName'];
        echo $locationID = $row['locationID'];
        echo "<option ";
        if ($assetLocationID == $locationID) {
          echo "selected ";
        }
        echo "value='$locationID'>$locationName</option>";
      }
    } else {
      $sql2 = "SELECT `location`.`locationName`, `location`.`locationTypeID`, `location`.`locationID` ";
      $sql2 .= "FROM `location` ";
      //$sql2 .= "WHERE (`location`.`locationTypeID` = 1) ";
      $sql2 .= "ORDER BY `location`.`locationName` ASC";
      $sql2 = mysqli_query($connection, $sql2);
      echo "<option></option>";
      while ($row = mysqli_fetch_assoc($sql2)) {
        $locationName = $row['locationName'];
        $locationID = $row['locationID'];
        echo "<option value='$locationID'>$locationName</option>";
      }
    }
  }

  public static function getCheckinLocationIntoSelect($assetID) {
    global $connection;
    $sql1 = "SELECT `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `location`.`locationName`, `location`.`locationID` ";
    $sql1 .= "FROM `assetLog` ";
    $sql1 .= "LEFT JOIN `location` ON `assetLog`.`locationID` = `location`.`locationID` ";
    $sql1 .= "WHERE ((`assetLog`.`assetID` = $assetID) AND (`assetLog`.`txnTypeID` = 1))";
    $sql1 = mysqli_query($connection, $sql1);
    while ($row = mysqli_fetch_assoc($sql1)) {
      $assetLocationID = $row['locationID'];
    }

    if (isset($assetLocationID)) {
      $sql2 = "SELECT `location`.`locationName`, `location`.`locationTypeID`, `location`.`locationID` ";
      $sql2 .= "FROM `location` ";
      $sql2 .= "WHERE (`location`.`locationTypeID` = 2) ";
      $sql2 .= "ORDER BY `location`.`locationName` ASC";
      $sql2 = mysqli_query($connection, $sql2);
      while ($row = mysqli_fetch_assoc($sql2)) {
        $locationName = $row['locationName'];
        $locationID = $row['locationID'];
        echo "<option ";
        if ($assetLocationID == $locationID) {
          echo "selected ";
        }
        echo "value='$locationID'>$locationName</option>";
      }
    } else {
      $sql2 = "SELECT `location`.`locationName`, `location`.`locationTypeID`, `location`.`locationID` ";
      $sql2 .= "FROM `location` ";
      $sql2 .= "WHERE (`location`.`locationTypeID` = 2) ";
      $sql2 .= "ORDER BY `location`.`locationName` ASC";
      $sql2 = mysqli_query($connection, $sql2);
      echo "<option></option>";
      while ($row = mysqli_fetch_assoc($sql2)) {
        $locationName = $row['locationName'];
        $locationID = $row['locationID'];
        echo "<option value='$locationID'>$locationName</option>";
      }
    }
  }


  public static function getTransferLocationIntoSelect($assetID) {
    global $connection;
    $sql1 = "SELECT `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `location`.`locationName`, `location`.`locationID` ";
    $sql1 .= "FROM `assetLog` ";
    $sql1 .= "LEFT JOIN `location` ON `assetLog`.`locationID` = `location`.`locationID` ";
    $sql1 .= "WHERE ((`assetLog`.`assetID` = $assetID) AND (`assetLog`.`txnTypeID` = 2))";
    $sql1 = mysqli_query($connection, $sql1);
    while ($row = mysqli_fetch_assoc($sql1)) {
      $assetLocationID = $row['locationID'];
    }
    
    if (isset($assetLocationID)) {
      $sql2 = "SELECT `location`.`locationName`, `location`.`locationTypeID`, `location`.`locationID` ";
      $sql2 .= "FROM `location` ";
      $sql2 .= "WHERE (`location`.`locationTypeID` = 2) ";
      $sql2 .= "ORDER BY `location`.`locationName`";
      $sql2 = mysqli_query($connection, $sql2);
      while ($row = mysqli_fetch_assoc($sql2)) {
        $locationName = $row['locationName'];
        $locationID = $row['locationID'];
        echo "<option ";
        if ($assetLocationID == $locationID) {
          echo "selected ";
        }
        echo "value='$locationID'>$locationName</option>";
      }
    } else {
      $sql2 = "SELECT `location`.`locationName`, `location`.`locationTypeID`, `location`.`locationID` ";
      $sql2 .= "FROM `location` ";
      $sql2 .= "WHERE (`location`.`locationTypeID` = 2) ";
      $sql2 .= "ORDER BY `location`.`locationName`";
      $sql2 = mysqli_query($connection, $sql2);
      echo "<option></option>";
      while ($row = mysqli_fetch_assoc($sql2)) {
        $locationName = $row['locationName'];
        $locationID = $row['locationID'];
        echo "<option value='$locationID'>$locationName</option>";
      }
    }  
  }

  public static function getBrandListIntoSelect($scope) {
    global $connection;
    $sql = "SELECT `brand`.`brandID`, `brand`.`brandName` ";
    $sql .= "FROM `brand` ";
    $sql .= "WHERE `scopeID` = {$scope} ";
    $sql .= "ORDER by `brand`.`brandName` ASC";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $brandID = $row['brandID'];
      $brandName = $row['brandName'];
      echo "<option value='$brandID'>$brandName</option>";
    }
  }

  public static function getModelListIntoSelect($scope) {
    global $connection;
    $sql = "SELECT `model`.`modelID`, `model`.`modelName` ";
    $sql .= "FROM `model` ";
    $sql .= "WHERE `scopeID` = {$scope} ";
    $sql .= "ORDER BY `model`.`modelName` ASC";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $modelID = $row['modelID'];
      $modelName = $row['modelName'];
      echo "<option value='$modelID'>$modelName</option>";
    }
  }

  public static function getStoreListIntoSelect() {
    global $connection;
    $sql = "SELECT `location`.`locationID`, `state`.`stateName`, `location`.`locationName`, `location`.`locationTypeID` ";
    $sql .= "FROM `state` ";
    $sql .= "JOIN `location` ON `location`.`stateID` = `state`.`stateID` ";
    $sql .= "WHERE `location`.`locationTypeID` = 2 ";
    $sql .= "ORDER BY `location`.`locationTypeID` ASC, `state`.`stateName` ASC, `location`.`locationName` ASC";
    $sql = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($sql)) {
      $locationID = $row['locationID'];
      $locationName = $row['locationName'];
      echo "<option value='$locationID'>$locationName</option>";
    }
  }

  public static function printMsg($alertType, $msg) {
    echo "<div class='alert alert-{$alertType}' role='alert'>";
    echo "{$msg}".'<br>';
    echo "</div>";
  }
}
?>