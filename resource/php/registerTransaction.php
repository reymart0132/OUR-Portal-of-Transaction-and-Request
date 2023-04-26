<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';

if(!empty($_POST)) {


    if($_POST['captcha'] != $_SESSION['digit']){
    session_destroy();
    header("location:../../transaction.php?error=captchaError");
    die();
    }

$required = array('studentN', 'ygle', 'fullname', 'course', 'contactNumber', 'email','uog','req','addins');



$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "email invalid";
  header("location:../../transaction.php?error=tamper");
  die();
  }else{
  echo "email valid";
}


// Loop over field names, make sure each one exists and is not empty
$error = false;

foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}


if ($error) {
  echo "taena script kiddies";
  header("location:../../transaction.php?error=tamper2");
  die();
}


function sanitize($dirty){
  $clean = filter_var ($dirty, FILTER_SANITIZE_STRING);
  return $clean;
}


  $studentN= sanitize($_POST['studentN']);
  $ygle = sanitize($_POST['ygle']);
  $fullname = sanitize($_POST['fullname']);
  $Course= sanitize($_POST['course']);
  $contactNumber= sanitize($_POST['contactNumber']);
  $email= strtoupper($_POST['email']);
  $uog= sanitize($_POST['uog']);
  $purpose= sanitize($_POST['purpose']);
  $arrayreq = $_POST['req'];
  $request = implode(",", $arrayreq);
  $addins = sanitize($_POST['addins']);

  if(datevalidation($email) == false){
    header("location:../../transaction.php?error=MultipleTrans");
  }else{
    $transnumber =  uniqid('CEUOUR');
    $transaction = new ctransaction($studentN,$fullname,$Course,$contactNumber,$email,$request,$purpose,$addins,$ygle,$uog,$transnumber);
    $transaction->insertTransaction();

    $open = true;
     include "../../vendor/sendmail.php";
    //header("location:../../transaction?status=Success&&tn=$transnumber");


  }
}
?>
