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

$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
//mysqli_select_db($dbi,$dbname); 
$sql = "select max(accno) as 'mx' from customers where accno like '2%'";
//echo $sql;
//$result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
$result= mysqli_query($dbi,$sql);
$data = mysqli_fetch_array($result);
if ($data['mx']==null)
{
    $max=0;
}else
{

   $max=$data['mx'] ;
  // $max=0;
}

echo $max;
//die("dddd");
$fld = $_POST['fld'];
$dat = $_POST['dat'];
$qry= $fld.":".$dat;
$fs=substr($dat, 0, 1);
$dbName1 = "C:\Kwss\Frontend\MergeApp.mdb";
if (!file_exists($dbName1)) 
{
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName1; Uid=; Pwd=;");

$sql = "SELECT Consumers_1.[Connection number], Consumers_1.[Contact Name], Consumers_1.Town, Consumers_1.Address, Consumers_1.[Postal Code] FROM Consumers_1 where  Consumers_1.[Connection number]>'$max'  order by Consumers_1.[Connection number]";
//echo $sql;
ini_set('memory_limit', '-1');
$result = $db->query($sql);
$row = $result->fetchAll();
$i = 1;

$n=0;

foreach ($row as $book) 
{
  $dr= $book['Cr/Dr'];
  $dat=substr($book[Date], 0, 10);
 $amt=$book['Amount'];
 // 	if ($book['Cr/Dr']=='Debit')
  // 	{
  //        $n=$n+$book['Amount'];
   //   }else
    //  {

     //     $n=$n-$book['Amount'];

	   // }
 //echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
   //        ."<td width=10%> $i</td>\n"
    //       ."<td> $book[CustomerID]</td>\n"
     //      ."<td>$dat</td>\n"
   //        ."<td>$book[EntryType]</td>\n"
    //       ."<td  align=right>$amt</td>\n"
    //       ."<td  align=right>$n</td>\n"
    //       ."<td>$dr  </td>\n"
     //      ."<td align=right>$book[Entryid]</td>\n"
   //        ."</tr>"; 
 //  $ent=$book['EntryType'];
 $accno=  $book['Connection number'];
 $nam=  $book['Contact Name']; 
 $address=$book['Address'];
  $town=$book['Town'];
  $nam= str_replace ("'","\'",$nam);
   $address= str_replace ("'","\'",$address);
    $town= str_replace ("'","\'",$town);
    // $town= str_replace ("\","",$town);
     $town = str_replace ("\\", "", $town);
     $nam= preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $nam);
       $address= preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $address);
        $town= preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $town);
     //  $address = str_replace ("\\", "", $address);
  //  echo "INSERT INTO customers (accno,nam,address,town,cdat,ctim,entid) VALUES ('$book[Connection number]','$book[Contact Name]','$book[address]','$book[town]',CURDATE(),CURTIME())";
  // $sql = "INSERT INTO customers (accno,nam,address,town,cdat,ctim,entid) VALUES ('$book['Connection number']','$book['Contact Name']','$book['address']','$book['town']',CURDATE(),CURTIME())";
  // echo "INSERT INTO customers (accno,nam,address,town,cdat,ctim) VALUES ('$accno','$nam','$address','$town',CURDATE(),CURTIME())";
 $sql = "INSERT INTO customers (accno,nam,address,town,cdat,ctim) VALUES ('$accno','$nam','$address','$town',CURDATE(),CURTIME())";
 echo $sql;
   $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
   $i++;
   echo $book['EntryType'];
}

echo "done";


?>