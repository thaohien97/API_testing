
<?php 
include 'config/getToken.php';

$atoken = getToken();
echo $atoken;
$ch = curl_init();

$access_url = "https://api-sandbox.fndev.net/api/rest/v2/workorders/25919?access_token=$atoken";
curl_setopt($ch, CURLOPT_URL, $access_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization', 'OAuth ' . $atoken)); 

//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);

$curl_response = curl_exec($ch);
//var_dump($curl_response);
//echo gettype($curl_response);
//$message = json_decode($curl_response, true);
//print_r($message);
//secho "<br>";
//$sub_message = substr($curl_response, strpos($curl_response, '"message":'), -1);
//echo $sub_message; 
//echo $curl_response;
$json_text = html_entity_decode($curl_response);
$message = json_decode($json_text,true);
var_dump($message);
//echo $message['results'][0]['message'];
//echo $message['results'][0]['created']['utc'];
curl_close($ch);