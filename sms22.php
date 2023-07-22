<?php
$text_message="Thank you for the Text Message Sent, it was well received";

$username = "Pkakai";
$password = "Pkakai123";

$postUrl = "http://www.connectmedia.co.ke/user-board/?api";

$to='254777411083';

$action="balance";

$sender="ConectMedia";
$text="balance";
$post = array();
$post["action"] = "$action";
$post["to"] = array($to);
$post["username"] = "$username";
$post["password"] = "$password";
$post["sender"] = "$sender";
//$post["message"] =urlencode('$text');
$post["message"] = urlencode($text) ;//"$text";
 $post2=json_encode($post);
$ch = curl_init("https://www.connectmedia.co.ke/user-board/?api_v2");
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
//echo http_build_query($post, '', '&amp;');
//echo http_build_query($post) . "\n";
$response = curl_exec($ch);
//echo $response;
curl_close($ch);
$jsonarray[]=array();
$jsonarray=json_decode($response, true);
//echo $response;
$code=$jsonarray['code'];

//echo "Return code is: $jsonarray[code]\n"; //Response code of the API
if( $code=="201")
{
    
      
    //  $sql2= "update sms set stat='Send'";
    //  $result2= mysqli_query($dbi,$sql2);
      }
      else
      {
      
      
      
     //   $sq2l = "update sms set stat='Error'";
     //   $result2= mysqli_query($dbi,$sql2);
      }
      



echo $jsonarray['message']; //Response Message
//echo "<br>";



?>