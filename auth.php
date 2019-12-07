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

$user_id = $_GET['id'];
$user_pass = $_GET['pass'];

 				$s_tbl_name   = "user_credentials";
		    	$sql = "SELECT * FROM $s_tbl_name WHERE user_id = '$user_id' AND password = '$user_pass'";
			    $result = mysqli_query($db_connect,$sql);
                $row_cnt = mysqli_num_rows($result);
				if( $row_cnt > 0 ){

		
					  while($row = $result->fetch_assoc()) {
        
			 
			 
                           $role = $row['role'];

                    
              
     }
	  echo "{'role':'$role'}";

				}
				else {

					echo "{'role':'invalid'}";
				}
				

//we will get password and user id from url and then check the data is there or not if there then we will get the role as response.













?>