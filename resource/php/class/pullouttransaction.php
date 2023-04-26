<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class pullouttransaction extends config{

  public $action,$tn,$id;

  function __construct($action=null,$tn=null,$id=null) {
      $this->action=$action;
      $this->tn=$tn;
      $this->id=$id;
  }

  public function pullouttransaction(){
      $con = $this->con();
      $sql = "UPDATE `tbl_transaction` SET `status`='PENDING',`pulloutdate`=NOW() WHERE `transnumber` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
  public function pulloutstatus(){
      $con = $this->con();
      $sql = "INSERT INTO `tbl_status`(`status`,`assignee`,`actiondate`,`type`) VALUES ('$this->action','$this->id',NOW(),'PULLOUT') ";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
