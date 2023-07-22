
<?php
$accno=$_POST['dat'];
$conn=odbc_connect('infomix','pkakai','Kit@le50');
if (!$conn)
  {exit("Connection Failed: " . $conn);}
$sql="SELECT * FROM ar_payment where old_account='$accno' order by payment_date";
//$sql="SELECT * FROM ar_payment where phone_no='254718187848' order by payment_date";
$rs=odbc_exec($conn,$sql);
echo "<br><br>";
if (!$rs)
  {exit("Error in SQL");}
echo "<table width=70% align=center><tr bgcolor='#CCE0EE'>";
echo "<th >Account</th>";
echo "<th>Ref</th>";
echo "<th>date</th></th>";
echo "<th>Amount</th></th>";
echo "<th>Approved</th></th>";
echo "<th>By</th></th>";
echo "<th>Phone No</th></th>";
echo "<th>Payment Mode</th></tr>";
$n=0;
while (odbc_fetch_row($rs))
{
$n=$n+1;
 if($n<500)
 {
  $compname=odbc_result($rs,"old_account");
   $ref=odbc_result($rs,"cheque_slip");
  $conname=odbc_result($rs,"payment_date");
    $billmon=odbc_result($rs,"payment_amt");
    $pmode=odbc_result($rs,"payment_mode");
      $stat=odbc_result($rs,"auth_status");
       $tel=odbc_result($rs,"phone_no");
      $by=odbc_result($rs,"entry_by");
  echo "<tr bgcolor='#CCD0EE'><td>$compname</td>";
   echo "<td>$ref</td></td>";
  echo "<td>$conname</td></td>";
  echo "<td align=right>$billmon</td></td>";
    echo "<td align=center>$stat</td></td>";
      echo "<td>$by</td></td>";
       echo "<td>$tel</td></td>";
    echo "<td>$pmode</td></tr>";
  }
}
odbc_close($conn);
echo "</table>";
?>
