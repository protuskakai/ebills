<?php

$to = 'makingmoney497@gmail.com';
$subject = 'New EMail From Your web site:MakeMoneyCorner.com';
$name = $_POST['name'];
$email = $_POST['email'];
// Your message is set up strangely, try this:
$message = "
From: ".ucwords($name)."
Sent by: $email";
// Your header needs the words "From: " in it
$header = "From: $email";

if($_POST){
    // You are saying if the mail to you succeeds, continue on.
    if(mail($to, $subject, $message, $header)) 
    {
        // Your browser message to them
        $feedback = 'your information has been successfully Send it';
        if(filter_vars($email, FILTER_VALIDATE_EMAIL)) {
            $headerRep  = "From: makingmoneycorner.com <makingmoney497@gmail.com>";
            $subjectRep =   "This Is Your Book About Making Money";
            $messageRep =   "you can download here :";
            mail($email, $subjectRep, $messageRep, $headerRep);
        }
    }
}
?>