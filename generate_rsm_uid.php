<?php
header('Content-Type: application/json');
$DatabaseName = "vision";
$HostPass  = "1stApril2013";
$HostUser = "vision_admin";
$HostName ="LocalHost";

    // Create connection
    $db_connect = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

    if ($db_connect->connect_error) {

     die("Connection failed: " . $conn->connect_error);
    } 


$tbl_name   = "rsm_profile";	
			$sql = "SELECT max(id) FROM $tbl_name";
		    $result = mysqli_query($db_connect,$sql);
			$result = mysqli_fetch_array($result);
			$id = $result[0]+1;			
			$value = $id;
			$user_name_value = 'RS-VS-'. $value;
echo "{'id': '$user_name_value'}";

?>