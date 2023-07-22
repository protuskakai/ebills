<?php

//$dat="0000";
//25387065
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";
   global $rmail;
    global $tel;
      global $nam;
    global $address;
    global $town;
    global $dat;
    global $rmail;
    global $tel;
     global $adat;
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    global $nam;
    global $address;
    global $town;
    global $dat;
      global $adat;
    global $rmail;
    global $tel;
    $xx= $adat[0];
    	switch ($xx){
	case "2":
		$rmail="Email : ktlcustomercare@nzoiawater.or.ke";
		$tel="05430282";
		break;
	case "3":
		$rmail="Email : webscustomercare@nzoiawater.or.ke";
		$tel="0774484801";
		break;
	case "4":
		 $rmail="Email : bgmcustomercare@nzoiawater.or.ke";
		 $tel="0518008692";
		break;
	case "5":
		 $rmail="Email : kimscustomercare@nzoiawater.or.ke";
		 $tel="0202410033";
		break;	
	}
    $this->Image('logo22.jpg',18,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(20,6,'NZOIA WATER SERVICES COMPANY LIMITED',0,1,'C');
     $this->SetFont('Arial','',8);
      $this->Cell(190,5,'P.O. BOX 1010-50205, WEBUYE, KENYA',0,1,'C');
    //   $this->Cell(190,5,'KENYA',0,1,'C');
          $this->Cell(190,5,$rmail.'   Tel : '.$tel,0,1,'C');
       
     // $this->Ln(30);
   //   $this->Cell(20,10,'NZOIA WATER SERVICES COMPANY LIMITED',0,0,'R');
    // Line break
    $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(180,5,'Customer Online Statement:  Connection No. '.$adat,1,1,'C');
        $this->SetFont('Arial','',8);
         $this->Cell(180,5,$nam.',  '.$address.',  '.$town,1,1,'C');
    //  $this->Cell(180,5,'Customer Statement:  Connection No. '.$dat,1,1,'C');
        $this->Ln(5);
         $this->Cell(30,5,'Date',1,0,'C');
            $this->Cell(60,5,'Description',1,0,'C');
               $this->Cell(30,5,'Amount',1,0,'C');
               $this->Cell(30,5,'DR/CR',1,0,'C');
                  $this->Cell(30,5,'Balance',1,1,'C');
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
       $tib=date(" H:i");
    $tim=date("d/m/Y");
      $this->Cell(0,10,'Printed on '. $tim." at ".$tib,0,0,'L');
   // ' date("Y/m/d")
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
 //     $this->Cell(0,10,'Printed on '. $tim,0,0,'L');
}

}
$adat = $_GET['dat'];
$len=strlen($adat);
//echo "<br>";
//echo "<br>";
if ($len<12)
{
   die("Invalid Connection No."."<a href='javascript:history.back(1)'>Click here to go back");
}
//echo $dat;
date_default_timezone_set('Africa/Nairobi');
$dbhost="localhost";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";

$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
//mysqli_select_db($dbi,$dbname); 
//$fld = $_POST['fld'];
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$bal=0;

$sql = "select * from customers  where  accno='$adat'";
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
//echo $nam;
//  die( "sss");
}


$pdf = new PDF();
$pdf->SetMargins(18,5,5);
$pdf->AliasNbPages();

$pdf->AddPage();
//
//$qry= $fld.":".$dat;
//$fs=substr($dat, 0, 1);
$bal=0;
//echo "<title>NZOWASCO ICT HELPDESK - MPESA QUERIES</title>";
$result = mysqli_query($dbi," select * from Customer_accounts where customerid='$adat' order by dat, entid  ");
        $n=0;
     
          $pdf->SetFont("Arial","B",12);
     //  $pdf->write(5,"Connection No: $dat\n");
     //             $pdf->write(5,"\n");
     //             $pdf->write(5,"\n");
     //             $pdf->write(5,"\n");
//               $pdf->Cell(0,5,"Heading",1,1,"C");
  //             $pdf->write(5,"\n");
 //                 $pdf->write(5,"\n");
                  
      $pdf->SetFont("Arial","",10);
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
	$item = substr($data['item'], 0, 35);
 $amt=number_format($amt,2);
  $bbal=number_format($bal,2);
 $dat = date("d-m-Y", strtotime($data['dat']));
   
  //    $pdf-->Cell($n,6,"$data[dat]","LR");
 //       $pdf-->Cell($n,6,$bbal,'LR');
    //    $pdf-->Cell($n,6,number_format($amt,'LR',0,'R');
     //   $pdf-->Cell($n,6,number_format($bbal,'LR',0,'R');
  //      $pdf-->Ln();
    
   $pdf->Cell(30,5,"$dat",1,0);
  $pdf->Cell(60,5,"$item ",1,0);
  //  $pdf->MultiCell( 200, 5 ," $data[item]", 1,0); 
  //    $pdf->Cell(30,5,"$dr",1,0);
    
        $pdf->Cell(30,5,"$amt",1,0,"R");
         $pdf->Cell(30,5,"$dr",1,0);
       
       $pdf->Cell(30,5,"$bbal",1,1,"R");
     // $pdf->Cell(1,5,"$bbal",1,0);
    // $pdf->Cell(1,5,"$amt",1,1);
    // $pdf->write(5,"$data[customerid]\t");
   //   $pdf->write(5,"$data[dat]\t");
   //   $pdf->write(5,"$amt\t","R");
   // $p= Footer();
   //     $pdf->write(5,"$bbal\t");
  //      $pdf->write(5,"$dr\n","R");
   //  $pdf->Cell(2,30,"$data[customerid]",1,$n);
  //   $pdf->Cell(3,40,"$data[customerid]",4,$n);
}
 $pdf->SetFont("Arial","B",10);
  $pdf->Cell(180,5,"Balance  C/F   $bbal",1,1,"R");
  
//$pdf->output('D','xxxx.pdf');

$pdf->Output('Statement_'.$adat.'.pdf', 'I');


echo "</table>";



?>