<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class releasetransaction extends config{

  public $action,$tn,$id,$name;

  function __construct($action=null,$tn=null,$id=null,$name=null) {
      $this->action=$action;
      $this->tn=$tn;
      $this->id=$id;
      $this->name=$name;
  }

  public function releaseTransaction(){
      $con = $this->con();
      $sql = "UPDATE `tbl_transaction` SET `status`='RELEASED',`releasedate`=NOW(),`releasenotes`='$this->action',`releaseby`=$this->id WHERE `transnumber` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
  public function releaseStatus(){
      $con = $this->con();
      $sql = "INSERT INTO `tbl_status`(`status`,`assignee`,`actiondate`,`type`) VALUES ('$this->name','$this->id',NOW(),'RELEASED') ";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
