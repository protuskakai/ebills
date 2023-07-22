<?php
session_start();




require('fpdf/fpdf.php');
// global $accno;

class PDF extends FPDF
{
// Page header
function Header()
{
   global $accno;
   global    $period;
// $accno=$_SESSION['accno'];
    //$accno="dfggfdfgf";
  //echo $accno;
    global $nam;
   global $address;
   global $town;
  //  $nam=$book['Name'];
// $Town=$book['Town'];
 global $biltyp;  //=$book['Bill Type'];
 global $prev;   //=$book['Prev Reading'];
 global $cread;   //=$book['Cur Reading'];
  global $metno;  //=$book['Meter Number'];
   global  $msize;   //=$book['Meter Size'];
   global  $cons;  //=$book['Consumption'];
   // Classification
  global    $class;  //=$book['Classification'];
   global  $address;  //=$book['Address'];
      // 'Prev Date
   global     $pdate;   //=$book['Prev Date'];
        //BillDate
     global    $billdate;  //=$book['BillDate'];
    global  $adj;//=$book['Adjustments'];
      global    $paid;//=$book['Payment'];
     global    $bal;//=$book['Balance'];
      global    $accbal;//=$book['Balance'];
       global    $billno;//=$book['Balance'];
 //    global $sdat;
  //   global $ydat;
     $xx= $accno[0];
  	switch ($xx)
  	{
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
//
    $this->Image('logo22.jpg',18,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(20,6,'RAILWAYS HOUSING CO-PERATIVE SOCIETY LTD',0,1,'C');
     $this->SetFont('Arial','',8);
      //$this->Cell(190,5,'P.O. BOX 1010-50205, WEBUYE',0,1,'C');
    //   $this->Cell(190,5,'KENYA',0,1,'C');
        $this->Cell(190,5,'P.O. BOX 20604/22, WEBUYE, KENYA',0,1,'C');
    //   $this->Cell(190,5,'KENYA',0,1,'C');
          $this->Cell(190,5,$rmail.'   Tel : '.$tel,0,1,'C');
     // $this->Ln(30);
   //   $this->Cell(20,10,'NZOIA WATER SERVICES COMPANY LIMITED',0,0,'R');
    // Line break
    
      $this->Ln(7);
  //     $this->SetCol($col);
       $this->SetFont('Arial','',6);
     $this->Cell(110,5,'',0,0,'L');
            $this->Cell(110,5,'INVOICE NO.  :  '.$billno,0,1,'L');
    //    $this->Cell(150,6,'INVOICE NO.  :  '.$billno,0,1,'R');
          $tim=date("d/m/Y");
     //      $this->Cell(150,6,'DATE OF ISSUE  :  '.$tim,0,1,'R');
               $this->Cell(110,5,'',0,0,'L');
            $this->Cell(110,5,'DATE OF ISSUE  :  '.$tim,0,1,'L');
           $duedate= date('d/m/Y', strtotime("+2 week"));
        $this->Cell(135,6,'THIS WATER BILL is due on or before:  '.$duedate,0,1,'L');
    $this->Ln(30);
      $this->SetFont('Arial','',6);
  
    //  $this->Cell(180,30,'EBILL:  Connection No. '.$sdat.'   : As From 01-Jan-2017',1,1,'C');
     $this-> SetY(45);
        $this->Cell(90,5,'',0,0,'L');
            $this->Cell(90,5,'',0,1,'L');
               $this->SetFont('Arial','B',7);
                 
           $this->Cell(90,5,'To',0,0,'L');
              $this->SetFont('Arial','',6);
            $this->Cell(90,5,'BILLING PERIOD '.$period,0,1,'L');
    
        $this->Cell(90,5,$nam,0,0,'L');
        $sse=Account  No.  '.$accno;
            $this->Cell(90,5,$sse,0,1,'L');
           // $accno= $book['Connection number'];

    
            
                $this->Cell(90,5,$address,0,0,'L');
            $this->Cell(90,5,'METER No.  '.$metno,0,1,'L');
                $this->Cell(90,5,$town,0,0,'L');
            $this->Cell(90,5,'CATEGORY  '.$class,0,1,'L');
    
    
    
           $this-> SetY(45);
            $this->Cell(90,35,'',1,0,'R');
              $this->Cell(90,35,'',1,1,'R');
    
      //$this->Ln(30);
    
      $this->SetFont('Arial','',8);
   //      $this->Cell(180,5,$nam.',  '.$address.',  '.$town,1,1,'C');
    //  $this->Cell(180,5,'Customer Statement:  Connection No. '.$dat,1,1,'C');
        $this->Ln(5);
         $this->SetFont('Arial','B',6);
         $this->Cell(30,5,'PREVIOUS READING',1,0,'C');
            $this->Cell(30,5,'PREVIOUS READING DATE',1,0,'C');
               $this->Cell(30,5,'CURRENT READING',1,0,'C');
                $this->Cell(30,5,'CURRENT READING DATE',1,0,'C');
               $this->Cell(30,5,'CONSUMPTION',1,0,'C');
                  $this->Cell(30,5,'BILL TYPE',1,1,'C');
                       $prevf=number_format($prev,0);
                    $this->Cell(30,5,$prevf,1,0,'C');
                          $date2=date_create($pdate);
         $billdatef=date_format($date2, 'd/m/y');
            $this->Cell(30,5,$billdatef,1,0,'C');
             $creadf=number_format($cread,0);
               $this->Cell(30,5,$creadf,1,0,'C');
               $date2=date_create($billdate);
         $billdatef=date_format($date2, 'd/m/y');
          //     $billdatef=date($billdatef, 'd/m/y');
                $this->Cell(30,5,$billdatef,1,0,'C');
                 $consf=number_format($cons,0);
               $this->Cell(30,5,$consf,1,0,'C');
                  $this->Cell(30,5,$biltyp,1,1,'C');
                   $this->SetFont('Arial','B',6);
            //-------------------------------------------------------------------------------------------------------------------------------------      
                    $this->Cell(120,5,'ACCOUNTS DETAILS',1,0,'C');
                         $this->Cell(60,5,'AMOUNT IN KSH',1,1,'C');
           //---------------------------------------------------------------------------------------------------------------------------------------      
              //   $pdf->SetX(11.5);    
               //     $this->Sety(12.6);    
                           $this->Cell(120,5,'BALANCE B/F FROM LAST BILL',1,0,'R');
                             $balf=number_format($bal,2);
                         $this->Cell(60,5,$balf,1,1,'R');
                    
                         $this->Cell(120,5,'PAYMENTS CREDITED SINCE LAST BILL',1,0,'R');
                           $paidf=number_format($paid,2);
                             $this->Cell(60,5,$paidf,1,1,'R');
                           $this->Cell(120,5,' BALANCE B/F',1,0,'R');
                           $accbal=$bal-$paid;
                             $accbalf=number_format($accbal,2);
                               $this->Cell(60,5,$accbalf,1,1,'R');
          //-------------------------------------loop area---------------------------------------------------------------------------------------
                         
                    //     $this->Cell(60,5,'AMOUNT IN KSH',1,1,'C');
        
       //                          $pdf->SetFont("Arial","B",10);
  //$pdf->Cell(180,5,"Balance  C/F   $bbal",1,1,"R");
  
//$pdf->output('D','xxxx.pdf');
//echo $sdat;
      
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
  //  $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
 //     $this->Cell(0,10,'Printed on '. $tim,0,0,'L');
}

}

ini_set('max_execution_time', 120000);
$monn=$_POST['mon'];
$yr=$_POST['yr'];
$zone=$_POST['zone'];
$dbhost="192.168.1.2";
$dbuser= "55509";
$dbpass = "kitale";
$dbname = "nzowasco";
$dbi  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("I cannot connect to the database. Error :" . mysql_error());;

$dbName1 = "C:\Kwss\Frontend\MergeApp.mdb";
if (!file_exists($dbName1))
{
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName1; Uid=; Pwd=;");

$sql = "select * from readings where  CONCAT(yr,mon)="$yr+mon+"'";
//echo $sql;
ini_set('memory_limit', '-1');
$result = $db->query($sql);
$row = $result->fetchAll();
$i = 1;

$n=0;




//--------------------------------------------------------------body- loop------------------------------------------------------------------------------------------------------------------------------------
//$accno= 'Connection number';
$n=0;
$desc=array();
$val=array();
foreach ($row as $book)
{

//
$n=$n+1;

if($n==1)
{
 $accno= $book['custid'];
 $nam=$book['nam'];
 $town=$book['reg'];
 $biltyp=$book['typ'];
 $prev=$book['pread'];
 $cread=$book['cread'];
  $metno=$book['metno];
    $msize=$book['metsz'];
       $cons=$book['cons'];
   // Classification
      $class=$book['Description'];
       $address=$book[paddr'];
      // 'Prev Date
        $pdate=prev_date('accno');
        //BillDate
        $billdate=date('d/m/Y');
      //  'Adjustments
      //  $adj=$book['Adjustments'];
          $paid=paid('accno');
         $bal=balance('accno');
       //  Billing period//
        $per=$book['mon'];
         $year=$book['yr'];
         $period= $per." ".$year;
         $billno=$book['seq'];
      }  
      
  //    $desc[$n]=$book['ProductID'];  //====================================================
  //     $val[$n]=$book['Charge'];
      
 
 
 
 }
 
  $pdf = new PDF();
$pdf->SetMargins(18,5,5);
$pdf->AliasNbPages();
$pdf->AddPage();
$tot=0;
   $max = sizeof($val);
   echo $max;
           $pdf-> SetY(120);
      for ($i = 1; $i <= $max; $i++) 
      {
                    $pdf->Cell(120,5,$desc[$i],0,0,'R');
                      $valf=number_format($val[$i],2);
                         $pdf->Cell(60,5,$valf,0,1,'R');
                         $tot=$tot+$val[$i];
          }
          
            $pdf-> SetY(120);
            $pdf->Cell(120,35,'',1,0,'R');
              $pdf->Cell(60,35,'',1,1,'R');
//$pdf->Rect(5,120,40,120);
//-------------------------------------------------------------------------end of body -----------------------------------------------------------------------------------------------------------------

  //-----------------------------------bill summary---------------------------------------------------------------------------------------
                   
                      $pdf->Cell(120,5,'ADJUSTIMENTS',1,0,'R');
                          $adjf=number_format($adj,2);
                           $pdf->Cell(60,5,$adjf,1,1,'R');
                         $pdf->Cell(120,5,'TOTAL CHARGES',1,0,'R');
                           $totf=number_format($tot,2);
                           $pdf->Cell(60,5,$totf,1,1,'R');
                           $due=$tot-$accbal+$adj;
                           $due=number_format($due,2);
                           $pdf->Cell(120,5,'TOTAL DUE',1,0,'R');
                            $pdf->Cell(60,5,$due,1,1,'R');
           //-----------------------------------message to customer--------------------------------------------------------------------------------  
             $pdf->Ln(2); 
                                 $pdf->Cell(135,6,'Message to Customer',0,1,'L');       
                                       
                           $pdf->Cell(180,25,'Message to Customer',1,1,'L');  
                      $pdf->Ln(2);    
                           
         /*   //-----------------------------------slip--------------------------------------------------------------------------------    
             $pdf->Cell(135,6,'Complete this portion, tear off and attach to the payment deposit slip when payment is made',0,1,'L');       
                               $pdf->Cell(90,5,'',1,0,'C');
                               $pdf->Cell(45,5,'Invoice No',1,0,'R');     
                                 $pdf->Cell(45,5,$billno,1,1,'R');              
                        
                        
                        $pdf->Cell(90,5,'Connection No. '.$accno,1,0,'L');
                               $pdf->Cell(45,5,'Total Due',1,0,'R');     
                                 $pdf->Cell(45,5,$due,1,1,'R');              
                          $pdf->Cell(90,5,'Deposit Slip No. ',1,0,'L');
                               $pdf->Cell(45,5,'Amount Paid',1,0,'R');     
                                 $pdf->Cell(45,5,'',1,1,'R');   
*/



$pdf->Output('D:\xampp\htdocs\ebills\Statement.pdf', 'F');  





//304243233694
       

?>
