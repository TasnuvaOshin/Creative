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

$tbl_name   = "rsm_profile";	
			$sql = "DELETE FROM `rsm_profile` WHERE ffc='$id'";
          
		    mysqli_set_charset($db_connect,"utf8");
		    $result = mysqli_query($db_connect,$sql);
		
     
			if($result){
				echo "{'id': 'removed'}";
				
			}
else {
	echo "{'id': 'not'}";
		
	
}
			
			

?>