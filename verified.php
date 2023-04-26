<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$uid = $user->data()->id;
$view = new view();
if(empty($_GET['tn']) && empty($_GET['id'])){
  Redirect::to('dashboard.php');
}else{

  if(!empty($_GET['tn'])){
    $transaction =getVerificationDetails($_GET['tn']);
  }elseif(!empty($_GET['id'])){
    $transaction =getVerificationDetails($_GET['id']);
  }

}

if(isset($_GET['tn'])){
     $pt= new verifiedtransaction($transaction[0]->fullname,$_GET['tn'],$uid);
     $pt->verifiedTransaction();
     $pt->verifiedStatus();
     Redirect::to('pendingverificationpool.php');
}
if(isset($_GET['id'])){
     $pt= new verifiedtransaction($transaction[0]->fullname,$_GET['id'],$uid);
     $pt->verifiedTransaction2();
     $pt->verifiedStatus();
     Redirect::to('onholdV.php');
}

?>
