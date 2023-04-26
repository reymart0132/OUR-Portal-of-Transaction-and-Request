<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
if(!empty($_POST)) {
    $studentN= $_POST['studentN'];
    $ygle = $_POST['ygle'];
    $fullname = $_POST['fullname'];
    $Course= $_POST['course'];
    $contactNumber= $_POST['contactNumber'];
    $email= strtoupper($_POST['email']);
    $uog= $_POST['uog'];
    $purpose= $_POST['purpose'];
    $arrayreq = $_POST['req'];
    $tn= $_POST['tn'];
    $request = implode(",", $arrayreq);
      $transaction = new etransaction($studentN,$fullname,$Course,$contactNumber,$email,$request,$purpose,$ygle,$uog,$tn);
      $transaction->editTransaction();
      header("location:../../dashboard.php");
  }else{
    header("location:../../dashboard.php?error=captchaError");
  }

?>
