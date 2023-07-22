<?php
emails("test","test");

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
//$ema=$pieces[0];
//$enam=$pieces[1];
//$pieces = explode("^^^", $ema);
//$ema1=$pieces[0];
//$enam1=$pieces[1];
// echo $ema1;
$mail->addAddress( "protuskakai@yahoo.com","Protus Kakai");     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$attach='Statement_'.$sss.'.pdf';
//echo $attach;
//$mail->addAttachment($attach,'Statement.pdf');    // Optional name
$mail->isHTML(false);                                  // Set email format to HTML

$mail->Subject = 'Customer Statement for Connection No.  '.$sss;
$mail->Body    = 'Please find the attached statement  for Connection No. <b></b>' .$sss;
$mail->AltBody = 'Please find attached statement';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo 'Message has been sent';
}

}

?>