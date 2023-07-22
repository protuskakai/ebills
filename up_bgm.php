<?php
//25387065
//338829...30 recs back
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";
//include "header.htm";
//$ip=$_SERVER['REMOTE_ADDR'];
ini_set('max_execution_time', 120000);
$dbhost="192.168.1.2";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$dbhost3="nzoiawater.or.ke";
$dbuser3= "nzoiaw_kak2";
$dbpass3 = "kitale2017";
$dbname3 = "nzoiaw_kak";
$dbi3  = mysqli_connect($dbhost3, $dbuser3, $dbpass3, $dbname3) or die("I cannot connect to the database. Error :" . mysql_error());
//$dat = $_POST['dat'];
//$len=strlen($dat);
//echo $sql;
//$dbhost="localhost";
//$dbuser= "55509";
//$dbpass = "kitale";
//$dbname = "nzowasco";
//$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
//$bal=0;

$max=getmax();

echo "max=".$max;
//$result = mysqli_query($dbi,"select * from customer_accounts where entid>$max and  left(customerid,1)='4' order by entid  ");
$sql="select * from Customer_accounts where entid>$max and  left(customerid,1)='4' order by entid limit 0,10000";
echo "<br>";
echo "<br>";
//echo $sql; 
$result= mysqli_query($dbi,$sql);

while ($data = mysqli_fetch_array($result))
  {
 
    $dat = $data['dat'];
     $customerid = $data['customerid'];
     $amt=$data['amt'];
      $item=$data['item'];
       $pdat=$data['pdat'];
         $ctim=$data['ctim'];
          $entid=$data['entid'];
           $reg=$data['reg'];
     $n++;
     $dr=$data['dr_cr'];
 	 
     //   $amt=number_format($amt,2);
     //   $bbal=number_format($bal,2);
       upload($dat,$customerid,$amt,$item,$pdat,$ctim,$entid,$reg,$dr,$dbi3);
       //$sql3="Insert into Customer_accounts (dat,Customerid,amt,item,pdat,ctim,entid,reg,dr_cr) values ('$dat','$customerid','$amt','$item','$pdat','$ctim',$entid,'$reg','$dr')";
     //  echo $sql3;
     // $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
   }
  echo "Done";



?>


<?php
function getmax()
{
$dbhost2="nzoiawater.or.ke";
$dbuser2= "nzoiaw_kak2";
$dbpass2 = "kitale2017";
$dbname2 = "nzoiaw_kak";
$dbi2  = mysqli_connect($dbhost2, $dbuser2, $dbpass2, $dbname2) or die("I cannot connect to the database. Error :" . mysql_error());


$sql2 = "select max(entid) as ent from Customer_accounts  where left(customerid,1)='4'";
$result2= mysqli_query($dbi2,$sql2);
//echo $sql2;
$result2= mysqli_query($dbi2,$sql2);
if (!$result2)
{

}else
{

$data2 = mysqli_fetch_array($result2);
$ent=$data2['ent'];
// $address=$data['address'];
//$town=$data['town'];
}

return $ent;

}


?>


<?php
function upload($dat,$customerid,$amt,$item,$pdat,$ctim,$entid,$reg,$dr,$dbi3)
{
//$dbhost3="nzoiawater.or.ke";
//$dbuser3= "nzoiaw_kak2";
//$dbpass3 = "kitale2017";
//$dbname3 = "nzoiaw_kak";
//$dbi3  = mysqli_connect($dbhost3, $dbuser3, $dbpass3, $dbname3) or die("I cannot connect to the database. Error :" . mysql_error());
$sql3="Insert into Customer_accounts (dat,Customerid,amt,item,entid,reg,dr_cr,pdat,ctim) values ('$dat','$customerid','$amt','$item',$entid,'$reg','$dr',CURDATE(),CURTIME())";
//echo $sql3;
$result3= mysqli_query($dbi3,$sql3)  or die("I cannot connect to the database. Error :" . mysql_error());;
//echo $sql3;

}
?>