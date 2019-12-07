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
mysqli_set_charset($db_connect,"utf8");

 				$s_tbl_name   = "dsm_profile";
		    	$sql = "SELECT * FROM $s_tbl_name WHERE user_id = '$user_id'";
			    $result = mysqli_query($db_connect,$sql);
               if ($result->num_rows >0) {

     $rows = array();
     while($row = $result->fetch_assoc()) {
             $rows[] = $row;
              
     }
     echo json_encode($rows);
 }
              
     else{
         
         echo 'Can not able to handle result';
     }  








?>