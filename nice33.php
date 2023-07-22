<?php
//$dats="All";
//$accno="201167800119";
$accno = $_GET['accno'];
//$dbhost="localhost";
//$dbuser= "55509";
//$dbpass = "kitale";
//$dbname = "mpesa";

//$dbhost="localhost";
//$dbuser= "55509";
//$dbpass = "kitale";
//$dbname = "bills";  
//   
$dbhost="nzoiawater.or.ke";
$dbuser= "nzoiaw_kak2";
$dbpass = "kitale2017";
$dbname = "nzoiaw_kak";
//$dbhost="localhost";
//$dbuser= "55509";
//$dbpass = "kitale";
//$dbname = "mpesa";
//$duedate= date('Y-m-d', strtotime("+180 day"));
//$myArr=$dat."WWWW".$item."WWWW".$amt."WWWW".$dr."WWWW"."Acc Bal:  ".$st."@@@@";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
 $duedate= date('Y-m-d', strtotime("-6 month"));
$drr=0;
$crr=0;

$result = mysqli_query($dbi," select * from  mpesa where accno='$accno'  and mdat>='$duedate'  order by mdat");



while ($data = mysqli_fetch_array($result))

  {

$tcode=$data['tcode'];
$dat=$data['dat'];  //yyyy:mm/dd
//$yy = substr($dat, -10, 4); // returns "d"
//$mm = substr($dat, -5, 2); // returns "d"
//$dd = substr($dat, -2, 2); // returns "d"
//$dat=$dd."/".$mm."/".$yy;
$amt=$data['amt'];
//$reg=$data['reg'];
$nam=$data['nam'];
$telno=$data['telno'];
 $amt=number_format($amt,2);

$myArr=$tcode."WWWW".$dat."WWWW".$amt."WWWW".$nam."WWWW".$telno."@@@@";


echo $myArr;


   }




?>

