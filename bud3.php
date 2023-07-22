<?php
$dbName = "C:\KWSS\Frontend\MergeAppnew.mdb";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");
//$sql="SELECT CustomerID FROM [Customer Accounts]";
$sql = "SELECT  [Customer Accounts].CustomerID, [Customer Accounts].EntryType, [Customer Accounts].InvNo, [Customer Accounts].Amount, [Customer Accounts].[Cr/Dr], [Customer Accounts].Date, [Customer Accounts].[Bill Date], Consumers_1.[Contact Name], Consumers_1.Address, Consumers_1.Phone, Consumers_1.Region, Consumers_1.[Postal Code], Consumers_1.Disconnected, Consumers_1.Disconnection_Date
FROM [Customer Accounts] INNER JOIN Consumers_1 ON [Customer Accounts].CustomerID = Consumers_1.[Connection number] where customerid='314243423721'";
$result = $db->query($sql);
$row = $result->fetchAll();
$i = 1;

echo "<pre>";
foreach ($row as $book) {
    echo $i . ": " . iconv("windows-1256", "utf-8", $book['CustomerID'])." ".$book['Date']." ".$book['EntryType']." ".$book['Amount']." ".$book['Cr/Dr']."\n";
    $i++;
}




?>