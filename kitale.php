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
$sql = "select max(entid) as 'mx' from Customer_accounts where reg='kitale'";

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

//echo $max;
//die("dddd");
$fld = $_POST['fld'];
$dat = $_POST['dat'];
$qry= $fld.":".$dat;
$fs=substr($dat, 0, 1);
$dbName1 = "C:\kwss\Frontend\MergeApp.mdb";
if (!file_exists($dbName1)) 
{
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName1; Uid=; Pwd=;");
$qq= gmdate("d/m/Y");

//$sql = "SELECT top 1, [Customer Accounts].CustomerID FROM [Customer Accounts] " ;
$sql= "SELECT top 200000,  [Customer Accounts].CustomerID, [Customer Accounts].EntryType, [Customer Accounts].InvNo, [Customer Accounts].Amount, [Customer Accounts].[Cr/Dr], [Customer Accounts].Date, [Customer Accounts].[Bill Date], Consumers_1.[Contact Name], Consumers_1.Address, Consumers_1.Phone, Consumers_1.Region, Consumers_1.[Postal Code], Consumers_1.Disconnected, Consumers_1.Disconnection_Date, [Customer Accounts].[Entryid] FROM [Customer Accounts] INNER JOIN Consumers_1 ON [Customer Accounts].CustomerID = Consumers_1.[Connection number] where [Customer Accounts].[Entryid]>$max and [Customer Accounts].Date<#$qq# order by [Customer Accounts].[Entryid]";
//$sql="select * from Consumers_1";
//echo $sql;
ini_set('memory_limit', '-1');
$result = $db->query($sql);
//echo "fffffff".$result;
//$result = $sql->execute();
$row = $result->fetchAll();

$i = 1;

$n=0;
//while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
foreach ($row as $book) 
{
  $dr= $book['Cr/Dr'];
  $dat=substr($book[Date], 0, 10);
 $amt=$book['Amount'];
 $reg="Kitale";
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
   $ent=$book['EntryType'];
   
    $ent = str_replace ("'","\'",$ent);
   $sql = "INSERT INTO Customer_accounts (customerid,dat,item,amt,dr_cr,pdat,ctim,entid,reg) VALUES ('$book[CustomerID]','$dat','$ent','$amt','$dr',CURDATE(),CURTIME(),'$book[Entryid]','$reg')";
  // echo $sql;
  $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
   $i++;
 //  echo $book['EntryType'];
}

echo "done";


?>