<?php

if(isset($open) && $open){
  //do what it is supposed to do
}
else {
  header("HTTP/1.1 403 Forbidden");
  exit;
}

if(empty($_POST)){
  header("location:../transaction.php");
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';

$mail = new PHPMailer(true);

$tn = $transnumber;
$name = $_POST['fullname'];
$body ="<p>Dear $name ,</p>

<p>Greetings of peace!</p>
<p>We have now received your request.</p>
<p>Please take note of the transaction number&nbsp;$tn</p>
<p>Our SRA will contact you as soon as possible; once instructed to pay, please make the payment within 5 days or your transaction will be forfeited.</p>
<p>You may check the status of your transaction number by visiting the website below</p>
<p>ceumnlregistrar.com/report/status</p>
<br><p><b>THIS IS AN AUTO GENERATED EMAIL PLEASE DO NOT REPLY</b></p>";

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
    $mail->setFrom('ceuourmailerMNL@gmail.com');       //sender
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'CEU DOCUMENT REQUEST -'.$tn;
    $mail->Body    = $body;             //content

    $mail->send();
    echo 'Message has been sent';
    header("location:../../transaction?status=Success&&tn=$tn");
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("location:../../transaction");
}
?>
