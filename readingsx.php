<?php
date_default_timezone_set('Africa/Nairobi');

$ip=$_SERVER['REMOTE_ADDR'];
$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$dat = $_POST['dat'];
//$datt = $_POST['datt'];
//echo $datt;
//$datt2 = new DateTime($datt);
//$datt3= $datt2->format('Y-m-d');
//$datt22=$datt2->format('d-m-Y');

$len=strlen($dat);
echo "<br>";
echo "<br>";
if ($len<12)
{
   die("Invalid Connection No."."<a href='javascript:history.back(1)'>Click here to go back");
}
$qry="Readings : ".$dat;
$tim=time("h:m:s");
$sql = "INSERT INTO logs (ip,qry,dat,tim) VALUES ('$ip','$qry',CURDATE(),CURTIME())";
//$sql = "INSERT INTO logs (ip,qry,dat,tim) VALUES ('$ip','$qry',CURDATE(),$tim)";
$result= mysqli_query($dbi,$sql);
//echo $sql;
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$bal=0;

$sql = "select * from customers  where  accno='$dat'";
//$result = mysql_query($sql,$dbi);  
//echo $sql;
$result= mysqli_query($dbi,$sql);
if (!$result)
{

}else
{

$data = mysqli_fetch_array($result);
 $nam=$data['nam'];
 $address=$data['address'];
$town=$data['town'];
}

//echo "$nam";
echo "<title>NZOWASCO - MPESA QUERIES</title>";

echo " <b>Customer Readings Statement for Connection No:   $dat </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br><br>";
echo " $nam <br>";
echo " $address,$town<br>";
//echo "<a href='excel_mpesa.php?dat=$dat'>Export to Excel</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//echo "<a href='/statements/index.php?controller=pages&action=statement&dat=$dat&datt3=$datt3'>Export to PDF <img src='pdf.jpg' width='3%' height='5%' alt=''></a>";
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
echo "<table width='40%' border='0' align='center'>\n" 
         ."<tr bgcolor='#CCE0EE'>\n" 
           ."<td>Year/Mon</td>\n"
          ."<td>Previous Reading</td>\n"
          ."<td>Current Reading</td>\n"
            ."<td  align=left>Consumption</td>\n"
                ."<td  align=left>Type</td>\n"
        ."" 
        ."</tr>"; 
        $n=0;
          $sql=" select * from readings where accno='$dat'  order by yr,mon";
//echo $sql;
$result = mysqli_query($dbi,$sql);     
$mons=array(" ","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
while ($data = mysqli_fetch_array($result))
  {
  $ss=explode(" ",$data['typ']);
  $styp=$ss[0];
   $mon=$mons[$data['mon']];
          echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
         ."<td>$data[yr]/$mon </td>\n"
             ."<td  align=center>$data[pread]</td>\n"
            ."<td  align=center>$data[cread]</td>\n"
            ."<td  align=center>$data[cons]</td>\n"
           ."<td  align=left>$styp</td>\n"     
        //      ."" 
            ."</tr>"; 
          
   }
  echo "</table>";

echo "<br>";
echo "<br>";
echo "<br>";
 echo "<br> <a href='javascript:history.back(1)'>Click here to go back</a>" ;

?>