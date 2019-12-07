<?php
header('Content-Type: application/json');
include('connection.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // Create connection


$name = $_GET['name']; 
$email = $_GET['email']; 
$sm = $_GET['sm']; 
$smffc = $_GET['smffc']; 
$ffc = $_GET['ffc']; 
$uid = $_GET['uid']; 
$pin = $_GET['pin']; 
$uregion = $_GET['ureg']; 
$role = $_GET['role']; 


$tbl_name   = "rsm_profile";
$sql = "insert into $tbl_name (name,email,mobile_no,role,sm,sm_ffc,user_id,pin_code,ffc,region) values('$name','$email','No Number Given','$role','$sm','$smffc','$uid','$pin','$ffc','$uregion')";
$result = mysql_query($sql) or die ( mysql_error() );

 
			if($result){
				echo "{'id': 'saved'}";
				
			}
else {
	echo "{'id': 'not'}";
		
	
}

?>