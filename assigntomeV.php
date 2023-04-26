<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$uid = $user->data()->id;
if(empty($_GET['tn'])){
  Redirect::to('dashboard.php');
}else{
  $atm= new assigntomeV($uid,$_GET['tn']);
  $atm->assigntomeV();
  Redirect::to('verificationpool.php');
}
// var_dump($transaction);
