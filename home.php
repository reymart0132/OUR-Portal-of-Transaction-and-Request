<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';

$user = new User();
echo $user->data()->name;
 ?>
