<?php
header('Content-Type: application/json');
$host       = "localhost";
$username   = "vision_admin";
$password = "1stApril2013";
$db_name = "vision";
mysql_connect("$host", "$username", "$password") or die ("cannot select DB");

mysql_select_db($db_name) or die ("cannot select DB");

?>