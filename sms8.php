<?php 
//$from = "254717411083";
$text="test";
$text = trim($text);
$username = "Pkakai";
$password = "Pkakai123";
//$postUrl = "http://www.connectmedia.co.ke/user-board/?api_v1";
$to='254717411083';
$action="balance";
$sender="ConectMedia";
//$post =array(	'action' => '$action', 	'to' => array($to), 	'username' => '$username', 	'password' => '$password',	'sender' => '$sender', 	'message' => urlencode('$text')); 
//$post =array('action' => "$action", 'to' => "$to",  'username' => "$username",  'password' => "$password",  'sender' => "$sender",  'message' => "$text");
$post = array(); 
$post["action"] = "$action"; 
$post["to"] = "$to"; 
$post["username"] = "$username";
$post["password"] = "$password";
$post["sender"] = "$sender";
//$post["message"] =urlencode('$text');
$post["message"] = urlencode($text) ;//"$text";
 $post2=json_encode($post);
 //echo $post2;
//$ch = curl_init("https://www.connectmedia.co.ke/user-board/?api_v1"); //Please don’t change 
$ch = curl_init("https://www.connectmedia.co.ke/user-board/?api_v1");
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
echo http_build_query($post, '', '&amp;');
//echo http_build_query($post) . "\n";
$response = curl_exec($ch);
echo $response;
curl_close($ch);
$jsonarray[]=array();
$jsonarray=json_decode($response, true);
//echo $response;
echo "Return code is: $jsonarray[code]"; //Response code of the API
echo "Return message is: $jsonarray[message]"; //Response Message
?>