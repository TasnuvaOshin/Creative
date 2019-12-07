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


    // Create connection
    $db_connect = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

    if ($db_connect->connect_error) {

     die("Connection failed: " . $conn->connect_error);
    } 

               mysqli_set_charset($db_connect,"utf8"); 
                  $s_tbl_name   = "rx_data";
				
				
				
			
				
				if (($product != ' ') && ($rsm != ' ')&& ($dso != ' ') && ($pso != ' ') && ($region != ' ') && ($team != ' '))
				{
           //when everything is selected 
		   
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE rsm = '$rsm' AND dsm = '$dsm' AND pso = '$pso' AND region = '$region' AND team = '$team'  AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}
				
				
				
			
				
				if ((strlen($product) == 0) && (strlen($rsm) != 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0))
				{
           //when rsm is selected 
		  // echo 'rsm selected';
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE rsm = '$rsm' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}
				
				
					
				if ((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) != 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0))
				{
           //when dsm is selected 
		  // echo 'dsm selected';
		   
				$sql = "SELECT * FROM $s_tbl_name WHERE dsm = '$dsm' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}
				
				
				if ((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) != 0) && (strlen($region) == 0) && (strlen($team) == 0))
				{
           //when pso is selected 
		 
				$sql = "SELECT * FROM $s_tbl_name WHERE pso = '$pso' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}
				
			if ((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) != 0))
				{
           //when team is selected 
		 
				$sql = "SELECT * FROM $s_tbl_name WHERE team = '$team' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}	
				
				if ((strlen($product) == 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) != 0) && (strlen($team) == 0))
				{
           //when region is selected 
		 
				$sql = "SELECT * FROM $s_tbl_name WHERE region = '$region' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}	
				
				
				
				if ((strlen($product) != 0) && (strlen($rsm) == 0) && (strlen($dsm) == 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0))
				{
           //when product is selected 
		 
				$sql = "SELECT * FROM $s_tbl_name WHERE product_1 ='$product' OR product_2 ='$product' OR product_3 ='$product' OR product_4 ='$product' OR product_5 ='$product' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}		
				
				
					if ((strlen($product) == 0) && (strlen($rsm) != 0) && (strlen($dsm) != 0) && (strlen($pso) == 0) && (strlen($region) == 0) && (strlen($team) == 0))
				{
           //when product is selected 
		 
				$sql = "SELECT * FROM $s_tbl_name WHERE rsm='$rsm' AND dsm='$dsm' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}		
				
					if ((strlen($product) == 0) && (strlen($rsm) != 0) && (strlen($dsm) != 0) && (strlen($pso) != 0) && (strlen($region) == 0) && (strlen($team) == 0))
				{
           //when product is selected 
		 
				$sql = "SELECT * FROM $s_tbl_name WHERE rsm='$rsm' AND dsm='$dsm' AND pso = '$pso' AND n_date BETWEEN '$f_date' AND '$t_date'";
				$result = mysqli_query($db_connect,$sql);
				
				}		
				
				else 
				{
           
				$sql = "SELECT * FROM $s_tbl_name WHERE n_date BETWEEN '$f_date' AND '$t_date'";
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
         
         echo 'Can not able to handle result';
     }  
	
				
?>