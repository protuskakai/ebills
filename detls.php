<body> 
</body>
<?php
$ip=$_SERVER['REMOTE_ADDR'];
$dbhost="192.168.1.2";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$dat1= $_GET['dat1'];
$dat2= $_GET['dat2'];
$reg= $_GET['reg'];
$item= $_GET['item'];
//$mn1= $_POST['mon1'];
//$yr1= $_POST['yr1'];

//$dd2= $_POST['day2'];
//$mn2= $_POST['mon2'];
//$yr2= $_POST['yr2'];
//$reg= $_POST['reg'];
//$qry= $fld.":".$dat;
//$fs=substr($dat, 0, 1);
$tot=0;
//$dat1 = $yr1.'-'.$mn1.'-'.$dd1;
//$dat2 = $yr2.'-'.$mn2.'-'.$dd2;
//$dat2 = str_replace("/","-",$dat2); 
if(!$dat2)
{
 //die ( "No value given!   <a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a>");
}
if(!$dat1)
{
 //die ( "No value given!   <a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a>");
}

echo "<title>NZOWASCO ICT HELPDESK - MPESA QUERIES</title>";
$sql="select reg, zone, route, item, sum(amt) as tot from billproducts where dat between '$dat1' and '$dat2' and reg='$reg' and item='$item' group by  reg, zone, route, item";
//echo $sql;
$result = mysqli_query($dbi,$sql);

 echo " <b> Billed Products Report   ($reg  :  $dat1 -  $dat2 )</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br><br>";
 echo "<a href='detls_excel.php?dat1=$dat1&dat2=$dat2&reg=$reg&item=$item'>Export to Excel</a>";
 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
 echo "<table width='40%' border='0' align='center'>\n" 
         ."<tr bgcolor='#CCE0EE'>\n" 
         ."<td width=10%> No.</td>\n"
             ."<td>Region</td>\n"
                ."<td>Zone</td>\n"
                   ."<td>Route</td>\n"
         ."<td>Item</td>\n"
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

  
  echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
           ."<td width=10%> $n</td>\n"
       //    ."<td><a href='mpesa3.php?tcode=$data[tcode]'>$data[tcode]</a></td>\n"
           ."<td>$data[reg]</td>\n"
             ."<td>$data[zone]</td>\n"
               ."<td>$data[route]</td>\n"
           ."<td>$data[item]</td>\n"
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
           ."<td></td>\n"
            ."<td></td>\n"
             ."<td></td>\n"
           //   ."<td></td>\n"
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