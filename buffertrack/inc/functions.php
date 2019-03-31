<?php
function trimInput($input){
  $a = trim(htmlspecialchars($input));
  return $a;
}

function validateForm($request, $redirect){
  global $connection;
  global $sql;
  foreach ($request as $key => $value) {
    if (empty($value)) {
      echo "<h6>$key is empty.</h6></n>";
      $pass = 0;
    }
  }
  if (isset($pass) && $pass == 0) {
    echo "<h6>Please correct the error.</h6>";
  } else {
    $sql = mysqli_query($connection, $sql);
    echo "Data submitted. Redirecting...";
    echo "<script>window.setTimeout(function() {window.location = '$redirect'; }, 2000);</script>";
    if (!$sql) {
      die('Failed to submit. '.mysqli_error($connection));
    }
  }
}

function getLocationType($locationID){
  global $connection;
  $sql = "SELECT locationTypeID FROM location WHERE locationID = {$locationID}";
  $sql = mysqli_query($connection, $sql);
  while ($row = mysqli_fetch_assoc($sql)) {
    $locationType = $row['locationTypeID'];
  }
  return $locationType;
}

function validateTransitForm($request, $redirect){
  global $connection;
  $logDate = trimInput($request['logDate']);
  $assetID = trimInput($request['assetID']);
  $txnTypeID = trimInput($request['txnTypeID']);
  $locationID = trimInput($request['locationID']);
  $remarkContent = trimInput($request['remarkContent']);

  if (empty($remarkContent)) {
    if (empty($logDate)) {
      echo "<h6>Date is empty.</h6></n>";
      $pass = 0;
    }
    if (empty($assetID)) {
      echo "<h6>Asset is empty.</h6></n>";
      $pass = 0;
    }
    if (empty($txnTypeID)) {
      echo "<h6>Transit is empty.</h6></n>";
      $pass = 0;
    }
    if (empty($locationID)) {
      echo "<h6>Location is empty.</h6></n>";
      $pass = 0;
    }
  }

  if (isset($pass) && $pass == 0) {
    echo "<h6>Please correct the error.</h6>";
  }
  elseif ($txnTypeID == 2 && getLocationType($locationID) == 1) {
    //insert into log - update assetstatus to 0 where assetID is ...
    $sql1 = "INSERT INTO log(logdate, assetID, txnTypeID, locationID) ";
    $sql1 .= "VALUES('{$logDate}', '{$assetID}', '{$txnTypeID}', '{$locationID}')";
    $sql2 = "UPDATE asset SET assetStatus = 0 WHERE assetID = {$assetID}";
    mysqli_begin_transaction($connection);
    if (mysqli_query($connection, $sql1) && mysqli_query($connection, $sql2)) {
      mysqli_commit($connection);
      echo "Data submitted. Redirecting...";
      echo "<script>window.setTimeout(function() {window.location = '$redirect'; }, 2000);</script>";
    } else {
      mysqli_rollback($connection);
    }
  }
  elseif ($remarkContent == "") {
    $sql = "INSERT INTO log(logDate, assetID, txnTypeID, locationID) ";
    $sql .= "VALUES('{$logDate}', '{$assetID}', '{$txnTypeID}', '{$locationID}')";
    if (mysqli_query($connection, $sql)){
      echo "Data submitted. Redirecting...";
      echo "<script>window.setTimeout(function() {window.location = '$redirect'; }, 2000);</script>";
    } else {
      die('Failed to submit. '.mysqli_error($connection));
    }
  } 
  elseif ($remarkContent != "") {
    $sql1 = "INSERT INTO log(logDate, assetID, txnTypeID, locationID) ";
    $sql1 .= "VALUES ('{$logDate}', '{$assetID}', '{$txnTypeID}', '{$locationID}')";
    $sql2 = "INSERT INTO remarks(logID, remarkContent) ";
    $sql2 .= "VALUES (LAST_INSERT_ID(), '{$remarkContent}')";
    mysqli_begin_transaction($connection);
    if (mysqli_query($connection, $sql1) && mysqli_query($connection, $sql2)) {
      mysqli_commit($connection);
      echo "Data submitted. Redirecting...";
      echo "<script>window.setTimeout(function() {window.location = '$redirect'; }, 2000);</script>";
    } else {
      mysqli_rollback($connection);
    } 
  }
}
?>