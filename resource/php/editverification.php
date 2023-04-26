<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
if(!empty($_POST)) {
$id = $_POST['id'];
$fullName = $_POST['FullName'];
$edate = $_POST['edate'];
$gdate = $_POST['gdate'];
$bdate = $_POST['bdate'];
$Course= $_POST['Course'];
$Status= $_POST['Status'];
$type= $_POST['type'];
$cemail=$_POST['Email'];
$vcompany=$_POST['vcompany'];
$doca= $_POST['doca'];
$holdreason= $_POST['holdreason'];

      $transaction = new everification($id,$fullName,$edate,$gdate,$bdate,$Course,$Status,$type,$cemail,$vcompany,$doca,$holdreason);
      $transaction->editTransaction();
      header("location:../../pendingverificationpool.php");
  }else{
    header("location:../../pendingverificationpool.php?error=captchaError");
  }

?>
