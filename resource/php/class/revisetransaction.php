<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class revisetransaction extends config{

  public $action,$tn,$id,$reason;

  function __construct($action=null,$tn=null,$id=null,$reason=null) {
      $this->action=$action;
      $this->tn=$tn;
      $this->id=$id;
      $this->reason=$reason;
  }

  public function reviseTransaction(){
      $con = $this->con();
      $sql = "UPDATE `tbl_transaction` SET `status`='PENDING',`flag`='REVISED',`flagdesc`='$this->reason' WHERE `transnumber` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
  public function reviseStatus(){
      $con = $this->con();
      $sql = "INSERT INTO `tbl_status`(`status`,`assignee`,`actiondate`,`type`) VALUES ('$this->action','$this->id',NOW(),'REVISION') ";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
