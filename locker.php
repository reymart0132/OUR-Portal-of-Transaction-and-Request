<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';

$locker = new locker();
$locker->lockForm();

?>