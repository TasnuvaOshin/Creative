<?php

header('Content-Type: application/json');
header('charset=utf-8');
$DatabaseName = "vision";
$HostPass  = "1stApril2013";
$HostUser = "vision_admin";
$HostName ="LocalHost";
ini_set('display_errors', 1);
error_reporting(-1);


    // Create connection
    $db_connect = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

    if ($db_connect->connect_error) {

     die("Connection failed: " . $conn->connect_error);
    } 

               mysqli_set_charset($db_connect,"utf8"); 

 				$s_tbl_name   = "team";
		    	$sql = "SELECT * FROM $s_tbl_name";
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