<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$uid = $user->data()->id;
if(empty($_GET['tn'])){
  Redirect::to('dashboard.php');
}else{
  $atm= new assigntome($uid,$_GET['tn']);
  $atm->assigntome();
  Redirect::to('transactionpool.php');
}
// var_dump($transaction);
