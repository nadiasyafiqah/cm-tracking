<?php
session_start();
//include 'css/function.css';
//include 'css/jquery.min.js';
//include 'css/bootstrap.min.js';
//include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/function.css">
  <script src="css/jquery.min.js"></script>
  <script src="css/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body {
    background-image: url("key.png");
    background-repeat: no-repeat;
    background-position: center ;
    
}
</style>
</head>

<body>
<div class="text-center">
  <h1>Keyless Lock Security Online System</h1> 
</div>

<form class="form-horizontal" action="act_login.php" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-8">
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-8"> 
      <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
    </div>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-8">
      <button type="submit" name="hantar" class="btn btn-primary btn-block">Submit</button>
    </div>
  </div>

</form>
    </body>
</html>
