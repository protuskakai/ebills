<?php
//$filename = "MPESA 22.11.2018.txt";
$handle = fopen("MPESA 22.11.2018.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $line = str_replace("\n", "", $line);
        echo $line."\n\n!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
    }
    fclose($handle);
}

?>