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
$sql = "select max(orderid) as 'mx' from billproducts where reg='kitale'";
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
$dbName1 = "C:\Kwss\Frontend\MergeApp.mdb";
if (!file_exists($dbName1)) 
{
    die("Could not find database file.");
}
$qq= gmdate("d/m/Y");
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName1; Uid=; Pwd=;");

$sql = "SELECT top 330000,  Orders.[Order ID] ,[Customer Accounts].Date, Regions.RegionName, Products.[Product Name], Sum([Order Details].Amount) AS SumOfAmount, Zones_1.[Zone number], route.RouteName FROM (([Customer Accounts] INNER JOIN (((Zones_1 INNER JOIN CONNECTIONS_1 ON Zones_1.[Zone number] = CONNECTIONS_1.[Zone number]) INNER JOIN Orders ON CONNECTIONS_1.[Connection number] = Orders.[Customer ID]) INNER JOIN Regions ON Zones_1.Region = Regions.RegionNumber) ON ([Customer Accounts].Amount = Orders.Amount) AND ([Customer Accounts].Date = Orders.[Order Date]) AND ([Customer Accounts].CustomerID = Orders.[Customer ID])) INNER JOIN route ON (CONNECTIONS_1.[Zone number] = route.[Zone Number]) AND (CONNECTIONS_1.[Walk Number] = route.[Rout Number])) INNER JOIN ([Order Details] INNER JOIN Products ON [Order Details].ProductID = Products.[Product ID]) ON Orders.[Order ID] = [Order Details].[Order ID] WHERE (( (([Customer Accounts].[Cr/Dr]) Like 'Debit')))  and Orders.[Order ID]>$max  and [Customer Accounts].Date<#$qq# GROUP BY  Orders.[Order ID] , [Customer Accounts].Date, Regions.[RegionName], Products.[Product Name], Zones_1.[Zone number], route.[RouteName]";

echo $sql;
ini_set('memory_limit', '-1');
$result = $db->query($sql);
$row = $result->fetchAll();
$i = 1;

$n=0;

foreach ($row as $book) 
{
//  $dr= $book['Cr/Dr'];
 // $dat=substr($book[Date], 0, 10);
// $amt=$book['Amount'];
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
   // SumOfAmount
 $route=$book['RouteName'];
 $amt=$book['SumOfAmount'];
 $orderid=  $book['Order ID'];
 $reg=  $book['RegionName']; 
 $item=$book['Product Name'];
 $zone=$book['Zone number'];
 //$dat=$book['Date'];
  $dat=substr($book[Date], 0, 10);
 //echo $dat;
 //die("sss");
  //$nam= str_replace ("'","\'",$nam);
 // $address= str_replace ("'","\'",$address);
   $route= str_replace ("'","\'",$route);
      $route= preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $route);
  //  echo "INSERT INTO customers (accno,nam,address,town,cdat,ctim,entid) VALUES ('$book[Connection number]','$book[Contact Name]','$book[address]','$book[town]',CURDATE(),CURTIME())";
  // $sql = "INSERT INTO customers (accno,nam,address,town,cdat,ctim,entid) VALUES ('$book['Connection number']','$book['Contact Name']','$book['address']','$book['town']',CURDATE(),CURTIME())";
  // echo "INSERT INTO customers (accno,nam,address,town,cdat,ctim) VALUES ('$accno','$nam','$address','$town',CURDATE(),CURTIME())";
 $sql = "INSERT INTO billproducts (orderid,route,amt,reg,item,zone,dat,cdat,ctim) VALUES ('$orderid','$route',$amt,'$reg','$item','$zone','$dat',CURDATE(),CURTIME())";
//echo $sql;
   $result= mysqli_query($dbi,$sql)  or die("I cannot connect to the database. Error :" . mysql_error());
   $i++;
 //  echo $book['EntryType'];
}

echo "done";


?>