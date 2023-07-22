<?php
$text=$_GET['text'];

$username = "Pkakai";
$password = "Pkakai123";

$n=0;

$cons="";

  $to="0717411083";
    
  $to="+254".substr($to,-9);
   echo   $to;
  

$text="Message from KIWACOE, Dear   ".$text;
 
$action="send";
$sender="ConectMedia";

$post = array();
$post["action"] = "$action";
$post["to"] = array($to);
$post["username"] = "$username";
$post["password"] = "$password";
$post["sender"] = "$sender";
//$post["message"] =urlencode('$text');
$post["message"] = urlencode($text) ;//"$text";
 $post2=json_encode($post);
 //echo $post2;
//$ch = curl_init("https://www.connectmedia.co.ke/user-board/?api_v1"); //Please don’t change
$ch = curl_init("https://www.connectmedia.co.ke/user-board/?api_v2");
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

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

      $n=$n+1;
      }
      else
      {     
     //   $sq2l = "update sms set stat='Error'";
     //   $result2= mysqli_query($dbi,$sql2);
      }



echo "   ".$n."  Messages sent!!";


?>
<?php

function getbal($custid,$hyr,$hmon)
{
$dbhost2="localhost";
$dbuser2= "55509";
$dbpass2 = "kitale";
$dbname2 = "maji";
$amt=0;
$dbi2  = mysqli_connect($dbhost2, $dbuser2, $dbpass2, $dbname2) or die("I cannot connect to the database. Error :" . mysql_error());
$sql2=" select sum(amt) as amtt from shares where custid='$custid'";
$result= mysqli_query($dbi2,$sql2);
$data = mysqli_fetch_array($result);
if($data)
{

$amt=$data['amt'];



}


return $amt;

}
?>


