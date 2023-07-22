<?php //FILE: sms_api.php 
function sendSMS($number, $message) { 
        $url = "example"; // Set your frontlinesms or frontlinecloud webconnection url here
        $secret = "secret"; // Set the secret here
        $request = array( 
                        'secret' => $secret, 
                        'message' => $message, 
                        'recipients' => array(array( 
                                'type' => 'mobile', 
                                'value' => $number 
                        ))
                );  
        $req = json_encode($request);
        $ch = curl_init( $url );  
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
        curl_setopt( $ch, CURLOPT_POST, true );  
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $req );  
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
        $result = curl_exec($ch); 
        curl_close($ch);
       // echo $result;
        return split(',',$result); 
}
?>