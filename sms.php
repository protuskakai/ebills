<?php
    if (count($argv) == 3) {
       
        $USER = 'username';
        $PASS = 'password';
        $URL = "http://tms.flashmedia.co.za/api/sms/send";
        $PORT = 80; # 443 for https
        
        $MSISDN = $argv[1];
        $MESSAGE = $argv[2];        
        
        $response = PostRequest($URL, $PORT, $USER, $PASS, $MSISDN, $MESSAGE);
        echo "\nResponse:\n".$response . "\n";
    } else {
        echo "\nUsage:\n\ttms_php_send_sms_example [MOBILE NUMBER] [MESSAGE]\n";
    }

function PostRequest($url, $port, $user, $pass, $msisdn, $msg) {        
    $ch = curl_init();      
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_PORT, $port);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$pass);    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/xml'));   # use application/json for the response to be in JSON 
    curl_setopt($ch, CURLOPT_POSTFIELDS, "destination=".$msisdn."&message=".$msg);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

?>