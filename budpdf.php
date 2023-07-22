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

//$fld = $_POST['fld'];

  require("fpdf/fpdf.php");
     $pdf=new FPDF("P","mm","A4");
     $pdf->AddPage();
     $pdf->SetFont("Arial","B",16);
     $pdf->Cell(0,10,"Welcome",1,0,C);
     $pdf->output();


$dat = $_GET['dat'];
$len=strlen($dat);
echo "<br>";
echo "<br>";
if ($len<12)
{

   die("Invalid Connection No."."<a href='javascript:history.back(1)'>Click here to go back");

}
//$qry= $fld.":".$dat;
//$fs=substr($dat, 0, 1);
$bal=0;

echo "<title>NZOWASCO ICT HELPDESK - MPESA QUERIES</title>";
$result = mysqli_query($dbi," select * from Customer_accounts where customerid='$dat' order by dat, entid  ");
//echo "select * from Customer_accounts where customerid='$dat' order by dat, entid ";
//echo " select * from mpesa where '$fld' like '%$dat%' order by seq desc ";
//	echo "select * from Customer_accounts where customerid='$dat' order by  entid desc ";
echo " <b>Customer Statement for Connection No:   $dat </b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<br><br>";
echo "<a href='excel_mpesa.php?dat=$dat'>Export to Excel</a>";

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
//echo "<a href='status3b.php?stat=$stat'>Vertical View</a>";
 echo "<table width='50%' border='0' align='center'>\n" 
         ."<tr bgcolor='#CCE0EE'>\n" 
         ."<td width=10%> No.</td>\n"
      //   ."<td>Customer ID</td>\n"
         ."<td>Date</td>\n"
         ."<td>Item</td>\n"
         ."<td>Amount</td>\n"
        
         ."<td>Balance</td>\n"
          ."<td>DR/CR</td>\n"
      //   ."<td>Trans.Id</td>\n"
       // ."<td>Err Ind.</td>\n"
        ."" 
        ."</tr>"; 
        $n=0;
         while ($data = mysqli_fetch_array($result))
 {
 
 //$days=$data[sdate]-$data[dat];
 // $j=strtoupper($data[sprovider]) ;
 $amt=$data['amt'];
  $n++;
 $dr=$data['dr_cr'];
 	switch ( $dr)
 	{
	case "Debit":
		$bal=$bal+$amt;
		break;
	case "Credit":
	    $bal=$bal-$amt;
		break;
	}
	
  $amt=number_format($amt,2);
  $bbal=number_format($bal,2);
 echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
          ."<td width=10%> $n</td>\n"
        //  ."<td>$data[customerid]</td>\n"
          ."<td>$data[dat]</td>\n"
          ."<td>$data[item]</td>\n"
         ."<td  align=right>$amt</td>\n"
         
       
          ."<td   align=right>$bbal</td>\n"
            ."<td  align=left>$dr</td>\n"
    //     ."<td>$dr  </td>\n"
    //      ."<td align=right>$data[entid]</td>\n"
       ."</tr>"; 
}
echo "</table>";



?>