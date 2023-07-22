<?php
   //  require("fpdf/fpdf.php");
  //   $pdf=new FPDF("P","mm","A4");
  //   $pdf->AddPage();
 //    $pdf->SetFont("Arial","B",16);
 //    $pdf->Cell(0,10,"Welcome",1,0,C);
  //   $pdf->output();
       require("fpdf/fpdf.php");
     $pdf=new FPDF("P","mm","A4");
     $pdf->AddPage();
     $pdf->SetFont("Arial","B",16);

     $pdf->Cell(0,10,"xxxx",1,0,C);
     $pdf->output();

?>