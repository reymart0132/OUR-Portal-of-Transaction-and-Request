<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class deleteverification extends config{

  public $reason,$tn,$id,$name;

  function __construct($reason=null,$tn=null,$id=null,$name=null) {
      $this->reason=$reason;
      $this->tn=$tn;
      $this->id=$id;
      $this->name=$name;
  }

  public function deleteverification(){
      $con = $this->con();
      $sql = "UPDATE `tbl_verification` SET `Remarks`='$this->reason',`assignee`='$this->id',`verified_by`=$this->id,`date_verified`= NOW() WHERE `id` = '$this->tn'";
      $data= $con->prepare($sql);
      $data->execute();
    }

    public function deleteverificationStatus(){
        $con = $this->con();
        $sql = "INSERT INTO `tbl_status`(`status`,`assignee`,`actiondate`,`type`) VALUES ('$this->name','$this->id',NOW(),'VERIFIED') ";
        $data= $con->prepare($sql);
        $data->execute();
      }
}
