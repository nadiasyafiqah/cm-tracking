<?php
class DAL {

  public static function Error() {
    global $connection;
    $error = mysqli_error($connection);
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Failed. ".$error."<br>";
    echo "</div>";
  }

  public static function ErrorNo() {
    global $connection;
    $error = mysqli_error($connection);
    echo "<div class='alert alert-danger' role='alert'>";
    echo "Failed. ".$error."<br>";
    echo "</div>";
  }

  public static function addAsset($request) {
    global $connection;
    $assetLogDate = $request['assetLogDate'];
    $brandID = $request['brandID'];
    $modelID = $request['modelID'];
    $serialName = $request['serialName'];
    $remarksContent = $request['remarksContent'];
    $locationID = $request['locationID'];

    $requiredField = array("Date"=>"$assetLogDate", "Brand"=>"$brandID", "Model"=>"$modelID", "Serial"=>"$serialName", "Check-in Store"=>"$locationID");
    foreach ($requiredField as $field => $value) {
      if ($value == '') {    
        echo "<div class='alert alert-warning' role='alert'>";
        echo "{$field} is empty.<br>";
        echo "</div>";
      }
    }

    if (empty($remarksContent)) {
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `serial`(`serialName`) VALUES ('{$serialName}')";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        $error = DAL::ErrorNo();
        if ($error = 1062) {
          echo "<div class='alert alert-warning' role='alert'>";
          echo "Serial already exist<br>";
          echo "</div>";
        }
      }
      $serialID = mysqli_insert_id($connection); //get serialID

      $sql2 = "INSERT INTO `asset`(`brandID`, `modelID`, `locationID`, `serialID`, `statusID`) ";
      $sql2 .= "VALUES ('{$brandID}', '{$modelID}', '{$locationID}', '{$serialID}', 1)";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        echo DAL::ErrorNo();
      }
      $assetID = mysqli_insert_id($connection); //get assetID

      $sql3 = "INSERT INTO `assetLog`(`assetLogDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql3.= "VALUES ('{$assetLogDate}', '{$locationID}', '{$assetID}', 1, 1)";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        echo DAL::ErrorNo();
      }

      if ($sql1 && $sql2 && $sql3) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } else {
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `serial`(`serialName`) VALUES ('{$serialName}')";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        echo DAL::ErrorNo();
      }
      $serialID = mysqli_insert_id($connection); //get serialID

      $sql2 = "INSERT INTO `asset`(`brandID`, `modelID`, `locationID`, `serialID`, `statusID`) ";
      $sql2 .= "VALUES ('{$brandID}', '{$modelID}', '{$locationID}', '{$serialID}', 1)";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }
      $assetID = mysqli_insert_id($connection); //get assetID

      $sql3 = "INSERT INTO `assetLog`(`assetLogDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql3.= "VALUES ('{$assetLogDate}', '{$locationID}', '{$assetID}', 1, 1)";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        DAL::Error();
      }
      $assetLogID = mysqli_insert_id($connection); //get assetLogID

      $sql4 = "INSERT INTO `remarks`(`remarksContent`) VALUES ('{$remarksContent}')";
      $sql4 = mysqli_query($connection, $sql4);
      if (!$sql4) {
        DAL::Error();
      }
      $remarksID = mysqli_insert_id($connection); //get remarksID

      $sql5 = "INSERT INTO `assetLog_has_remarks`(`assetLogID`, `remarksID`) VALUES ('{$assetLogID}', '{$remarksID}')";
      $sql5 = mysqli_query($connection, $sql5);
      if ($sql1 && $sql2 && $sql3 && $sql4 && $sql5) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    }
  
  }
    
    
public static function addParts($request) {
    global $connection;
    $sparepartID = $request['sparePartID'];
    $brandID = $request['brandID'];
    $modelID = $request['modelID'];
    $serialName = $request['serialID'];
    $sparePartTypeID = $request['sparePartTypeID'];
    $statusID = $request['statusID'];
    $sparePartLogDate = $request['sparePartLogDate'];

    $requiredField = array("Date"=>"$sparePartLogDate", "Brand"=>"$brandID", "Model"=>"$modelID", "Serial"=>"$serialName", "location"=>"$locationID");
    foreach ($requiredField as $field => $value) {
      if ($value == '') {    
        echo "<div class='alert alert-warning' role='alert'>";
        echo "{$field} is empty.<br>";
        echo "</div>";
      }
    }

    if (empty($remarksContent)) {
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `serial`(`serialName`) VALUES ('{$serialName}')";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        $error = DAL::ErrorNo();
        if ($error = 1062) {
          echo "<div class='alert alert-warning' role='alert'>";
          echo "Serial already exist<br>";
          echo "</div>";
        }
      }
      $serialID = mysqli_insert_id($connection); //get serialID

      $sql2 = "INSERT INTO `sparepart`(`sparePartID`,`brandID`, `modelID`, `locationID`, `seriallID`, `sparePartTypeID`, `statusID`) ";
      $sql2 .= "VALUES ('{$brandID}', '{$modelID}', '{$locationID}', '{$serialID}', 1)";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        echo DAL::ErrorNo();
      }
      $assetID = mysqli_insert_id($connection); //get assetID

      $sql3 = "INSERT INTO `sparepartLog`(`sparePartLogDate`, `locationID`, `sparePartID`, `txnTypeID`, `userID`) ";
      $sql3.= "VALUES ('{$sparePartLogDate}', '{$locationID}', '{$sparePartID}', 1, 1)";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        echo DAL::ErrorNo();
      }

      if ($sql1 && $sql2 && $sql3) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } else {
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `serial`(`serialName`) VALUES ('{$serialName}')";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        echo DAL::ErrorNo();
      }
      $serialID = mysqli_insert_id($connection); //get serialID

      $sql2 = "INSERT INTO `sparepart`(`brandID`, `modelID`, `locationID`, `serialID`, `statusID`) ";
      $sql2 .= "VALUES ('{$brandID}', '{$modelID}', '{$locationID}', '{$serialID}', 1)";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }
      $assetID = mysqli_insert_id($connection); //get assetID

      $sql3 = "INSERT INTO `sparepartLog`(`sparePartLogDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql3.= "VALUES ('{$sparePartLogDate}', '{$locationID}', '{$assetID}', 1, 1)";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        DAL::Error();
      }
      $assetLogID = mysqli_insert_id($connection); //get assetLogID

      $sql4 = "INSERT INTO `remarks`(`remarksContent`) VALUES ('{$remarksContent}')";
      $sql4 = mysqli_query($connection, $sql4);
      if (!$sql4) {
        DAL::Error();
      }
      $remarksID = mysqli_insert_id($connection); //get remarksID

      $sql5 = "INSERT INTO `sparePartLog_has_remarks`(`sparePartLogID`, `remarksID`) VALUES ('{$sparePartLogID}', '{$remarksID}')";
      $sql5 = mysqli_query($connection, $sql5);
      if ($sql1 && $sql2 && $sql3 && $sql4 && $sql5) {
        mysqli_commit($connection);
      }
        
        else {
        mysqli_rollback($connection);
      }
    }
  
  }

  public static function updateAssetCheckoutDetails($request, $assetID) {
    global $connection;
    $checkoutDate = $_POST['checkoutDate'];
    $checkoutLocation = $_POST['checkoutLocation'];
    $checkoutRemarks = $_POST['checkoutRemarks'];

    $sql = "SELECT `assetLog`.`assetLogID`, `assetLog`.`txnTypeID`, `assetLog`.`assetID` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "WHERE `assetLog`.`txnTypeID` = 3 AND `assetLog`.`assetID` = {$assetID}";
    $sql = mysqli_query($connection, $sql);
    if (mysqli_num_rows($sql) > 0) {
      $assetHasCheckoutData = true;
    } else {
      $assetHasCheckoutData = false;
    }
    if (!$assetHasCheckoutData && empty($checkoutRemarks)) { // if no database result & checkoutRemarks field is empty
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `assetLog`(`assetLogDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql1 .= "VALUES ('{$checkoutDate}', '{$checkoutLocation}', '{$assetID}', 3, 1)";
      $sql1 = mysqli_query($connection, $sql1);
        if (!$sql) {
          DAL::Error();
        }
      $sql2 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `statusID` = 2 ";
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
      $sql1 = "INSERT INTO `assetLog`(`assetLogDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql1 .= "VALUES ('{$checkoutDate}', '{$checkoutLocation}', '{$assetID}', 3, 1)";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $assetLogID = mysqli_insert_id($connection); //get assetLogID

      $sql2 = "INSERT INTO `remarks`(`remarksContent`) ";
      $sql2 .= "VALUES ('{$checkoutRemarks}')";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }
      $remarksID = mysqli_insert_id($connection); //get remarksID

      $sql3 = "INSERT INTO `assetLog_has_remarks`(`assetLogID`, `remarksID`) VALUES ('{$assetLogID}', '{$remarksID}')";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        DAL::Error();
      }

      $sql4 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `statusID` = 2 ";
      $sql4 .= "WHERE `assetID` = {$assetID}";
      $sql4 = mysqli_query($connection, $sql4);
      if (!$sql4) {
        DAL::Error();
      }

      if ($sql1 && $sql2 && $sql3 && $sql4) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } elseif ($assetHasCheckoutData && empty($checkoutRemarks)) { //if exists database result & checkoutRemarks is empty
      mysqli_begin_transaction($connection);
      $sql1 = "UPDATE `assetLog` SET `assetLogDate` = '{$checkoutDate}', `locationID` = '{$checkoutLocation}' ";
      $sql1 .= "WHERE `assetLog`.`assetID` = {$assetID} AND `assetLog`.`txnTypeID` = 3";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $sql2 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `statusID` = 2 ";
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
      $sql1 = "SELECT `assetLog`.`assetLogID`, `assetLog`.`assetID`, `assetLog`.`txnTypeID` ";
      $sql1 .= "FROM `assetLog` ";
      $sql1 .= "WHERE `assetLog`.`txnTypeID` = 3 AND `assetLog`.`assetID` = {$assetID}";
      $sql1 = mysqli_query($connection, $sql1);
      while ($row = mysqli_fetch_assoc($sql1)) {
        $assetLogID = $row['assetLogID'];
      }

      $sql2 = "SELECT `remarks`.`remarksContent`, `assetLog`.`assetID`, `assetLog`.`txnTypeID` ";
      $sql2 .= "FROM `remarks` ";
      $sql2 .= "LEFT JOIN `assetLog` ON `remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
      $sql2 .= "WHERE `assetLog`.`assetID`= {$assetID} AND `assetLog`.`txnTypeID` = 3";
      $sql2 = mysqli_query($connection, $sql2);
      if (mysqli_num_rows($sql2) > 0) {
        $assetHascheckoutRemarks = true;
      } else {
        $assetHascheckoutRemarks = false;
      }

      if ($assetHascheckoutRemarks == true) {
        mysqli_begin_transaction($connection);
        $sql3 = "UPDATE `assetLog` SET `assetLogDate` = '{$checkoutDate}', `locationID` = '{$checkoutLocation}' ";
        $sql3 .= "WHERE `assetLog`.`assetID` = {$assetID} AND `assetLog`.txnTypeID = 3";
        $sql3 = mysqli_query($connection, $sql3);
        if (!$sql3) {
          DAL::Error();
        }

        $sql4 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `statusID` = 2 ";
        $sql4 .= "WHERE `assetID` = {$assetID}";
        $sql4 = mysqli_query($connection, $sql4);
        if (!$sql4) {
          DAL::Error();
        }

        $sql5 = "UPDATE `remarks` SET `remarksContent` = '{$checkoutRemarks}' ";
        $sql5 .= "WHERE `assetLogID` = {$assetLogID}";
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
        $sql3 = "UPDATE `assetLog` SET `assetLogDate` = '{$checkoutDate}', `locationID` = '{$checkoutLocation}' ";
        $sql3 .= "WHERE `assetLog`.`assetID` = {$assetID} AND `assetLog`.txnTypeID = 3";
        $sql3 = mysqli_query($connection, $sql3);
        if (!$sql3) {
          DAL::Error();
        }

        $sql4 = "UPDATE `asset` SET `locationID` = {$checkoutLocation}, `statusID` = 2 ";
        $sql4 .= "WHERE `assetID` = {$assetID}";
        $sql4 = mysqli_query($connection, $sql4);
        if (!$sql4) {
          DAL::Error();
        }

        $sql5 = "INSERT INTO `remarks`(`assetLogID`, `remarksContent`) ";
        $sql5 .= "VALUES ('{$assetLogID}', '{$checkoutRemarks}')";
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

    $sql = "SELECT `assetLog`.`assetLogID`, `assetLog`.`txnTypeID`, `assetLog`.`assetID` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "WHERE `assetLog`.`txnTypeID` = 2 AND `assetLog`.`assetID` = {$assetID}";
    $sql = mysqli_query($connection, $sql);
    if (mysqli_num_rows($sql) > 0) {
      $assetHasTransferData = true;
    } else {
      $assetHasTransferData = false;
    }
    if (!$assetHasTransferData && empty($transferRemarks)) { // if no database result & transferRemarks field is empty
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `assetLog`(`assetLogDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
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
      $sql1 = "INSERT INTO `assetLog`(`assetLogDate`, `locationID`, `assetID`, `txnTypeID`, `userID`) ";
      $sql1 .= "VALUES ('{$transferDate}', '{$transferLocation}', '{$assetID}', 2, 1)";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $assetLogID = mysqli_insert_id($connection); //get assetLogID

      $sql2 = "INSERT INTO `remarks`(`remarksContent`) ";
      $sql2 .= "VALUES ('{$transferRemarks}')";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }
      $remarksID = mysqli_insert_id($connection); //get remarksID

      $sql3 = "INSERT INTO `assetLog_has_remarks`(`assetLogID`, `remarksID`) VALUES ('{$assetLogID}', '{$remarksID}')";
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

      if ($sql1 && $sql2 && $sql3 && $sql4) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } elseif ($assetHasTransferData && empty($transferRemarks)) { //if exists database result & transferRemarks are empty
      mysqli_begin_transaction($connection);
      $sql1 = "UPDATE `assetLog` SET `assetLogDate` = '{$transferDate}', `locationID` = '{$transferLocation}' ";
      $sql1 .= "WHERE `assetLog`.`assetID` = {$assetID} AND `assetLog`.`txnTypeID` = 2";
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

      $sql3 = "SELECT `assetLog`.`assetLogID`, `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `remarks`.`remarksID`, `remarks`.`remarksContent` ";
      $sql3 .= "FROM `assetLog` ";
      $sql3 .= "JOIN `assetLog_has_remarks` ON `assetLog_has_remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
      $sql3 .= "JOIN `remarks` ON `assetLog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
      $sql3 .= "WHERE (`assetLog`.`assetID` = {$assetID}) ";
      $sql3 .= "AND   (`assetLog`.`txnTypeID` = 2)";
      $sql3 = mysqli_query($connection, $sql3);
      while ($row = mysqli_fetch_assoc($sql3)) {
        $remarksID = $row['remarksID'];
      }
      $sql4 = "DELETE FROM `remarks` WHERE `remarks`.`remarksID` = '{$remarksID}'";
      $sql4 = mysqli_query($connection, $sql4);
      if ($sql1 && $sql2 && $sql3 && $sql4) {
        mysqli_commit($connection);
      } else {
        mysqli_rollback($connection);
      }
    } else { //if exists database result & transferRemarks not empty
      $sql1 = "SELECT `assetLog`.`assetLogID`, `assetLog`.`assetID`, `assetLog`.`txnTypeID` ";
      $sql1 .= "FROM `assetLog` ";
      $sql1 .= "WHERE `assetLog`.`txnTypeID` = 2 AND `assetLog`.`assetID` = {$assetID}";
      $sql1 = mysqli_query($connection, $sql1);
      while ($row = mysqli_fetch_assoc($sql1)) {
        $assetLogID = $row['assetLogID'];
      }

      $sql2 = "SELECT `assetLog`.`assetLogID`, `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `remarks`.`remarksID`, `remarks`.`remarksContent` ";
      $sql2 .= "FROM `assetLog` ";
      $sql2 .= "JOIN `assetLog_has_remarks` ON `assetLog_has_remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
      $sql2 .= "JOIN `remarks` ON `assetLog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
      $sql2 .= "WHERE (`assetLog`.`assetID` = {$assetID}) ";
      $sql2 .= "AND   (`assetLog`.`txnTypeID` = 2)";
      $sql2 = mysqli_query($connection, $sql2);
      if (mysqli_num_rows($sql2) > 0) {
        $assetHasTransferRemarks = true;
      } else {
        $assetHasTransferRemarks = false;
      }

      if ($assetHasTransferRemarks == true) {
        mysqli_begin_transaction($connection);
        $sql3 = "UPDATE `assetLog` SET `assetLogDate` = '{$transferDate}', `locationID` = '{$transferLocation}' ";
        $sql3 .= "WHERE `assetLog`.`assetID` = {$assetID} AND `assetLog`.txnTypeID = 2";
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

        //search for corresponding remarksID by asset's logID
        $sql5 = "SELECT `assetLog`.`assetID`, `assetLog`.`assetLogID`, `assetLog`.`txnTypeID`, `remarks`.`remarksID` ";
        $sql5 .= "FROM `assetLog` ";
        $sql5 .= "JOIN `assetLog_has_remarks` ON `assetLog_has_remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
        $sql5 .= "JOIN `remarks` ON `assetLog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
        $sql5 .= "WHERE (`assetLog`.`assetID` = {$assetID}) ";
        $sql5 .= "AND   (`assetLog`.`txnTypeID` = 2)";
        $sql5 = mysqli_query($connection, $sql5);
        while ($row = mysqli_fetch_assoc($sql5)) {
          $remarksID = $row['remarksID'];
        }
        
        $sql6 = "UPDATE `remarks` SET `remarksContent` = '{$transferRemarks}' ";
        $sql6 .= "WHERE `remarksID` = {$remarksID}";
        $sql6 = mysqli_query($connection, $sql6);
        if (!$sql6) {
          DAL::Error();
        }

        if ($sql3 && $sql4 && $sql5 && $sql6) {
          mysqli_commit($connection);
        } else {
          mysqli_rollback($connection);
        }

      } else {
        mysqli_begin_transaction($connection);
        $sql6 = "UPDATE `assetLog` SET `assetLogDate` = '{$transferDate}', `locationID` = '{$transferLocation}' ";
        $sql6 .= "WHERE `assetLog`.`assetID` = {$assetID} AND `assetLog`.txnTypeID = 2";
        $sql6 = mysqli_query($connection, $sql6);
        if (!$sql6) {
          DAL::Error();
        }

        $sql7 = "UPDATE `asset` SET `locationID` = {$transferLocation} ";
        $sql7 .= "WHERE `assetID` = {$assetID}";
        $sql7 = mysqli_query($connection, $sql7);
        if (!$sql7) {
          DAL::Error();
        }

        $sql8 = "INSERT INTO `remarks`(`remarksContent`) ";
        $sql8 .= "VALUES ('{$transferRemarks}')";
        $sql8 = mysqli_query($connection, $sql8);
        if (!$sql8) {
          DAL::Error();;
        }
        $remarksID = mysqli_insert_id($connection); //get remarksID

        $sql9 = "INSERT INTO `remarks`(`remarksContent`) ";
        $sql9 .= "VALUES ('{$transferRemarks}')";
        $sql9 = mysqli_query($connection, $sql9);
        if (!$sql9) {
          DAL::Error();
        }
        $remarksID = mysqli_insert_id($connection); //get remarksID

        $sql10 = "INSERT INTO `assetLog_has_remarks`(`assetLogID`, `remarksID`) VALUES ('{$assetLogID}', '{$remarksID}')";
        $sql10 = mysqli_query($connection, $sql10);
        if (!$sql10) {
          DAL::Error();
        }

        if ($sql6 && $sql7 && $sql8 && $sql9 && $sql10) {
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

    $sql = "SELECT `assetLog`.`assetLogID`, `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `remarks`.`remarksID`, `remarks`.`remarksContent` ";
    $sql .= "FROM `assetLog` ";
    $sql .= "JOIN `assetLog_has_remarks` ON `assetLog_has_remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
    $sql .= "JOIN `remarks` ON `assetLog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
    $sql .= "WHERE (`assetLog`.`assetID` = {$assetID}) ";
    $sql .= "AND   (`assetLog`.`txnTypeID` = 1)";
    $sql = mysqli_query($connection, $sql);
    if (mysqli_num_rows($sql) > 0) {
      $assetHasCheckinRemarks = true;
    } else {
      $assetHasCheckinRemarks = false;
    }

    $sql2 = "SELECT `assetLog`.`assetLogID`, `asset`.`assetID`, `assetLog`.`txnTypeID` ";
    $sql2 .= "FROM `assetLog` ";
    $sql2 .= "JOIN `asset` ON `assetLog`.`assetID` = `asset`.`assetID` ";
    $sql2 .= "WHERE `asset`.`assetID` = {$assetID} AND `assetLog`.`txnTypeID` = 1";
    $sql2 = mysqli_query($connection, $sql2);
    if (mysqli_num_rows($sql2) > 0) {
      while ($row = mysqli_fetch_assoc($sql2)) {
        $assetLogID = $row['assetLogID'];
      }
    }

    if (($assetHasCheckinRemarks == false && empty($checkinRemarks))) {
      $sql1 = "UPDATE `assetLog` SET `assetLogDate` = '{$checkinDate}', `locationID` = {$checkinLocation} ";
      $sql1 .= "WHERE `assetID` = {$assetID} AND  `txnTypeID` = 1";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        die('Failed. '.mysqli_error($connection));
      }
    } elseif ($assetHasCheckinRemarks == true && !empty($checkinRemarks)) {
      //fetch assetlog ada remarksid 

      $sql2 = "SELECT `assetLog`.`assetID`, `assetLog`.`assetLogID`, `assetLog`.`txnTypeID`, `remarks`.`remarksID` ";
      $sql2 .= "FROM `assetLog` ";
      $sql2 .= "JOIN `assetLog_has_remarks` ON `assetLog_has_remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
      $sql2 .= "JOIN `remarks` ON `assetLog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
      $sql2 .= "WHERE (`assetLog`.`assetID` = {$assetID}) ";
      $sql2 .= "AND   (`assetLog`.`txnTypeID` = 1)";
      $sql2 = mysqli_query($connection, $sql2);
      while ($row = mysqli_fetch_assoc($sql2)) {
        $remarksID = $row['remarksID'];
      }
      
      $sql3 = "UPDATE `remarks` SET `remarksContent` = '{$checkinRemarks}' ";
      $sql3 .= "WHERE `remarksID` = {$remarksID}";
      $sql3 = mysqli_query($connection, $sql3);
      if (!$sql3) {
        DAL::Error();
      }
    } elseif (($assetHasCheckinRemarks == true && empty($checkinRemarks))) {
        mysqli_begin_transaction($connection);
        $sql1 = "UPDATE `assetLog` SET `assetLogDate` = '{$checkinDate}', `locationID` = {$checkinLocation} ";
        $sql1 .= "WHERE `assetID` = {$assetID} AND  `txnTypeID` = 1";
        $sql1 = mysqli_query($connection, $sql1);
        if (!$sql1) {
          die('Failed. '.mysqli_error($connection));
        }

        $sql2 = "SELECT `assetLog`.`assetLogID`, `assetLog`.`assetID`, `assetLog`.`txnTypeID`, `remarks`.`remarksID`, `remarks`.`remarksContent` ";
        $sql2 .= "FROM `assetLog` ";
        $sql2 .= "JOIN `assetLog_has_remarks` ON `assetLog_has_remarks`.`assetLogID` = `assetLog`.`assetLogID` ";
        $sql2 .= "JOIN `remarks` ON `assetLog_has_remarks`.`remarksID` = `remarks`.`remarksID` ";
        $sql2 .= "WHERE (`assetLog`.`assetID` = {$assetID}) ";
        $sql2 .= "AND   (`assetLog`.`txnTypeID` = 1)";
        $sql2 = mysqli_query($connection, $sql2);
        while ($row = mysqli_fetch_assoc($sql2)) {
          $remarksID = $row['remarksID'];
        }
        $sql3 = "DELETE FROM `remarks` WHERE `remarks`.`remarksID` = '{$remarksID}'";
        $sql3 = mysqli_query($connection, $sql3);
        if ($sql1 && $sql2 && $sql3) {
          mysqli_commit($connection);
        } else {
          mysqli_rollback($connection);
        }
    } else {
      mysqli_begin_transaction($connection);
      $sql1 = "INSERT INTO `remarks`(`remarksContent`) ";
      $sql1 .= "VALUES ('{$checkinRemarks}')";
      $sql1 = mysqli_query($connection, $sql1);
      if (!$sql1) {
        DAL::Error();
      }
      $remarksID = mysqli_insert_id($connection); //get remarksID

      $sql2 = "INSERT INTO `assetLog_has_remarks`(`assetLogID`, `remarksID`) VALUES ('{$assetLogID}', '{$remarksID}')";
      $sql2 = mysqli_query($connection, $sql2);
      if (!$sql2) {
        DAL::Error();
      }

      if ($sql1 && $sql2) {
          mysqli_commit($connection);
        } else {
          mysqli_rollback($connection);
        }
    }
  }
}
?>