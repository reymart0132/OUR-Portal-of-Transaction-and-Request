<?php
if(empty($_GET['tn'])){
  header("location:../transaction.php");
}
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'autoload.php';

$mail = new PHPMailer(true);

$email = $_GET['mail'];
$tn = $_GET['tn'];
$transaction =getTransactionDetails($_GET['tn']);
$name = $_GET['name'];

$body2 ="<h5><b>---THIS IS AN AUTO-GENERATED EMAIL MESSAGE, PLEASE DO NOT REPLY HERE---</b></h5><br>

        <p>Dear $name ,</p><p>We appreciate your patience while we work on your request.</p>

        <p>Kindly confirm the SPECIFIC DATE AND TIME (Schedule of Releasing of Documents is from Monday-Saturday 8:00am-5:00pm) you will have to pick up your document so we can log and prepare it prior to your visit.
            We regret that we will not accommodate walk-in clients outside their confirmed date of appointment or without prior appointment from us. During your visit, kindly bring the following:</p>

        <ul>
            <li> One (1) valid identification </li>
            <li> Digital Screenshot or printed copy of this email confirmation </li>
            <li> Please observe proper attire (no shorts/sando) </li>
        </ul>";

$body3 ="<p> If someone will receive your documents on behalf of you, please provide an <b> authorization letter addressed to Dr. Rhoda C. Aguilar, University Registrar, and attach a valid ID and the representative's ID. </b></p>

        <p>Upon receipt of this email, kindly contact the concerned SRA <b>(".findAssigneeEmail($transaction[0]->assignee).") or call (00632) 8735-68-77 / (00632) 8735-68-61 local 245 or 274 </b></p>
        
        <p>We would also want to request a few minutes of your time to assess the SRA <b>(".findAssignee($transaction[0]->assignee).")</b> who prepared your documents.</p>
        
        <p>Kindly click on the link: https://docs.google.com/forms/d/e/1FAIpQLSfScVwx_K8WWMBVUG9cSmCVMTYgG1VSEReVWulpgnPp_iEoiQ/viewform </p>
        
        <p>Thank you & Stay Safe!</p>
        
        
        <p>Note: If you have confirmed with your assigned SRA that the document/s you requested are for mailing, please disregard this email message.
        <p>Documents not claimed after <b>Ninety (90) DAYS</b> will be discarded</p>
        
        <br><h5><b>---THIS IS AN AUTO-GENERATED EMAIL MESSAGE, PLEASE DO NOT REPLY HERE---</b></h5>";

$body= $body2.$body3;
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';     //platform
    $mail->SMTPAuth   = true;
     $mail->Username   = getEm();   //email
    $mail->Password   = getToken();                   //password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('ceuourmailerMNL@gmail.com');       //sender
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'CEU DOCUMENT READY FOR RELEASE -'.$tn.'(DO NOT REPLY)';
    $mail->Body    = $body;             //content

    $mail->send();
    echo 'Message has been sent';
    header("location:../fsign.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    //header
