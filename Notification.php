<?php

$ch=curl_init("https://fcm.googleapis.com/fcm/send");

$header=array("Content-Type:application/json","Authorization:key=AAAAXEK6x8U:APA91bG6Vr-h5YhLshyLIjISyunK8ueKohaKIbBZzWFTZXFXn2g6aUZTriDNiEKD0NtMAj7V7_zRCcbsOtmOE8KFRf_bRtaaOyNOLk0RSNYnApiFZQkTjQtEjNZSQ_aBn_oYNytB7Pgp");

$id = $_REQUEST['id'];
$data = json_encode(array("to"=>"/topics/driver","notification"=>array("title"=>$_REQUEST['title'],"message"=>$_REQUEST['message'])));

curl_setopt($ch,CURLOPT_HTTPHEADER,$header);	
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);	

curl_exec($ch);

?>
