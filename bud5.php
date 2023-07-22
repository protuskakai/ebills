<?php
//25387065
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";
$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;

//mysqli_select_db($dbi,$dbname); 


$fld = $_POST['fld'];
$dat = $_POST['dat'];
$qry= $fld.":".$dat;
$fs=substr($dat, 0, 1);
$dbName1 = "C:\Kwss\Frontend\MergeAppNew.mdb";
if (!file_exists($dbName1)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName1; Uid=; Pwd=;");

$sql = "SELECT top 5,  [Customer Accounts].CustomerID, [Customer Accounts].EntryType, [Customer Accounts].InvNo, [Customer Accounts].Amount, [Customer Accounts].[Cr/Dr], [Customer Accounts].Date, [Customer Accounts].[Bill Date], Consumers_1.[Contact Name], Consumers_1.Address, Consumers_1.Phone, Consumers_1.Region, Consumers_1.[Postal Code], Consumers_1.Disconnected, Consumers_1.Disconnection_Date
FROM [Customer Accounts] INNER JOIN Consumers_1 ON [Customer Accounts].CustomerID = Consumers_1.[Connection number] where customerid='314243423721'";
$result = $db->query($sql);
$row = $result->fetchAll();
$i = 1;

$n=0;
echo "<table width='50%' border='0' align='center'>\n" 
         ."<tr bgcolor='#CCE0EE'>\n" 
         ."<td width=10%> No.</td>\n"
         ."<td>Connection No.</td>\n"
         ."<td>Date/Time</td>\n"
      //   ."<td>Name</td>\n"
      //   ."<td>Region</td>\n"
         ."<td>Entry Type</td>\n"
         ."<td>Amount</td>\n"
         ."<td>Running Balance</td>\n"
            ."<td>DR/CR</td>\n"
    //    ."<td>Err Ind.</td>\n"
        ."" 
        ."</tr>"; 

echo "<pre>";
foreach ($row as $book) 
{
  $dr= $book['Cr/Dr'];
  $dat=substr($book[Date], 0, 10);
  $amt=number_format($book['Amount'],2);
  	if ($book['Cr/Dr']=='Debit')
  	{
     $n=$n+$book['Amount'];
      }else
      {

    $n=$n-$book['Amount'];

	}
 echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
           ."<td width=10%> $i</td>\n"
           ."<td> $book[CustomerID]</td>\n"
           ."<td>$dat</td>\n"
           ."<td>$book[EntryType]</td>\n"
           ."<td  align=right>$amt</td>\n"
                 ."<td  align=right>$n</td>\n"
       ."<td>$dr  </td>\n"
         //  ."<td align=right>$amt</td>\n"
         //  ."<td>$data[telno]</td>\n"
       //    ."<td>$data[ind] </td>\n"
           ."</tr>"; 
//$sql = "INSERT INTO Customer_accounts (customerid) VALUES ('test')";
//$sql = "INSERT INTO Customer_accounts (customerid) VALUES ('$book[CustomerID]')";
$sql = "INSERT INTO Customer_accounts (customerid,dat,item,amt,dr_cr,pdat,ctim) VALUES ('$book[CustomerID]','$dat','$book[EntryType]','$amt','$dr',CURDATE(),CURTIME())";
//echo $sql;
$result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
 //echo "done";
 //   echo $i . ": " . iconv("windows-1256", "utf-8", $book['CustomerID'])." ".$book['Date']." ".$book['EntryType']." ".$book['Amount']." ".$book['Cr/Dr']."\n";
    $i++;
}




?>