<?php
//$dats="All";
//$accno="301104730002";
$dats = $_GET['dats'];
$accno = $_GET['accno'];
//$datt2 = new DateTime($datt);
//echo $datt2->format('Y-m-d');
//$dbhost="nzoiawater.or.ke";
//$dbhost="localhost";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";
//include "header.htm";
//$ip=$_SERVER['REMOTE_ADDR'];
//
//$dbhost="localhost";
//$dbuser= "55509";
//$dbpass = "kitale";
//$dbname = "bills";  
//   
$dbhost="nzoiawater.or.ke";
$dbuser= "nzoiaw_kak2";
$dbpass = "kitale2017";
$dbname = "nzoiaw_kak";
//$duedate= date('Y-m-d', strtotime("+180 day"));
//$myArr=$dat."WWWW".$item."WWWW".$amt."WWWW".$dr."WWWW"."Acc Bal:  ".$st."@@@@";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
 $duedate= date('Y-m-d', strtotime("-6 month"));
$drr=0;
$crr=0;
if($dats=="All")
{

$result = mysqli_query($dbi," select * from  Customer_accounts where customerid='$accno'  and dat>='$duedate'  order by dat");
$debit = mysqli_query($dbi," select  sum(amt) as drr from  Customer_accounts where customerid='$accno'  and dr_cr='Debit'  and dat<'$duedate'  order by dat");
$credit = mysqli_query($dbi," select  sum(amt) as crr from  Customer_accounts where customerid='$accno'  and dr_cr='Credit'   and dat<'$duedate' order by dat");
while ($datadr = mysqli_fetch_array($debit))
{
       if(isset($datadr))
       {
           $drr=$datadr['drr'];
       }
}
               while ($datacr= mysqli_fetch_array($credit))
           {
               if(isset($datacr))
                 {
                    $crr=$datacr['crr'];
                }
            }
}else
{

$result = mysqli_query($dbi," select * from  Customer_accounts where customerid='$accno'  and dr_cr='$dats'  and dat>='$duedate' order by dat");
}

$nbal=$drr-$crr;

$bal=$nbal;
$n=0;
$bamt=0;
$st="";

while ($data = mysqli_fetch_array($result))

  {

 
   //   echo "dfsdfsfsdfsdfsdfsdfsdfdsf";     
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

