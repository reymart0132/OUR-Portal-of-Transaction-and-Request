<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';

$mail = new PHPMailer(true);
$date= date("d-m-Y");
$resourcesArray = findResourceStatusCount();
$resourcesArray2 = findResourceStatusCount2();
$email = "rcbolasoc@ceu.edu.ph";
$body = '<h2>OUR Daily Report for <b style="color:#ff8ba0;">'.$date.'</b></h2><p style="margin:0;padding:0;">Total Number of Pending Transaction:<b style="font-size:110%;color:#ff8ba0;">'.countOfficePendingTransaction().'</b></p>'.
'<p style="margin:0;padding:0;">Total Number of Received Document Request:<b style="font-size:110%;color:#ff8ba0;">'. countReceivedToday().'</b></p>
<p style="margin:0;padding:0;">Total Number of Completed Document Request:<b style="font-size:110%;color:#ff8ba0;">'. countPrintedToday().'</b></p>'.arrayCleaner($resourcesArray).'<h3>Number of Completed Verification per <b style="color:#ff8ba0;">SRA</b></h3>'.arrayCleaner($resourcesArray2).'<br><b>This is an auto generated email--- please do not reply.</b>';
$emails = findResourceEmail();

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';     //platform
    $mail->SMTPAuth   = true;
    $mail->Username   = getEm();   //email
    $mail->Password   = getToken();                    //password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('rcbolasoc@ceu.edu.ph');       //sender
    for ($i=0; $i < count($emails); $i++) {
        $mail->addAddress($emails[$i]['email'],$emails[$i]['email']);
    }
    //Content
    $mail->isHTML(true);
    $mail->Subject = "OUR Daily Report $date";
    $mail->Body    = $body ;             //content

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    //header
