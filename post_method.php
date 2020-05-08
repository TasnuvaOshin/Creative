<?php
   if( $_REQUEST["image"]) {
include ('../connect/db_connect.php');
header('content-type: application/json');

   
   date_default_timezone_set('Asia/Dhaka');
	$date = date('H:i:s', time());
    $name = $date; 
	$image = $_REQUEST["image"];
    $response = array();
    $decodedImage = base64_decode("$image");
 
    $return = file_put_contents("../../uploads/profile_photo/".$name.".JPG", $decodedImage);
 
    if($return !== false){

        echo 'updated';
        
    }
    
    
    
    
    
    


     
   }

?>
