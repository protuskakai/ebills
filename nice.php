<?php


$dat = $_GET['accno'];
//$datt = $_POST['datt'];
//$datt2 = new DateTime($datt);
//echo $datt2->format('Y-m-d');
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";
//include "header.htm";
//$ip=$_SERVER['REMOTE_ADDR'];
$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "mpesa";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$result = mysqli_query($dbi," select * from mpesa   order by mdat, left(accno,1),accno, seq desc ");
$n=0;
while ($data = mysqli_fetch_array($result))

  {
 
          
        //  $first=$n;
$second=$data['tcode'];
$nam=$data['nam'];
$dat=$data['dat'];
$amt=$data['amt'];
  $amt=number_format($amt,2);
$third=$amt;
//$fourth="fourth";
//$myArr = array( $second, $third);
$myArr=$second."WWWW".$third."WWWW".$nam."WWWW".$dat."@@@@";
//$myArr = array('one'=> '$first','two'=>'$second');
$myJSON = json_encode($myArr);
//echo $myJSON;

echo $myArr;


   }




?>

<?php
function ccc()
{
for($i = 0; $i < 1000; ++$i)
{
$first="first";
$second="second";
$third="thrid";
$fourth="fourth";
//$myArr = array($first, $second, $third, $fourth);
$myArr = array('one'=> '$first','two'=>'$second');
$myJSON = json_encode($myArr);

echo $myJSON;
}
}
?>