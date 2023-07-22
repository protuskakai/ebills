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
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//echo $max;
//die("dddd");
$fld = $_POST['fld'];
$dat = $_POST['dat'];
$qry= $fld.":".$dat;
$fs=substr($dat, 0, 1);
$dbName1 = "C:\Kwss\Frontend\MergeApp.mdb";
//$dbName1 = "C:\Kwss\Backend\CAccounts.mde";
if (!file_exists($dbName1)) 
{
   die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName1; Uid=kakai; Pwd=kitale;");

$sql = "SELECT  amount FROM orders " ;
echo $sql;
ini_set('memory_limit', '-1');
$result = $db->query($sql);
$row = $result->fetchAll();
$i = 1;

$n=0;

echo "<pre>";
foreach ($row as $book) 
{
  $dr= $book['Cr/Dr'];
  $dat=substr($book[Date], 0, 10);
 $amt=$book['Amount'];
 
   $ent=$book['EntryType'];
   
    $ent = str_replace ("'","\'",$ent);
 
if($amt)
{  
     if($dat)
        {  
            $txt=$book[CustomerID]."^^^".$dat."^^^".$ent."^^^".$amt."^^^".$dr."^^^".$book[Entryid]."^^^"."\n";
            fwrite($myfile, $txt);
        }
}

 
 
   $i++;

}
fclose($myfile);
echo "done";


?>