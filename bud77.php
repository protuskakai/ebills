<?php
//25387065
ini_set('max_execution_time', 120000);

$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";

//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";

$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error : (line 15)" . mysql_error());;



   $myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
//echo $max;
//die("dddd");


ini_set('memory_limit', '-1');

  // $sql = "INSERT INTO Customer_accounts (customerid,dat,item,amt,dr_cr,pdat,ctim,entid) VALUES ('$book[CustomerID]','$dat','$ent','$amt','$dr',CURDATE(),CURTIME(),'$book[Entryid]')";
  
    while(!feof($myfile)) 
    {
           $line = fgets($myfile);
           $output=explode("^^^", $line);
           $sql = "INSERT INTO Customer_accounts (customerid,dat,item,amt,dr_cr,pdat,ctim,entid) VALUES ('$output[0]','$output[1]','$output[2]','$output[3]','$output[4]',CURDATE(),CURTIME(),'$output[5]')";
           $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error : (line 33)" . mysql_error());
         //  print($output[0]."\n");

    }
  
  
  
 // $txt=$book[CustomerID]."^^^".$dat."^^^".$ent."^^^".$amt."^^^".$dr."^^^".$book[Entryid];

 //  $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
 

fwrite($myfile, $txt);



 
 
   $i++;


fclose($myfile);
echo "done";


?>