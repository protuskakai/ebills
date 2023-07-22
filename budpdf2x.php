<?php
//25387065
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";
require("ebills/fpdf/fpdf.php");
     $pdf=new FPDF("P","mm","A4");
     
     $pdf->AddPage();
  // $pdf->Image('aaaa.jpg');
  $pdf->Image('logo22.jpg',10,6,30);
$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";

$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
//mysqli_select_db($dbi,$dbname); 
//$fld = $_POST['fld'];
$dat = $_GET['dat'];
$len=strlen($dat);
//echo "<br>";
//echo "<br>";
if ($len<12)
{
   die("Invalid Connection No."."<a href='javascript:history.back(1)'>Click here to go back");
}

//$qry= $fld.":".$dat;
//$fs=substr($dat, 0, 1);
$bal=0;
//echo "<title>NZOWASCO ICT HELPDESK - MPESA QUERIES</title>";
$result = mysqli_query($dbi," select * from Customer_accounts where customerid='$dat' order by dat, entid  ");
        $n=0;
     
          $pdf->SetFont("Arial","B",12);
          $pdf->write(5,"\n");
                  $pdf->write(5,"\n");
                  $pdf->write(5,"\n");
                  $pdf->write(5,"\n");
               $pdf->Cell(0,5,"Heading",1,1,"C");
               $pdf->write(5,"\n");
                  $pdf->write(5,"\n");
                  
      $pdf->SetFont("Arial","",12);
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
 //echo "\n\n<tr bgcolor='#CCD0EE'>\n" 
 //    ."<td width=10%> $n</td>\n"
        //  ."<td>$data[customerid]</td>\n"
  //        ."<td>$data[dat]</td>\n"
  //        ."<td>$data[item]</td>\n"
    //     ."<td  align=right>$amt</td>\n"
         
     //     ."<td   align=right>$bbal</td>\n"
     //       ."<td  align=left>$dr</td>\n"
    //     ."<td>$dr  </td>\n"
    //      ."<td align=right>$data[entid]</td>\n"
     //  ."</tr>";  
   
  //    $pdf-->Cell($n,6,"$data[dat]","LR");
 //       $pdf-->Cell($n,6,$bbal,'LR');
    //    $pdf-->Cell($n,6,number_format($amt,'LR',0,'R');
     //   $pdf-->Cell($n,6,number_format($bbal,'LR',0,'R');
  //      $pdf-->Ln();
    
   $pdf->Cell(30,5,"$data[dat]",1,0);
   $pdf->Cell(60,5," $data[item]",1,0);
  
  //    $pdf->Cell(30,5,"$dr",1,0);
    
        $pdf->Cell(30,5,"$amt",1,0,"R");
         $pdf->Cell(30,5,"$dr",1,0);
       
       $pdf->Cell(30,5,"$bbal",1,1,"R");
   // $pdf->Cell(1,5,"$bbal",1,0);
    // $pdf->Cell(1,5,"$amt",1,1);
   // $pdf->write(5,"$data[customerid]\t");
 //   $pdf->write(5,"$data[dat]\t");
//    $pdf->write(5,"$amt\t","R");
// $p= Footer();
//     $pdf->write(5,"$bbal\t");
  //      $pdf->write(5,"$dr\n","R");
   //  $pdf->Cell(2,30,"$data[customerid]",1,$n);
  //   $pdf->Cell(3,40,"$data[customerid]",4,$n);
}
 $pdf->SetFont("Arial","B",12);
  $pdf->Cell(180,5,"Balance     $bbal",1,1,"R");
  
$pdf->output();



function Footer()
{
    // Position at 1.5 cm from bottom
    $pdf->SetY(-15);
    // Arial italic 8
     $pdf->SetFont('Arial','I',8);
    // Page number
     $pdf->Cell(0,10,'Page '. $pdf->PageNo().'/{nb}',0,0,'C');
}
echo "</table>";



?>