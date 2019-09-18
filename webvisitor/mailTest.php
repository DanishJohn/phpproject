<?php

/*$headers = "From: jasoncowboy2@gmail.com\r\n" .
        "MIME-Version: 1.0\r\n" . 
        "Content-type: text/plain; charset=utf-8 \r\n";

$res = mail("cuvip517544@gmail.com", "Welcome", "hello friends",$headers);*/


include_once '../frameworks/PHPMailer.php';
include_once '../frameworks/SMTP.php';
include_once '../frameworks/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "jasoncowboy2@gmail.com";
$mail->Password = "anhemtoi517544";
$mail->setFrom("jasoncowboy2@gmail.com","Admin");
$mail->addAddress("cuvip517544@gmail.com");

$mail->isHTML(true);
$mail->Subject = "Feedback from Haven Bag Shop";
$mail->Body = "This is a mail test";

if (!$mail->send()) {
    echo "couldn't send mail";
}
echo "mail sent";