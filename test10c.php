<?php

//25387065
ini_set('max_execution_time', 123420000);
ini_set('memory_limit', '100M');
$dbhost="192.168.1.2";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";

$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
//mysqli_select_db($dbi,$dbname);
//$sql = "select max(entid) as 'mx' from Customer_accounts where CustomerID like '3%'";

//$result= mysqli_query($dbi,$sql);
//$data = mysqli_fetch_array($result);
$file = 'file.txt';
$n=0;
$fp = fopen($file, 'rb');		
		while (!feof($fp))
		{
		$n=$n+1;
		  
			$sql = fgets($fp);
			if($n==1)
			{
			echo $sql;
			
			}
			If(isset($sql))
			{
			 $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
			 }
		//	if (!feof($fp))
		//		$fwrite($output, fread($fp, 16384));
		}		
		echo "done ".$n;
		fclose($fp);
   //   $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
  //  }  





?>

