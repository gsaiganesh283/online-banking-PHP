<?php

//curl request for generating auth token
// $url='https://api.sandbox.co.in/authenticate';

$headers[]='accept: application/json';
$headers[]='x-api-key: key_live_xQqPk3X7ZJlYsSs9hij7vZ8xu9g5rvc1';
$headers[]='x-api-version: 1.0';

// $headers[]='x-api-secret: secret_live_MfshrIYD9quRCokmUqyxdPEGGThNWqtM';


// $ch = curl_init($url);
// curl_setopt($ch,CURLOPT_POST,1);
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
// $result = curl_exec($ch);
// echo $result;


$auth_token='eyJhbGciOiJIUzUxMiJ9.eyJhdWQiOiJBUEkiLCJyZWZyZXNoX3Rva2VuIjoiZXlKaGJHY2lPaUpJVXpVeE1pSjkuZXlKaGRXUWlPaUpCVUVraUxDSnpkV0lpT2lKM2FHOXRiMjUxWjJseWFVQm5iV0ZwYkM1amIyMGlMQ0poY0dsZmEyVjVJam9pYTJWNVgyeHBkbVZmZUZGeFVHc3pXRGRhU214WmMxTnpPV2hwYWpkMldqaDRkVGxuTlhKMll6RWlMQ0pwYzNNaU9pSmhjR2t1YzJGdVpHSnZlQzVqYnk1cGJpSXNJbVY0Y0NJNk1UY3lOakExTURJNU5Dd2lhVzUwWlc1MElqb2lVa1ZHVWtWVFNGOVVUMHRGVGlJc0ltbGhkQ0k2TVRZNU5EUXlOemc1TkgwLlNLNnB4dzNIM200UXVHeVZ6OXJBSE9ock0zUWlLYVJQc3kwZmQxSHJLWHlKLVBPTVdud0wyQkxFVTA0MnBpcDMzRkNYcldYQ1NVWTBHQVpXQmg5QXJRIiwic3ViIjoid2hvbW9udWdpcmlAZ21haWwuY29tIiwiYXBpX2tleSI6ImtleV9saXZlX3hRcVBrM1g3WkpsWXNTczloaWo3dlo4eHU5ZzVydmMxIiwiaXNzIjoiYXBpLnNhbmRib3guY28uaW4iLCJleHAiOjE2OTQ1MTQyOTQsImludGVudCI6IkFDQ0VTU19UT0tFTiIsImlhdCI6MTY5NDQyNzg5NH0.514LsoKcf9vl_Zu8v6hVY7cZhhCmbpRnHVRYVEkIr5ARlI-rcwg6MBf45SXF7tvkbmyo1siP0sRr-SGO889A1w';


if(isset($_GET['sendotp'])){
    $aadharno=$_POST['aadhar_no'];
    $url='https://api.sandbox.co.in/kyc/aadhaar/okyc/otp';

    $data = '{
        "aadhaar_number":"'.$aadharno.'"
    }';

    $headers[]='Authorization :'.$auth_token;
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $result = curl_exec($ch);
    echo $result;
    

}elseif(isset($_GET['verifyotp'])){
    $refid=$_POST['ref_id'];
    $otp=$_POST['otp'];

    $url='https://api.sandbox.co.in/kyc/aadhaar/okyc/otp/verify';

    $data = '{
        "ref_id":"'.$refid.'",
        "otp":"'.$otp.'"

    }';

    $headers[]='Authorization :'.$auth_token;
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $result = curl_exec($ch);
    echo $result;
    
}


