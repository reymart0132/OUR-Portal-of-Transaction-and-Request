<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class assigntome extends config{

  public $id,$tn;

  function __construct($id=null,$tn=null) {

      $this->id=$id;
      $this->tn=$tn;
  }

  public function assigntome(){
      $con = $this->con();
      $sql = "UPDATE `tbl_transaction` SET `assignee`=$this->id WHERE `transnumber` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }
}
