<?php

header('Content-Type: application/json');
header('charset=utf-8');
$DatabaseName = "vision";
$HostPass  = "1stApril2013";
$HostUser = "vision_admin";
$HostName ="LocalHost";


$rsm = $_GET['rsm'];
$dsm = $_GET['dsm'];
$pso = $_GET['pso'];
$product = $_GET['product'];
$team = $_GET['team'];
$region = $_GET['region'];
$f_date = $_GET['f_date'];
$t_date = $_GET['t_date'];
$smffc = $_GET['smffc'];
$brand = $_GET['brand'];



    // Create connection
    $db_connect = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

    if ($db_connect->connect_error) {

     die("Connection failed: " . $conn->connect_error);
    } 

               mysqli_set_charset($db_connect,"utf8"); 
                  $s_tbl_name   = "rx_data";
				  
				  
				  
				  if (((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0) && (strlen($brand) == 0)))
				{
           //when only date given Sm under all data will show 1 
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}
				  
				  
				 	  if (((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0) && (strlen($brand) != 0)))
				{
           //when brand and  date given Sm under all data will show 2
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND n_date BETWEEN '$f_date' AND '$t_date' AND (product_1 LIKE '%$brand%' OR product_2 LIKE '%$brand%' OR product_3 LIKE '%$brand%'OR product_4 LIKE '%$brand%'OR product_5 LIKE '%$brand%')";
				$result = mysqli_query($db_connect,$sql);
				
				} 
				  
				  
			  if (((strlen($product) == 0) && (strlen($rsm) != 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0) && (strlen($brand) == 0)))
				{
           //when only rsm date given Sm under all data will show 3 
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND rsm ='$rsm' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}	  
				  
				  
					  
			  if (((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) != 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0) && (strlen($brand) == 0)))
				{
           //when only dsm date given Sm under all data will show 4 
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND dsm ='$dsm' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}	    
				  
				  
				  
				  		  
			  if (((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) != 0) && (strlen($region) == 0) && (strlen($team) == 0) && (strlen($brand) == 0)))
				{
           //when only pso date given Sm under all data will show 5 
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND pso ='$pso' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}	    
				  
				  
				  
				   if (((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) != 0) && (strlen($team) == 0) && (strlen($brand) == 0)))
				{
           //when only region date given Sm under all data will show 6 
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND region ='$region' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}	    
				  
				  
				  
				    if (((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) != 0) && (strlen($brand) == 0)))
				{
           //when only team date given Sm under all data will show 7 
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND team ='$team' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}	     
				  
				  
				    if (((strlen($product) != 0) && (strlen($rsm) != 0) && (strlen($dsm) != 0) && (strlen($pso) != 0) && (strlen($region) != 0) && (strlen($team) != 0) && (strlen($brand) != 0)))
				{
           //when all given show 8
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND n_date BETWEEN '$f_date' AND '$t_date' AND rsm = '$rsm'";
				$result = mysqli_query($db_connect,$sql);
				
				} 
				  
				  
				 
				    if (((strlen($product) == 0) && (strlen($rsm) != 0) && (strlen($dsm) != 0) && (strlen($pso) != 0) && (strlen($region) == 0) && (strlen($team) == 0) && (strlen($brand) == 0)))
				{
           //when dsm , rsm pso given show 10 only pso and sm will search  jekhane pso porjonto hbe oi query te ata hbe
		
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND n_date BETWEEN '$f_date' AND '$t_date' AND pso = '$pso'";
				$result = mysqli_query($db_connect,$sql);
				
				} 
				  
				  
				  
				    if (((strlen($product) == 0) && (strlen($rsm) != 0) && (strlen($dsm) != 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0) && (strlen($brand) == 0)))
				{
           //when rsm dsm given show 11 only pso and sm will search dsm porjonto hbe
		
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE sm_ffc='$smffc' AND n_date BETWEEN '$f_date' AND '$t_date' AND dsm = '$dsm'";
				$result = mysqli_query($db_connect,$sql);
				
				} 
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  if ($result->num_rows >0) {

 $rows = array();
     while($row = $result->fetch_assoc()) {
             $rows[] = $row;
              
     }
     echo json_encode($rows);
 }
              
     else{
         
         echo "{'value': 'problem Occured!'}";
     }  
				  
				  
				  
				  
				  
				  
				  
				  ?>