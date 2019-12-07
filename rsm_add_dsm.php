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

$rsmname = $_GET['rsmname'];
$rsmffc = $_GET['rsmffc'];
$name = $_GET['name']; 
$email = $_GET['email']; 
$ffc = $_GET['ffc']; 
$uid = $_GET['uid']; 
$pin = $_GET['pin']; 
$reg = $_GET['ureg']; 
$role = $_GET['role']; 
$mobile = $_GET['mobile']; 
$depo = $_GET['depo']; 
$head = $_GET['head']; 

 				$s_tbl_name   = "rsm_profile";
		    	$sql = "SELECT * FROM $s_tbl_name WHERE name = '$rsmname'";
			    $result = mysqli_query($db_connect,$sql);
                $row_cnt = mysqli_num_rows($result);
				if( $row_cnt > 0 ){
					  while($row = $result->fetch_assoc()) {
                           $smffc = $row['sm_ffc'];
						   $sm = $row['sm'];
     }
	 
	 $sql2 = "INSERT INTO dsm_profile(name,email,mobile_no,role,sm,sm_ffc,rsm,rsm_ffc,user_id,pin_code,ffc,region,head_quarter,depot) VALUES ('$name','$email','$mobile','$role','$sm','$smffc','$rsmname','$rsmffc','$uid','$pin','$ffc','$reg','$head','$depo')";
				$result2 = mysqli_query($db_connect,$sql2);
				
				
				if($result2){
					echo "{'id': 'saved'}";
				}else {
					echo "{'id': 'not'}";
					
				}

				
				}		















?>