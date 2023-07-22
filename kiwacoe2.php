<?php
$text=$_GET['text'];
//$mon=$_GET['mon'];
//$reg=$_GET['reg'];
$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "sacco2";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
//ini_set('max_execution_time', 120000);
ini_set('max_execution_time', 120000);
//$text="test1234567";
//$text = trim($text);
$username = "Pkakai";
$password = "Pkakai123";
//$postUrl = "http://www.connectmedia.co.ke/user-board/?api_v1";
//$pa=$yr.$mon.$reg;
$n=0;
$sql = "select * from saccodb where  telno like '%7%' order by membid  LIMIT 0,1";
//$sql="select cread,pread,b.reg,pdate,telno from readings a,customers b where a.custid=b.custid and CONCAT(yr,mon,b.reg)='201801Sabaki' and telno like '%07%' order by b.custid";
//echo $sql;

$result= mysqli_query($dbi,$sql);
//if (!$result {
 //  printf("Errormessage: %s\n", $mysqli->error);
//}
$cons="";
$n=0;
while ($data = mysqli_fetch_array($result))
  {
//   $amt=getbal($data['membid'],$yr,$mon);

   //  $duedate= date('d/m/y', strtotime("+14 day"));
   //  $duedate = date('d-m-y', strtotime("+14 day", strtotime($data['pdate'])));
   
    $nam=$data['nam'];
    
     
  //  echo $duedate."  ";
    // $n++;
      // $to=$data['telno'];
      $to="0717411083";
    
      $to="+254".substr($to,-9);
        echo   $to;
  //    die("ssfff");
    // $amt=number_format($amt,2);

$text="Message from KIWACOE, Dear ".$nam."  ".$text;
 //$dr= $book['nos'];
//$to=$dr;     //254717411083;
$action="send";
$sender="ConectMedia";
//$post =array(    'action' => '$action',     'to' => array($to),     'username' => '$username',     'password' => '$password',    'sender' => '$sender',     'message' => urlencode('$text'));
//$post =array('action' => "$action", 'to' => "$to",  'username' => "$username",  'password' => "$password",  'sender' => "$sender",  'message' => "$text");
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
  //    $sql2= "update sms set stat='Send'";
   //   $result2= mysqli_query($dbi,$sql2);
      $n=$n+1;
      }
      else
      {     
     //   $sq2l = "update sms set stat='Error'";
     //   $result2= mysqli_query($dbi,$sql2);
      }
//echo "Return message is: $jsonarray[message]"; //Response Message

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



