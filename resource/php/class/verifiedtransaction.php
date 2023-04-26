<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class verifiedtransaction extends config{

  public $action,$tn,$id;

  function __construct($action=null,$tn=null,$id=null) {
      $this->action=$action;
      $this->tn=$tn;
      $this->id=$id;
  }

  public function verifiedTransaction(){
      $con = $this->con();
      $sql = "UPDATE `tbl_verification` SET `remarks`='VERIFIED',`date_verified`= NOW(),`verified_by`=$this->id WHERE `id` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
  public function verifiedTransaction2(){
      $con = $this->con();
      $sql = "UPDATE `tbl_verification` SET `remarks`='VERIFIED',`holdreleasedate`= NOW(),`verified_by`=$this->id WHERE `id` = '$this->tn'";
      $data= $con->prepare($sql);

      $data->execute();
    }
  public function verifiedStatus(){
      $con = $this->con();
      $sql = "INSERT INTO `tbl_status`(`status`,`assignee`,`actiondate`,`type`) VALUES ('$this->action','$this->id',NOW(),'VERIFIED') ";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
