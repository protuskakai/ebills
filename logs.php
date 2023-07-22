<body> 
</body>
<?php
$ip=$_SERVER['REMOTE_ADDR'];
 echo $ip;
include "net2.php";
echo "<title>NZOWASCO ICT HELPDESK - MPESA QUERIES</title>";
$result = mysqli_query($dbi," select * from logs where ip<>'$ip' or order by seq desc ");
//echo " select * from mpesa where '$fld' like '%$dat%' order by seq desc ";
$n=0;
echo " <b> MPESA Access Logs</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br><br>";
echo "<table width='70%' border='0' align='center'>\n" 
         ."<tr bgcolor='#CCE0EE'>\n" 
        ."<td width=10%> No.</td>\n"
         ."<td>Date</td>\n"
         ."<td>Time</td>\n"
         ."<td>IP</td>\n"
         ."<td>Query</td>\n"
   
        ."" 
        ."</tr>"; 
        $n=0;
         while ($data = mysqli_fetch_array($result))
 {
 $qry=$data['qry'] ;
 $pieces = explode(":", $qry);
 $n=$n+1;
  echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
           ."<td width=10%> $n</td>\n"
        //   ."<td>$data[tcode]</td>\n"
           ."<td>$data[dat]</td>\n"
           ."<td>$data[tim]</td>\n"
           ."<td>$data[ip]</td>\n"
           ."<td><a href='mpesax.php?fld=$pieces[0]&dat=$pieces[1]'>$data[qry]</a> </td>\n"
         //  ."<td align=right>$amt</td>\n"
        //   ."<td>$data[telno]</td>\n"
        //   ."<td>$data[ind] </td>\n"
           ."</tr>"; 
}
echo "</table>";
echo "	<table><td><td>&nbsp;&nbsp;&nbsp;<a href='javascript:history.back(1)'><img src='BACK.BMP' width='12' height='16' border='0' alt=''><img src='back2.gif' width='47' height='16' border='0' alt=''></a></td></tr></table>";
//include "kisfooter8.php";
?>