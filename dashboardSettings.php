<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$username = $user->data()->name;


if(!empty($_POST)){
  $config = new config;
  $con = $config->con();
  $sql = "UPDATE `adminconfig` SET `translock`='$_POST[lock]',`lastlocker`='$username'";
  $data = $con-> prepare($sql);
  $data ->execute();
  header("location:dashboardOUR.php");
}
?>
