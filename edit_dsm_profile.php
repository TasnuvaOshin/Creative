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

$id =$_GET['id'];
$name = $_GET['name'];
$email = $_GET['email'];
$role = $_GET['role'];
$smname = $_GET['smname'];
$pass = $_GET['pass'];
$pin = $_GET['pin'];
$region = $_GET['region'];
$mobile = $_GET['mobile'];

$tbl_name   = "rsm_profile";	
			$sql = "UPDATE `dsm_profile` SET `name`='$name',`email`='$email',`mobile_no`='$mobile',`role`='$role',`sm`='$smname',`password`='$pass',`pin_code`='$pin',`region`='$region' WHERE ffc='$id'";
          
		    mysqli_set_charset($db_connect,"utf8");
		    $result = mysqli_query($db_connect,$sql);
		
     
			if($result){
				echo "{'id': 'updated'}";
				
			}
else {
	echo "{'id': 'not'}";
		
	
}
			
			

?>