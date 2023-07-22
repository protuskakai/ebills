
<?php

//$dat="0000";
//25387065
//$dbhost="nzoiawater.or.ke";
//$dbuser= "nzoiaw_kak2";
//$dbpass = "kitale2017";
//$dbname = "nzoiaw_kak";

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
     global $sdat;
     global $ydat;
      $xx= $dat[0];
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
      //$this->Cell(190,5,'P.O. BOX 1010-50205, WEBUYE',0,1,'C');
    //   $this->Cell(190,5,'KENYA',0,1,'C');
        $this->Cell(190,5,'P.O. BOX 1010-50205, WEBUYE, KENYA',0,1,'C');
    //   $this->Cell(190,5,'KENYA',0,1,'C');
          $this->Cell(190,5,$rmail.'   Tel : '.$tel,0,1,'C');
     // $this->Ln(30);
   //   $this->Cell(20,10,'NZOIA WATER SERVICES COMPANY LIMITED',0,0,'R');
    // Line break
    $this->Ln(10);
      $this->SetFont('Arial','B',10);
      $this->Cell(180,5,'Online Statement:  Connection No. '.$sdat.'   : As From 01-Jan-2017',1,1,'C');
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

//foreach($argv as $value)
//{
// echo $dat = "$value\n";
//}
//$dat = $_GET['dat'];


//echo $dat;
//echo "<br>";
//if ($len<12)
//{
  // die("Invalid Connection No."."<a href='javascript:history.back(1)'>Click here to go back");
//}
//echo $dat;
date_default_timezone_set('Africa/Nairobi');

$dbhost="192.168.1.2";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
//date_default_timezone_set('Africa/Nairobi');
$dd= $_SERVER['PHP_SELF'] ;

//$pieces = explode("/", $dd);
$rest = substr($dd, -16);
$dat = str_replace(".php", "",  $rest);
$sdat= $dat ; 
$mdat= date('Y-m-d', strtotime("-4 month"));
//echo $sdat;
//$dat="211211404314";
$len=strlen($dat);
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
//mysqli_select_db($dbi,$dbname); 
//$fld = $_POST['fld'];
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;
$bal=0;

$sql = "select * from customers  where  accno='$sdat'";
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
//$ydat=$data['dat'];
 //$ydat = date("d-m-Y", strtotime($data['dat']));
echo $ydat;
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
$sql = "SELECT sum(if(`dr_cr`='Debit',amt,0-amt)) as amtt FROM `Customer_accounts`  where  customerid='$dat' and date(dat)<'$mdat'"; 

   $result= mysqli_query($dbi,$sql);
if (!$result)
{
    $bf=0;
}else
{

$data = mysqli_fetch_array($result);
 $bf=$data['amtt'];

}
//echo $sql;

 $bal=$bf;   
$amtx=number_format($bf,2);
    $pdf->SetFont("Arial","",10);
  $pdf->Cell(30,5,$mdat,1,0);
  $pdf->Cell(60,5,"Opening Balance as at $mdat ",1,0);
  
    
        $pdf->Cell(30,5,"$amtx",1,0,"R");
         $pdf->Cell(30,5,"Balance B/F",1,0);
       
       $pdf->Cell(30,5,"$amtx",1,1,"R");

$result = mysqli_query($dbi," select * from Customer_accounts where customerid='$sdat' and date(dat)>='$mdat' order by dat, entid  ");
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
 $ydat = date("d-m-Y", strtotime($data['dat']));
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

   
  //    $pdf-->Cell($n,6,"$data[dat]","LR");
 //       $pdf-->Cell($n,6,$bbal,'LR');
    //    $pdf-->Cell($n,6,number_format($amt,'LR',0,'R');
     //   $pdf-->Cell($n,6,number_format($bbal,'LR',0,'R');
  //      $pdf-->Ln();
    
   $pdf->Cell(30,5,"$ydat",1,0);
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
//echo $sdat;
$pdf->Output('D:\xampp\htdocs\ebills\Statement_'.$sdat.'.pdf', 'F');


//echo "</table>";

$filename = $sdat.".par";
$handle = fopen ($filename, "r");
$contents = fread ($handle, filesize ($filename));
fclose ($handle);
emails($sdat,$contents);

?>

<?php

function emails($sss,$cont)
{

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.nzoiawater.or.ke';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'statement@nzoiawater.or.ke';                 // SMTP username
$mail->Password = 'statement@2017';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('statement@nzoiawater.or.ke', 'Nzoia Water');
$pieces = explode("/", $cont);
$ema=$pieces[0];
$enam=$pieces[1];
$pieces = explode("^^^", $ema);
$ema1=$pieces[0];
$enam1=$pieces[1];
// echo $ema1;
$mail->addAddress( $ema1,$enam1);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$attach='Statement_'.$sss.'.pdf';
//echo $attach;
$mail->addAttachment($attach,'Statement.pdf');    // Optional name
$mail->isHTML(false);                                  // Set email format to HTML

$mail->Subject = 'Customer Statement for Connection No.  '.$sss;
$mail->Body    = 'Please find the attached statement  for Connection No. <b></b>' .$sss;
$mail->AltBody = 'Please find attached statement';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
 //   echo 'Message has been sent';
}

}

?>