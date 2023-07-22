<body> 
</body>
<?php
//$ip=$_SERVER['REMOTE_ADDR'];
$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$dd1= $_POST['day1'];
$mn1= $_POST['mon1'];
$yr1= $_POST['yr1'];

$dd2= $_POST['day2'];
$mn2= $_POST['mon2'];
$yr2= $_POST['yr2'];
//$reg= $_POST['reg'];
//$qry= $fld.":".$dat;
//$fs=substr($dat, 0, 1);
$tot=0;
$dat1 = $yr1.'-'.$mn1.'-'.$dd1;
$dat2 = $yr2.'-'.$mn2.'-'.$dd2;
//$dat2 = str_replace("/","-",$dat2); 
//echo $dat1;
if(!$dat2)
{
 die ( "No value given!   <a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a>");
}
if(!$dat1)
{
 die ( "No value given!   <a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a>");
}

echo "<title>NZOWASCO ICT HELPDESK -COLLECTIONS </title>";
$sql="select left(customerid,1) as 'regg',  sum(amt) as 'tot' from customer_accounts where  dr_cr='Credit' and dat between '$dat1' and '$dat2'  group by  left(customerid,1)";
//echo $sql;
$result = mysqli_query($dbi,$sql);

 echo " <b>Collections Summary By Region   $dat1 -  $dat2 )</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br><br>";
 echo "<a href='excel_mpesan.php?dat1=$dat1&dat2=$dat2'>Export to Excel</a>";
 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
 echo "<table width='40%' border='0' align='center'>\n" 
         ."<tr bgcolor='#CCE0EE'>\n" 
         ."<td width=10%> No.</td>\n"
             ."<td>Region</td>\n"
       //  ."<td>Item</td>\n"
      //   ."<td>Date/Time</td>\n"
      //   ."<td>Name</td>\n"
       //  ."<td>Region</td>\n"
       //  ."<td>Connection No.</td>\n"
         ."<td>Amount</td>\n"
     //    ."<td>Tel No.</td>\n"
     //   ."<td>Err Ind.</td>\n"
        ."" 
        ."</tr>"; 
        $n=0;
         while ($data = mysqli_fetch_array($result))
 {
 
  $amt=$data['tot'];
 // echo '$amt';
 $tot=$amt+$tot;
  $amt=number_format($amt,2);
  $n++;

	switch ($data['regg'])
	{
	
	case "2":
		$reg="kitale";
		break;
	case "3":
			$reg="Webuye";
		break;
	case "4":
		 	$reg="Bungoma";
		break;
			case   "5":
		 	$reg="Kimilili";
		break;
		default : 
		$reg="Uknown";
		break;
	}
  $det='$dat1'.' and'. '$dat2';
  echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
           ."<td width=10%> $n</td>\n"
       //    ."<td><a href='mpesa3.php?tcode=$data[tcode]'>$data[tcode]</a></td>\n"
           ."<td>$reg</td>\n"
      //     ."<td>$data[item]</td>\n"
       //    ."<td>$data[nam]</td>\n"
       //    ."<td>$regg</td>\n"
      //     ."<td><a href='mpesa4.php?accno=$data[accno]'>$data[accno]</a> </td>\n"
      
           ."<td align=right>$amt</td>\n"
     //      ."<td><a href='mpesa5.php?telno=$data[telno]'>$data[telno]</a></td>\n"
     //      ."<td>$data[ind] </td>\n"
           ."</tr>"; 
}
$amt=number_format($tot,2);

echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
           ."<td width=10%></td>\n"
       //    ."<td><a href='mpesa3.php?tcode=$data[tcode]'>$data[tcode]</a></td>\n"
      //     ."<td></td>\n"
           ."<td><b>Total Amount</b></td>\n"
       //    ."<td>$data[nam]</td>\n"
       //    ."<td>$regg</td>\n"
      //     ."<td><a href='mpesa4.php?accno=$data[accno]'>$data[accno]</a> </td>\n"
           ."<td align=right><b>$amt</b></td>\n"
     //      ."<td><a href='mpesa5.php?telno=$data[telno]'>$data[telno]</a></td>\n"
     //      ."<td>$data[ind] </td>\n"
           ."</tr>"; 
echo "</table>";
echo "	<table><td><td>&nbsp;&nbsp;&nbsp;<a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a></td></tr></table>";

?>