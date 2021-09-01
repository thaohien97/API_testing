<?php 

$url = "https://micro.fndev.net/v1/webhook-sandbox/webhooks/";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "fn-token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb21wYW55X2lkIjoxOTAyNywidXNlcl9pZCI6MjYwNSwiY3JlYXRlZCI6MTYyMDMwOTM3NzMxMCwiaWF0IjoxNjIwMzA5Mzc3fQ.nsa1CvfyMUi95bjfIyltrXT4j7XAxjiV4dnvzWWAK48",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
 "company_id": 19027,
    "user_id": 2605,
    "url": "http://3a39df8c12bd.ngrok.io",
    "method": "POST",
    "secret": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb21wYW55X2lkIjoxOTAyNywidXNlcl9pZCI6MjYwNSwiY3JlYXRlZCI6MTYyMDMwOTM3NzMxMCwiaWF0IjoxNjIwMzA5Mzc3fQ.nsa1CvfyMUi95bjfIyltrXT4j7XAxjiV4dnvzWWAK48",
    "active": true,
    "events": [
        "workorder.message_posted"
    ]
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);