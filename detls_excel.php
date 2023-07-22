<?php

$dbhost="192.168.1.2";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());
$dat1= $_GET['dat1'];
$dat2= $_GET['dat2'];
$reg= $_GET['reg'];
$item= $_GET['item'];
//echo " select tcode as 'Ref No', dat as 'Date', nam as 'Name',accno as 'Connection No.',ind  as 'Error Ind',telno as 'Tel No', amt as 'Amount' from mpesa where $fld like '%$dat%' order by accno asc"; 
//$sql = "$sql="select reg, zone, route, item, sum(amt) as tot from billproducts where dat between '$dat1' and '$dat2' and reg='$reg' group by  reg, zone, route, item";
$sql="select reg, zone, route, item, sum(amt) as tot from billproducts where dat between '$dat1' and '$dat2' and reg='$reg'  and item='$item'  group by  reg, zone, route, item";
 
//echo $sql;
//die ("dddd");

$result = mysqli_query($dbi,$sql);              
$fields = mysqli_num_fields( $result);

//echo $fields;

//foreach ($fields as $f)
 //{ 
 //echo "<br>Field name: ".$fields; 
 //}

for ($i = 0; $i < $fields; $i++) 
{ 
  // $header .= mysql_field_name( $result, $i) . "\t";
}
$data="";
$header="Region.". "\t";
$header="Zone.". "\t";
$header="Route.". "\t";
$header.="Prodcut". "\t";
$header.="Amount". "\t";
//$header.="Connection No.". "\t";
//$header.="Err Ind.". "\t";
//$header.="Tel No.". "\t";
//$header.="Amount". "\t";
//$header.="Region". "\t";
//echo $header;
$gy=" ";

$n=0;
while($row = mysqli_fetch_row( $result)) {
    $line = '';
    foreach($row as $value)
     {     
     $n=$n+1;                                       
        if ((!isset($value)) OR ($value == "")) 
        {       
           	switch ($n)
        	{
				case 3:
					//	  $value = "\'".$value;
					break;
				case 4:
					//	  $value = "\'".$value;
					break;
				case 5:
						//	  $value = "\'".$value;
					break;
	}
        
            $value = "\t";
        } else {
       //   $value = str_replace('"', '""', $value);
            $value ='"' . $value . '"' . "\t";
        }
     
        
        $line .= $value;
    }
    $data .= trim($line)."\n";
}
$data = str_replace("\r","",$data); 

if ($data == "")
 {
    $data = "\n(0) Records Found!\n";     
    }

header("Content-type: application/xx-msdownload");
header("Content-Disposition: attachment; filename=extraction.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data"; 
?> 
