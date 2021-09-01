<?php


$ch = curl_init("https://requestbin.com/r/envnmwdadk8d/1u5LAIAF19HQ9y1bXgyh8Hjur0D");


$headers = array(
   
   "Content-Type: application/json",
);
$access_url = "https://requestbin.com/r/envnmwdadk8d/1u5LAIAF19HQ9y1bXgyh8Hjur0D";
curl_setopt($ch, CURLOPT_URL, $access_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


$curl_response = curl_exec($ch);

$json_text = html_entity_decode($curl_response);
$message = json_decode($json_text,true);
var_dump($message);
//echo $message['results'][0]['message'];
//echo $message['results'][0]['created']['utc'];
curl_close($ch);