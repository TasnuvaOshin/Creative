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


$dsmname = $_GET['dsmname'];
$dsmffc = $_GET['dsmffc'];
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
$team = $_GET['team'];


 				$s_tbl_name   = "dsm_profile";
		    	$sql = "SELECT * FROM $s_tbl_name WHERE name = '$dsmname'";
			    $result = mysqli_query($db_connect,$sql);
                $row_cnt = mysqli_num_rows($result);
				if( $row_cnt > 0 ){
					  while($row = $result->fetch_assoc()) {
                          $sm = $row['sm']; 
                         $smffc = $row['smffc']; 
						 $rsmname = $row['rsmname'];
						 $rsmffc = $row['rsmffc'];
     }
				}
	 
	
	 $sql2 = "INSERT INTO pso_profile(name,email,mobile_no,role,sm,sm_ffc,rsm,rsm_ffc,user_id,pin_code,ffc,region,head_quarter,depot,dsm,dsm_ffc,team) VALUES ('$name','$email','$mobile','$role','$sm','$smffc','$rsmname','$rsmffc','$uid','$pin','$ffc','$reg','$head','$depo','$dsmname','$dsmffc','$team')";
				$result2 = mysqli_query($db_connect,$sql2);
				
				
				if($result2){
					echo "{'id': 'saved'}";
				}else {
					echo "{'id': 'not'}";
					
				}
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
					













?>