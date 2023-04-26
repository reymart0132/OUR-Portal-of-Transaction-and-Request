<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class deletetransaction extends config{

  public $reason,$tn,$id;

  function __construct($reason=null,$tn=null,$id=null) {
      $this->reason=$reason;
      $this->tn=$tn;
      $this->id=$id;
  }

  public function deletetransaction(){
      $con = $this->con();
      $sql = "UPDATE `tbl_transaction` SET `flagdesc`= '$this->reason',`status`='REMOVED',`assignee`='$this->id' WHERE `transnumber` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
