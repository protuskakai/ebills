<?php
//$dats="All";
$dats = $_GET['dats'];
$accno = $_POST['accno'];
//$datt2 = new DateTime($datt);
//echo $datt2->format('Y-m-d');
$dbhost="nzoiawater.or.ke";
//$dbhost="localhost";
$dbuser= "nzoiaw_kak2";
$dbpass = "kitale2017";
$dbname = "nzoiaw_kak";
//include "header.htm";
//$ip=$_SERVER['REMOTE_ADDR'];
//$dbhost="localhost";
//$dbuser= "55509";
//$dbpass = "kitale";
//$dbname = "mpesa";

//$myArr=$dat."WWWW".$item."WWWW".$amt."WWWW".$dr."WWWW"."Acc Bal:  ".$st."@@@@";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
if($dats=="All")
{
$result = mysqli_query($dbi," select * from  Customer_accounts where customerid='$accno' order by dat");
}else
{

$result = mysqli_query($dbi," select * from  Customer_accounts where customerid='$accno'  and dr_cr='$dats' order by dat");
}

 

$bal=0;
$n=0;
$bamt=0;
$st="";

while ($data = mysqli_fetch_array($result))

  {

 
          
        //  $first=$n;
//$second=$data['tcode'];
$item=$data['item'];
$dat=$data['dat'];  //yyyy:mm/dd
$yy = substr($dat, -10, 4); // returns "d"
$mm = substr($dat, -5, 2); // returns "d"
$dd = substr($dat, -2, 2); // returns "d"
$dat=$dd."/".$mm."/".$yy;
$amt=$data['amt'];
$bamt=$amt;
$dr=$data['dr_cr'];
//echo "dddd".$dr;
if($dr=="Debit")
{
   $bal=$bal+$bamt;
   }else
   {
    $bal=$bal-$bamt;
   
   }
 $amt=number_format($amt,2);
  $st=number_format($bal,2);

//$third=$amt;
//$fourth="fourth";
//$myArr = array( $second, $third);
if($dats=="All")
{

$myArr=$dat."WWWW".$item."WWWW".$amt."WWWW".$dr."WWWW"."Acc Bal:  ".$st."@@@@";

}else
{


$myArr=$dat."WWWW".$item."WWWW".$amt."WWWW"." "."WWWW"."  "."@@@@";

}

//$myArr=$amt."WWWW"."@@@@";
//$myArr = array('one'=> '$first','two'=>'$second');
$myJSON = json_encode($myArr);
//echo $myJSON;

echo $myArr;


   }




?>

