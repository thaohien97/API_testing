<?php 

include '../config/getToken.php';
include '../config/db.php';




$sql = "SELECT * FROM orders WHERE companyId = 37 AND YEAR(closedDate) = 2016 LIMIT 30";
$query = mysqli_query($conn, $sql);
$row = mysqli_num_rows($query);
//echo $row;
if($row > 0){
    $workorder_arr = array();
    $workorder_arr[] = array();

    for($i = 1; $i<=$row; $i++){
        $data = mysqli_fetch_assoc($query);
        $title = $data['shortDesc'];
        //echo $title;
        $locationName = $data['locationName'];
        $locationType = $data['locationType'];
        switch($locationType){
            case("commercial"):
                $locationId = 1;
            break;
            case("governmental"):
                $locationId = 2;
            break;
            case("residential"):
                $locationId = 3; 
            break;
            case("educational"):
                $locationId = 4; 
            break;
            case("other"):
                $locationId = 5;
            break;
        }
        $street1 = $data['street1'];
        $street2 = $data['street2'];
        $city = $data['city'];
        $state = $data['state'];
        $zipcode = $data['zipcode'];
        $startDate = $data['workBeginDate'];
        $endDate = $data['workEndDate'];
        $payRate = $data['spendLimit'];
        $manufacture = $data['manufacturer'];
        $model = $data['model'];
        $serial = $data['serialNumber'];
        $id = $data['id'];
        $itiNo = "ITI$id";
        $partNo = $data['partShipped'];
        $outboundTrack = $data['partShippedTrack'];
        $returnTrack = $data['partReturnedTrack'];

        $workorder_item = 
        array(
            "title"=>"$title",
            "template"=>
            array(
                "id"=>433
            ),
    
            "location"=>
            array(
                "mode"=>"custom",
                "display_name"=>"$locationName",
                "address1"=>"$street1",
                "address2"=>"$street2",
                "city"=>"$city",
                "state"=>"$state",
                "zip"=>"$zipcode",
                "country"=>"US",
                "type"=>
                array(
                    "id"=>$locationId,
                )   


            ),
            "schedule"=>
            array(
                "service_window"=>
                array(
                    "mode"=>"between",
                    "start"=>
                    array(
                        "utc"=>"$startDate",
                    ),
                    "end"=>
                    array(
                        "utc" => "$endDate",
                    )
                )
            ),
            "pay"=>
            array(
                "type"=>"fixed",
                "base"=>
                array(
                    "amount"=>$payRate,
                    "unit"=>1
                )
            ),

   
            "custom_fields"=>
            array(
                "results"=>[
                array(
                
                    "results"=>[
                    array(
                        "id"=>606,
                        "value"=>"$manufacture",

                    ),
                    array(
                        "id"=>607,
                        
                        "value"=>"$model",
                        
                    ),
                    array(
                        "id"=>608,
                        
                        "value"=>"$serial",
                        
                    ),
                    array(
                        "id"=>609,
                        
                        "value"=>"$itiNo",
                        

                    ),
                    array(
                        "id"=>610,
                        
                        "value"=>"$partNo",
                 

                    ),
                    array(
                        "id"=>611,
                        
                        "value"=>"$outboundTrack",
                        
                    ),
                    array(
                        "id"=>619,
                        
                        "value"=>"$returnTrack",
                    ),
                    
                    ]
                    )
                ]
            )   
    

        );
        global $workorder_arr;
        //$workorder_item1=  json_encode($workorder_item);
        array_push($workorder_arr, $workorder_item);






    }
    //$workorder = json_encode($workorder_arr);
    
}
foreach ($workorder_arr as $workorder_item1){ 
    

    $workorder_post = json_encode($workorder_item1);
    $atoken = getToken();
//echo $atoken;
$post_url = "https://api-sandbox.fndev.net/api/rest/v2/workorders?access_token=$atoken";

$ch = curl_init($post_url);

curl_setopt($ch, CURLOPT_URL, $post_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'OAuth ' . $atoken));
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $workorder_post);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_TIMEOUT, 15);
//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);

$curl_response = curl_exec($ch);
print_r($curl_response);
curl_close($ch);
}

