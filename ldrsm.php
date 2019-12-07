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



		    	$sql = "SELECT * FROM `rx_data` WHERE rsm_ffc ='$user_id' AND n_date >=(CURDATE() - INTERVAL 1 DAY )";
			    $result = mysqli_query($db_connect,$sql);
                
               $rowcount=mysqli_num_rows($result);
				
  
	               echo "{'id':'$rowcount'}";

				
				

//we will get password and user id from url and then check the data is there or not if there then we will get the role as response.













?>