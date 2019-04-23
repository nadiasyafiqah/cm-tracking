<?php
class DAL {

  public static function Error() {
    global $connection;
    $error = mysqli_error($connection);
    echo "Failed. ".$error."<br>";
  }

  public static function ErrorNo() {
    global $connection;
    $error = mysqli_errno($connection);
    return $error."<br>";
  }

  public static function addAssetWithoutRemarks($request) {
    global $connection;
    $logDate = $request['logDate'];
    $brandID = $request['brandID'];
    $modelID = $request['modelID'];
    $serialName = $request['serialName'];
    $remarksContent = $request['remarksContent'];
    $locationID = $request['locationID'];

    $requiredField = array("Date"=>"$logDate", "Brand"=>"$brandID", "Model"=>"$modelID", "Serial"=>"$serialName", "Check-in Store"=>"$locationID");
    foreach ($requiredField as $field => $value) {
      if ($value == '') {
        echo "{$field} is empty.<br>";
      }
    }
  
    mysqli_begin_transaction($connection);
    $sql1 = "INSERT INTO `serial`(`serialName`) VALUES ('{$serialName}')";
    $sql1 = mysqli_query($connection, $sql1);
    if (!$sql1) {
      $error = DAL::ErrorNo();
      if ($error = 1062) {
        echo "Serial already exist<br>";
      }
    }
    $serialID = mysqli_insert_id($connection); //get serialID
    $sql2 = "INSERT INTO `asset`(`brandID`, `modelID`, `locationID`, `serialID`, `assetStatusID`) ";
    $sql2 .= "VALUES ('{$brandID}', '{$modelID}', '{$locationID}', '{$serialID}', 1)";
    $sql2 = mysqli_query($connection, $sql2);
    if (!$sql2) {
      echo "Failed. Error ".DAL::ErrorNo();
    }
    $assetID = mysqli_insert_id($connection); //get assetID
    $sql3 = "INSERT INTO `log`(`logDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
    $sql3.= "VALUES ('{$logDate}', '{$locationID}', '{$assetID}', 1, 1)";
    $sql3 = mysqli_query($connection, $sql3);
    if (!$sql3) {
      echo "Failed. Error ".DAL::ErrorNo();
    }

    if ($sql1 && $sql2 && $sql3) {
      mysqli_commit($connection);
    } else {
      mysqli_rollback($connection);
    }
  }

  public static function addAssetWithRemarks($request) {
    global $connection;
    $logDate = $request['logDate'];
    $brandID = $request['brandID'];
    $modelID = $request['modelID'];
    $serialName = $request['serialName'];
    $remarksContent = $request['remarksContent'];
    $locationID = $request['locationID'];

    mysqli_begin_transaction($connection);
    $sql1 = "INSERT INTO `serial`(`serialName`) VALUES ('{$serialName}')";
    $sql1 = mysqli_query($connection, $sql1);
    if (!$sql1) {
      echo "Failed. Error".DAL::ErrorNo();
    }

    $serialID = mysqli_insert_id($connection); //get serialID
    $sql2 = "INSERT INTO `asset`(`brandID`, `modelID`, `locationID`, `serialID`, `assetStatusID`) ";
    $sql2 .= "VALUES ('{$brandID}', '{$modelID}', '{$locationID}', '{$serialID}', 1)";
    $sql2 = mysqli_query($connection, $sql2);
    if (!$sql2) {
      DAL::Error();
    }

    $assetID = mysqli_insert_id($connection); //get assetID
    $sql3 = "INSERT INTO `log`(`logDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
    $sql3.= "VALUES ('{$logDate}', '{$locationID}', '{$assetID}', 1, 1)";
    $sql3 = mysqli_query($connection, $sql3);
    if (!$sql3) {
      DAL::Error();
    }

    $logID = mysqli_insert_id($connection); //get logID
    $sql4 = "INSERT INTO `remarks`(`logID`, `remarksContent`) VALUES ('{$logID}', '{$remarksContent}')";
    $sql4 = mysqli_query($connection, $sql4);
    if (!$sql4) {
      DAL::Error();
    }

    if ($sql1 && $sql2 && $sql3 && $sql4) {
      mysqli_commit($connection);
    } else {
      mysqli_rollback($connection);
    }
  }

  public static function updateAssetCheckoutDetails($request, $assetID) {
    global $connection;
    $checkoutDate = $_POST['checkoutDate'];
    $checkoutLocation = $_POST['checkoutLocation'];
    $checkoutRemarks = $_POST['checkoutRemarks'];

    $sql = "SELECT `log`.`logID`, `log`.`txnTypeID`, `log`.`assetID` ";
    $sql .= "FROM `log` ";
    $sql .= "WHERE `log`.`txnTypeID` = 3 AND `log`.`assetID` = {$assetID}";
    $sql = mysqli_query($connection, $sql);
    if (mysqli_num_rows($sql) > 0) {
      $assetHasCheckoutData = true;
    } else {
      $assetHasCheckoutData = false;
    }
    if (!$assetHasCheckoutData && empty($checkoutRemarks)) { // if no database result & checkoutRemarks field is empty
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `log`(`logDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql1 .= "VALUES ('{$checkoutDate}', '{$checkoutLocation}', '{$assetID}', 3, 1)";
      $sql1 = mysqli_query($connection, $sql1);
        if (!$sql) {
          DAL::Error();
        }
      $sql2 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `assetStatusID` = 2 ";
      $sql2 .= "WHERE `assetID` = {$assetID}";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }
      if ($sql1 && $sql2) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } elseif (!$assetHasCheckoutData && !empty($checkoutRemarks)) { //if no database result & checkoutRemarks is not empty
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `log`(`logDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql1 .= "VALUES ('{$checkoutDate}', '{$checkoutLocation}', '{$assetID}', 3, 1)";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $logID = mysqli_insert_id($connection);

      $sql2 = "INSERT INTO `remarks`(`logID`, `remarksContent`) ";
      $sql2 .= "VALUES ('{$logID}', '{$checkoutRemarks}')";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }

      $sql3 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `assetStatusID` = 2 ";
      $sql3 .= "WHERE `assetID` = {$assetID}";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        DAL::Error();
      }

      if ($sql1 && $sql2 && $sql3) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } elseif ($assetHasCheckoutData && empty($checkoutRemarks)) { //if exists database result & checkoutRemarks is empty
      mysqli_begin_transaction($connection);
      $sql1 = "UPDATE `log` SET `logDate` = '{$checkoutDate}', `locationID` = '{$checkoutLocation}' ";
      $sql1 .= "WHERE `log`.`assetID` = {$assetID} AND `log`.`txnTypeID` = 3";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $sql2 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `assetStatusID` = 2 ";
      $sql2 .= "WHERE `assetID` = {$assetID}";
      $sql2 = mysqli_query($sql3);
      if (!$sql2) {
        DAL::Error();
      }

      if ($sql1 && $sql2) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } else { //check for $assetHasCheckoutData && empty($checkoutRemarks)
      $sql1 = "SELECT `log`.`logID`, `log`.`assetID`, `log`.`txnTypeID` ";
      $sql1 .= "FROM `log` ";
      $sql1 .= "WHERE `log`.`txnTypeID` = 3 AND `log`.`assetID` = {$assetID}";
      $sql1 = mysqli_query($connection, $sql1);
      while ($row = mysqli_fetch_assoc($sql1)) {
        $logID = $row['logID'];
      }

      $sql2 = "SELECT `remarks`.`remarksContent`, `log`.`assetID`, `log`.`txnTypeID` ";
      $sql2 .= "FROM `remarks` ";
      $sql2 .= "LEFT JOIN `log` ON `remarks`.`logID` = `log`.`logID` ";
      $sql2 .= "WHERE `log`.`assetID`= {$assetID} AND `log`.`txnTypeID` = 3";
      $sql2 = mysqli_query($connection, $sql2);
      if (mysqli_num_rows($sql2) > 0) {
        $assetHascheckoutRemarks = true;
      } else {
        $assetHascheckoutRemarks = false;
      }

      if ($assetHascheckoutRemarks == true) {
        mysqli_begin_transaction($connection);
        $sql3 = "UPDATE `log` SET `logDate` = '{$checkoutDate}', `locationID` = '{$checkoutLocation}' ";
        $sql3 .= "WHERE `log`.`assetID` = {$assetID} AND `log`.txnTypeID = 3";
        $sql3 = mysqli_query($connection, $sql3);
        if (!$sql3) {
          DAL::Error();
        }

        $sql4 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `assetStatusID` = 2 ";
        $sql4 .= "WHERE `assetID` = {$assetID}";
        $sql4 = mysqli_query($connection, $sql4);
        if (!$sql4) {
          DAL::Error();
        }

        $sql5 = "UPDATE `remarks` SET `remarksContent` = '{$checkoutRemarks}' ";
        $sql5 .= "WHERE `logID` = {$logID}";
        $sql5 = mysqli_query($connection, $sql5);
        if (!$sql5) {
          DAL::Error();
        }

        if ($sql3 && $sql4 && $sql5) {
          mysqli_commit($connection);
        } else {
          DAL::Error();
        }
      } else {
        mysqli_begin_transaction($connection);
        $sql3 = "UPDATE `log` SET `logDate` = '{$checkoutDate}', `locationID` = '{$checkoutLocation}' ";
        $sql3 .= "WHERE `log`.`assetID` = {$assetID} AND `log`.txnTypeID = 3";
        $sql3 = mysqli_query($connection, $sql3);
        if (!$sql3) {
          DAL::Error();
        }

        $sql4 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `assetStatusID` = 2 ";
        $sql4 .= "WHERE `assetID` = {$assetID}";
        $sql4 = mysqli_query($connection, $sql4);
        if (!$sql4) {
          DAL::Error();
        }

        $sql5 = "INSERT INTO `remarks`(`logID`, `remarksContent`) ";
        $sql5 .= "VALUES ('{$logID}', '{$checkoutRemarks}')";
        $sql5 = mysqli_query($connection, $sql5);
        if (!$sql5) {
          DAL::Error();
        }

        if ($sql3 && $sql4 && $sql5) {
          mysqli_commit($connection);
        } else {
          mysqli_rollback($connection);
        }
      }
      
    }
  }

  public static function updateAssetTransferDetails($request, $assetID) {
    global $connection;
    $transferDate = $request['transferDate'];
    $transferLocation = $request['transferLocation'];
    $transferRemarks = $request['transferRemarks'];

    $sql = "SELECT `log`.`logID`, `log`.`txnTypeID`, `log`.`assetID` ";
    $sql .= "FROM `log` ";
    $sql .= "WHERE `log`.`txnTypeID` = 2 AND `log`.`assetID` = {$assetID}";
    $sql = mysqli_query($connection, $sql);
    if (mysqli_num_rows($sql) > 0) {
      $assetHasTransferData = true;
    } else {
      $assetHasTransferData = false;
    }
    if (!$assetHasTransferData && empty($transferRemarks)) { // if no database result & transferRemarks field is empty
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `log`(`logDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql1 .= "VALUES ('{$transferDate}', '{$transferLocation}', '{$assetID}', 2, 1)";
      $sql1 = mysqli_query($connection, $sql1);
        if (!$sql) {
          DAL::Error();
        }
      $sql2 = "UPDATE `asset` SET `locationID` = {$transferLocation} ";
      $sql2 .= "WHERE `assetID` = {$assetID}";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }
      if ($sql1 && $sql2) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } elseif (!$assetHasTransferData && !empty($transferRemarks)) { //if no database result & transferRemarks is not empty
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `log`(`logDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql1 .= "VALUES ('{$transferDate}', '{$transferLocation}', '{$assetID}', 2, 1)";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $logID = mysqli_insert_id($connection);

      $sql2 = "INSERT INTO `remarks`(`logID`, `remarksContent`) ";
      $sql2 .= "VALUES ('{$logID}', '{$transferRemarks}')";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }

      $sql3 = "UPDATE `asset` SET `locationID` = {$transferLocation} ";
      $sql3 .= "WHERE `assetID` = {$assetID}";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        DAL::Error();
      }

      if ($sql1 && $sql2 && $sql3) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } elseif ($assetHasTransferData && empty($transferRemarks)) { //if exists database result & transferRemarks is empty
      mysqli_begin_transaction($connection);
      $sql1 = "UPDATE `log` SET `logDate` = '{$transferDate}', `locationID` = '{$transferLocation}' ";
      $sql1 .= "WHERE `log`.`assetID` = {$assetID} AND `log`.`txnTypeID` = 2";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $sql2 = "UPDATE `asset` SET `locationID` = {$transferLocation} ";
      $sql2 .= "WHERE `assetID` = {$assetID}";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }

      if ($sql1 && $sql2) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } else {
      $sql1 = "SELECT `log`.`logID`, `log`.`assetID`, `log`.`txnTypeID` ";
      $sql1 .= "FROM `log` ";
      $sql1 .= "WHERE `log`.`txnTypeID` = 2 AND `log`.`assetID` = {$assetID}";
      $sql1 = mysqli_query($connection, $sql1);
      while ($row = mysqli_fetch_assoc($sql1)) {
        $logID = $row['logID'];
      }

      $sql2 = "SELECT `remarks`.`remarksContent`, `log`.`assetID`, `log`.`txnTypeID` ";
      $sql2 .= "FROM `remarks` ";
      $sql2 .= "LEFT JOIN `log` ON `remarks`.`logID` = `log`.`logID` ";
      $sql2 .= "WHERE `log`.`assetID`= {$assetID} AND `log`.`txnTypeID` = 2";
      $sql2 = mysqli_query($connection, $sql2);
      if (mysqli_num_rows($sql2) > 0) {
        $assetHasTransferRemarks = true;
      } else {
        $assetHasTransferRemarks = false;
      }

      if ($assetHasTransferRemarks == true) {
        mysqli_begin_transaction($connection);
        $sql3 = "UPDATE `log` SET `logDate` = '{$transferDate}', `locationID` = '{$transferLocation}' ";
        $sql3 .= "WHERE `log`.`assetID` = {$assetID} AND `log`.txnTypeID = 2";
        $sql3 = mysqli_query($connection, $sql3);
        if (!$sql3) {
          DAL::Error();
        }

        $sql4 = "UPDATE `asset` SET `locationID` = {$transferLocation} ";
        $sql4 .= "WHERE `assetID` = {$assetID}";
        $sql4 = mysqli_query($connection, $sql4);
        if (!$sql4) {
          DAL::Error();
        }

        $sql5 = "UPDATE `remarks` SET `remarksContent` = '{$transferRemarks}' ";
        $sql5 .= "WHERE `logID` = {$logID}";
        $sql5 = mysqli_query($connection, $sql5);
        if (!$sql5) {
          DAL::Error();
        }

        if ($sql3 && $sql4 && $sql5) {
          mysqli_commit($connection);
        } else {
          mysqli_rollback($connection);
        }
      } else {
        mysqli_begin_transaction($connection);
        $sql3 = "UPDATE `log` SET `logDate` = '{$transferDate}', `locationID` = '{$transferLocation}' ";
        $sql3 .= "WHERE `log`.`assetID` = {$assetID} AND `log`.txnTypeID = 2";
        $sql3 = mysqli_query($connection, $sql3);
        if (!$sql3) {
          DAL::Error();
        }

        $sql4 = "UPDATE `asset` SET `locationID` = {$transferLocation} ";
        $sql4 .= "WHERE `assetID` = {$assetID}";
        $sql4 = mysqli_query($connection, $sql4);
        if (!$sql4) {
          DAL::Error();
        }

        $sql5 = "INSERT INTO `remarks`(`logID`, `remarksContent`) ";
        $sql5 .= "VALUES ('{$logID}', '{$transferRemarks}')";
        $sql5 = mysqli_query($connection, $sql5);
        if (!$sql5) {
          DAL::Error();;
        }

        if ($sql3 && $sql4 && $sql5) {
          mysqli_commit($connection);
        } else {
          mysqli_rollback($connection);
        }
      }
      
    }
  }

  public static function updateAssetCheckinDetails($request, $assetID) {
    global $connection;
    $checkinDate = $request['checkinDate'];
    $checkinLocation = $request['checkinLocation'];
    $checkinRemarks = $request['checkinRemarks'];

    $sql = "SELECT `asset`.`assetID`, `log`.`txnTypeID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `log` ";
    $sql .= "JOIN `asset` ON `log`.`assetID` = `asset`.`assetID` ";
    $sql .= "JOIN `remarks` ON `remarks`.`logID` = `log`.`logID` ";
    $sql .= "WHERE `asset`.`assetID` = {$assetID} AND `log`.`txnTypeID` = 1";
    $sql = mysqli_query($connection, $sql);
    
    if (mysqli_num_rows($sql) > 0) {
      $assetHasCheckinRemarks = true;
    } else {
      $assetHasCheckinRemarks = false;
    }

    $sql2 = "SELECT `log`.`logID`, `asset`.`assetID`, `log`.`txnTypeID` ";
    $sql2 .= "FROM `log` ";
    $sql2 .= "JOIN `asset` ON `log`.`assetID` = `asset`.`assetID` ";
    $sql2 .= "WHERE `asset`.`assetID` = {$assetID} AND `log`.`txnTypeID` = 1";
    $sql2 = mysqli_query($connection, $sql2);
    if (mysqli_num_rows($sql2) > 0) {
      while ($row = mysqli_fetch_assoc($sql2)) {
        $logID = $row['logID'];
      }
    }

    if (($assetHasCheckinRemarks == false && empty($checkinRemarks)) || ($assetHasCheckinRemarks == true && empty($checkinRemarks))) {
      $sql1 = "UPDATE `log` SET `logDate` = '{$checkinDate}', `locationID` = {$checkinLocation} ";
      $sql1 .= "WHERE `assetID` = {$assetID} AND  `txnTypeID` = 1";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        die('Failed. '.mysqli_error($connection));
      }
    } elseif ($assetHasCheckinRemarks == true && !empty($checkinRemarks)) {
      $sql2 = "UPDATE `remarks` SET `remarksContent` = '{$checkinRemarks}' ";
      $sql2 .= "WHERE `logID` = {$logID}";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }
    } else {
      $sql1 = "INSERT INTO `remarks`(`logID`, `remarksContent`) ";
      $sql1 .= "VALUES ('{$logID}', '{$checkinRemarks}')";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
    }
  }
}
?>