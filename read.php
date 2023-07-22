
<?php
$accno=$_POST['dat'];
$conn=odbc_connect('infomix','pkakai','Kit@le50');
if (!$conn)
  {exit("Connection Failed: " . $conn);}
$sql="SELECT * FROM mt_reading where old_account='$accno' order by bill_month";
//$sql="SELECT * FROM ar_payment where phone_no='254718187848' order by payment_date";
$rs=odbc_exec($conn,$sql);
echo "<br><br>";
if (!$rs)
  {exit("Error in SQL");}
echo "<table width=70% align=center><tr bgcolor='#CCE0EE'>";
echo "<th >Bill Month</th>";
echo "<th>Read Type</th>";
echo "<th>Read Date</th></th>";
echo "<th>Curr Read</th></th>";
//echo "<th>Prev Date</th></th>";
echo "<th>Prev Read</th></th>";
echo "<th>Consumption</th></th>";
//echo "<th>Payment Mode</th></tr>";
$n=0;
while (odbc_fetch_row($rs))
{
$n=$n+1;
 if($n<500)
 {
  $billmon=odbc_result($rs,"bill_month");
   $rtyp=odbc_result($rs,"read_type");
  $rdate=odbc_result($rs,"read_date");
    $cread=odbc_result($rs,"curr_read");
 //   $pdate=odbc_result($rs,"prev_date");
      $pread=odbc_result($rs,"prev_read");
       $cons=odbc_result($rs,"consume");
  //    $by=odbc_result($rs,"entry_by");
  echo "<tr bgcolor='#CCD0EE' ><td align=center>$billmon</td>";
   echo "<td align=center>$rtyp</td></td>";
   echo "<td align=center>$rdate</td></td>";
  echo "<td align=center>$cread</td></td>";
 // echo "<td align=right>$pdate</td></td>";
    echo "<td align=center>$pread</td></td>";
      echo "<td align=center>$cons</td></tr>";
//       echo "<td>$tel</td></td>";
   // echo "<td>$pmode</td></tr>";
  }
}
odbc_close($conn);
echo "</table>";
?>
