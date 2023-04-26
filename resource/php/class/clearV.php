<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class clearV extends config{

  public $action,$tn,$id;

  function __construct($action=null,$tn=null,$id=null) {
      $this->action=$action;
      $this->tn=$tn;
      $this->id=$id;
  }

  public function clearverification(){
      $con = $this->con();
      $sql = "UPDATE `tbl_verification` SET `remarks`='PENDING',`holdreason`= '' WHERE `id` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }

}
