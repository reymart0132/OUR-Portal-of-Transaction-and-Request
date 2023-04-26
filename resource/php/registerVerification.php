<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';

$user = new user();
$gr = $user->data()->groups;

if(!empty($_POST)) {
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
//duedate depricated
// $function = new findDate($da);
// $dd = $function->findDueDateV();
// $dd = $dd->format('Y-m-d');

$verification = new userverification($fullName,$edate,$gdate,$bdate,$Course,$Status,$type,$cemail,$vcompany,$doca);
$verification->insertVerification();

if ($gr == 1) {
  header("location:../../addverification.php?status=Success");
}else {
  header("location:../../addverification.php?status=Success");
}

}
?>
