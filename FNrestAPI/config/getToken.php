
<?php 


function getToken(){
    $base_url = "https://api.fieldnation.com/authentication/api/oauth/token";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $base_url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'grant_type' => 'password',
        'client_id' => 'fn00697-client1',
        'client_secret' => '64d244031107dd4a98ce211fa2e6c35f40de6ad37cd3b769f165c43f5a2f7b7b',
        'username' => 'NguyenH',
        'password' => 'Nguyen@iti',
    ));
    
    $data = curl_exec($ch);
    $auth_string = json_decode($data); 
    //echo $data;
    $atoken = $auth_string->access_token;
    return $atoken;
    //echo $atoken;
    
    }