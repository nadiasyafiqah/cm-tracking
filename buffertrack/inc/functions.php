<?php
function checkSql($redirect){
  global $connection;
  global $sql;
  if ($sql) {
      echo 'Data Submitted. Redirecting...';
      echo "<script>window.setTimeout(function() {window.location = '$redirect'; }, 2000);</script>";
    } else {
      die('Failed to submit. '.mysqli_error($connection));
    }
}
?>