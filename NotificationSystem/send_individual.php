<?php

$ch=curl_init("https://fcm.googleapis.com/fcm/send");

$header=array("Content-Type:application/json",
"Authorization:key=AAAA8pDwazE:APA91bHp8PXEp7kKIDZnEVt4cZnLlrLpP05Ii_lOIePmZtdkGT7-963ckzmnG0ajXcg5EoNDloA7rwLGxAozMhycX77Sy2ku8OVUUHZGs-3DoK1beksKtgVT6IvxMzkARB8R_H6wJ8Bw");
$id = $_GET['id'];
$body = $_GET['body'];
$title = $_GET['title'];

$data = json_encode(array("to"=>$id,"notification"=>array(
    'title'=> $title,
    'body'=> $body,
    'image'=>"http://api.baymaxbd.com/logo.png",
    'sound'=> "http://api.baymaxbd.com/m.mp3",
    )));

curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

curl_exec($ch);

?>
