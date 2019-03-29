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

function validateFormSQLBegin($request, $redirect){
  global $connection;
  global $sql1;
  global $sql2;
  foreach ($request as $key => $value) {
    if (empty($value)) {
      echo "<h6>$key is empty.</h6></n>";
      $pass = 0;
    }
  }
  if (isset($pass) && $pass == 0) {
    echo "<h6>Please correct the error.</h6>";
  } else {
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