
<?php
$accno=$_POST['dat'];
$conn=odbc_connect('infomix','pkakai','Kit@le50');
if (!$conn)
  {exit("Connection Failed: " . $conn);}
$sql="SELECT ar_post_ledger.*  FROM ar_post_ledger, wb_consumer where post_acct=new_account and (new_account='$accno' or old_account='$accno') order by doc_date";
$rs=odbc_exec($conn,$sql);
if (!$rs)
  {exit("Error in SQL");}
echo "<br><br><table  width=60% align=center><tr bgcolor='#CCE0EE'>";
echo "<th>Date</th>";
echo "<th>Ref</th>";
echo "<th>DR</th>";
echo "<th>CR</th>";
echo "<th>Balance</th></tr>";
$n=0;
$bal=0;
while (odbc_fetch_row($rs))
{
$n=$n+1;
 if($n<500)
 {
//  $compname=odbc_result($rs,"connection");
//  $conname=odbc_result($rs,"meter_no");
    $dat=odbc_result($rs,"doc_date");
     $ref=odbc_result($rs,"doc_desc");
     
   
     
     
      $dr=number_format(odbc_result($rs,"post_amt_dr"),2);
       $cr=number_format(odbc_result($rs,"post_amt_cr"),2);
       
       
      //   if($ref=="Account Deposit")
         if(strcmp(trim($ref), "Account Deposit") == 0)
         {
         $bal=$bal+0;
        }else
       {
     
        $bal=$bal+odbc_result($rs,"post_amt_dr")-odbc_result($rs,"post_amt_cr");
       }
      $rbal= number_format($bal,2);
  echo "<tr bgcolor='#CCD0EE'><td>$dat</td>";
  echo "<td>$ref</td>";
  echo "<td align=right>$dr</td>";
  echo "<td align=right>$cr</td>";
   echo "<td align=right>$rbal</td>";
 // echo "<td>$conname</td></td>";
 // echo "<td>$billmon</td></tr>";
  }
}
 echo "<tr bgcolor='#CCD4EE'><td></td>";
  echo "<td align=center><b> Closing Balance</b></td>";
  echo "<td align=right></td>";
  echo "<td align=right></td>";
   echo "<td align=right><b>$rbal</b></td>";
odbc_close($conn);
echo "</table>";
?>
