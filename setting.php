<?php
define('HOST', 'mysql.hostinger.ru');
define('USER', 'u899608781_vic1');
define('PASS', '4589qW');
define('DB', 'u899608781_reg');
$CONNECT = mysqli_connect(HOST,USER,PASS) or die("Error: not connect this server");
$SELECT_DB = mysqli_select_db($CONNECT,DB) or die("Error: not connect database");
?>