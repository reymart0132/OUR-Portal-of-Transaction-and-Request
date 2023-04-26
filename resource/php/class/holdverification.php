<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class holdverification extends config{

  public $action,$tn,$id,$reason;

  function __construct($action=null,$tn=null,$id=null,$reason=null) {
      $this->action=$action;
      $this->tn=$tn;
      $this->id=$id;
      $this->reason=$reason;
  }

  public function holdVR(){
      $con = $this->con();
      $sql = "UPDATE `tbl_verification` SET `remarks`='ON-HOLD',`holdreason`='$this->reason',`holdyby`='$this->id',`date_verified`=NOW() WHERE `id` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
