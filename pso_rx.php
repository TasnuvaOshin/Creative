<?php

header('Content-Type: application/json');
header('charset=utf-8');
$DatabaseName = "vision";
$HostPass  = "1stApril2013";
$HostUser = "vision_admin";
$HostName ="LocalHost";


$psoffc = $_GET['psoffc'];

$pso = $_GET['pso'];
$product = $_GET['product'];
$team = $_GET['team'];
$region = $_GET['region'];
$f_date = $_GET['f_date'];
$t_date = $_GET['t_date'];
$brand = $_GET['brand'];



    // Create connection
    $db_connect = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

    if ($db_connect->connect_error) {

     die("Connection failed: " . $conn->connect_error);
    } 

               mysqli_set_charset($db_connect,"utf8"); 
                  $s_tbl_name   = "rx_data";
				  
				  
				  
				  if (((strlen($product) == 0) && (strlen($brand) == 0)))
				{
           //when only date given pso under all data will show 1 
	
	
				$sql = "SELECT * FROM $s_tbl_name WHERE pso_ffc ='$psoffc' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				$rows = array();
                while($row = $result->fetch_assoc()) {
                 $rows[] = $row;
              }
               echo json_encode($rows);
 
				
				
				
				}
				  
				  
				 	  if (((strlen($product) == 0)  && (strlen($brand) != 0)))
				{
           //when brand and  date given Sm under all data will show 2
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE pso_ffc = '$psoffc'  AND n_date BETWEEN '$f_date' AND '$t_date' AND (product_1 LIKE '%$brand%' OR product_2 LIKE '%$brand%' OR product_3 LIKE '%$brand%'OR product_4 LIKE '%$brand%'OR product_5 LIKE '%$brand%')";
				$result = mysqli_query($db_connect,$sql);
				
				$rows = array();
                while($row = $result->fetch_assoc()) {
               $rows[] = $row;
              
               }
              echo json_encode($rows);
				} 
				  
				  
			  
		
					     
				  
				  
				    if (((strlen($product) != 0) && (strlen($brand) != 0)))
				{
           //when all given show 8
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE pso_ffc = '$psoffc'  AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				$rows = array();
                while($row = $result->fetch_assoc()) {
               $rows[] = $row;
              
               }
              echo json_encode($rows);
				} 
				  
				  
				
				  
				  
				    if (((strlen($product) != 0)  && (strlen($brand) == 0)))
				{
           //when brand and  date given Sm under all data will show 2
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE pso_ffc = '$psoffc'  AND n_date BETWEEN '$f_date' AND '$t_date' AND (product_1 LIKE '%$product%' OR product_2 LIKE '%$product%' OR product_3 LIKE '%$product%'OR product_4 LIKE '%$product%'OR product_5 LIKE '%$product%')";
				$result = mysqli_query($db_connect,$sql);
				
				$rows = array();
                while($row = $result->fetch_assoc()) {
               $rows[] = $row;
              
               }
              echo json_encode($rows);
				} 
				  
				  
		
				  
				  
				  
				  
				  ?>