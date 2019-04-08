<?php
define("INC_DIR", __DIR__.'/inc');
define("ASSETS_INC", INC_DIR.'/assets');
include_once(INC_DIR.'/functions.php');

//database setting
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'trackingapp';

$connection = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

?>