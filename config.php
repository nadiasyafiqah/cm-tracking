<?php
//Database config
$db_hostname = 'localhost';
$db_username ='root';
$db_password = '';
$db_name = 'prodata';

$connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

if (!$connection) {
  die('Database connection failed' . mysqli_error($connection));
}

//Dir setting
define('ROOT', __DIR__.'/');
define('INCLUDE_DIR', __DIR__.'/inc/');
define('BT_INCLUDE_DIR', __DIR__.'/buffertrack/inc/');
define('BT_LAYOUT_DIR', __DIR__.'/buffertrack/inc/layouts/');
define('BT_CLASS_DIR', __DIR__.'/buffertrack/inc/class/');
?>