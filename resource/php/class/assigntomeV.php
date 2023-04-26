<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class assigntomeV extends config{

  public $uid,$tn;

  function __construct($uid=null,$tn=null) {
      $this->uid=$uid;
      $this->tn=$tn;
  }

  public function assigntomeV(){
      $con = $this->con();
      $sql = "UPDATE `tbl_verification` SET `assignee`=$this->uid WHERE `id` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
