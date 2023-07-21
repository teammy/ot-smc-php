<?php

$url = 'https://notify-api.line.me/api/notify';
$token = '2MfAcR2C8P26kK0gv0RSg2kLy37FWE9RNC1gaoDZmDE';
$headers = [
'Content-Type: application/x-www-form-urlencoded',
'Authorization: Bearer '.$token
];
$fields = 'message=dawdwa';

// $ch = curl_init();
// curl_setopt( $ch, CURLOPT_URL, $url);
// curl_setopt( $ch, CURLOPT_POST, 1);
// curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
// curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
// $result = curl_exec( $ch );
// curl_close( $ch );





$chOne = curl_init(); 
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
//POST 
curl_setopt( $chOne, CURLOPT_POST, 1); 
// Message 
curl_setopt( $chOne, CURLOPT_POSTFIELDS, $fields); 
// follow redirects 
curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
//ADD header array 
// $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$token.'', ); 
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
//RETURN 
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 
//Check error 
if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); } 
else { $result_ = json_decode($result, true); 
echo "status : ".$result_['status']; echo "message : ". $result_['message']; } 
//Close connect 
curl_close( $chOne );    

?>