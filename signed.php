<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$uid = $user->data()->id;
$view = new view();
if(empty($_GET['tn'])){
  Redirect::to('dashboard.php');
}else{
  $transaction =getTransactionDetails($_GET['tn']);
}

if(isset($_GET['tn'])){
     $pt= new signtransaction($transaction[0]->fullname,$_GET['tn'],$uid);
     $pt->signTransaction();
     $pt->signedStatus();
     Redirect::to('vendor/release.php?mail='.$transaction[0]->email.'&name='.$transaction[0]->fullname.'&tn='.$_GET['tn'].'');
     // Redirect::to('fsign.php');
}

?>
