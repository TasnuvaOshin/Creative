# Creative

<?php 
$id = $_GET['id'];
$name = 'tasnuva';
$callurl = curl_init();

curl_setopt($callurl , CURLOPT_URL, "http://xxx/smsapi?api_key=C20064265ed75306598296.04336062&type=text&senderid=8809601000198&contacts=01645772748&msg=oshinischecking$name");
curl_setopt($callurl , CURLOPT_HEADER, 0);

curl_exec($callurl );

curl_close($callurl );

 ?>
