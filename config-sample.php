<?php
define("INC_DIR", __DIR__.'/inc');
define("ASSETS_INC", INC_DIR.'/assets');
define("CLASS_DIR",__DIR__.'/class');

//database setting
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'trackingapp';

$connection = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

?>