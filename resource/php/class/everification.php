<?php
require_once 'config.php';
class everification{
    public $id,$fullName,$edate,$gdate,$bdate,$Course,$Status,$type,$cemail,$vcompany,$doca,$holdreason;

    function __construct($id=null,$fullName=null,$edate=null,$gdate=null,$bdate=null,$Course=null,$Status=null,$type=null,$cemail=null,$vcompany=null,$doca=null,$holdreason=null) {

        $this->id=$id;
        $this->fullName=$fullName;
        $this->edate=$edate;
        $this->gdate=$gdate;
        $this->bdate=$bdate;
        $this->Course=$Course;
        $this->Status=$Status;
        $this->type=$type;
        $this->cemail=$cemail;
        $this->vcompany=$vcompany;
        $this->doca=$doca;
        $this->holdreason=$holdreason;
    }

    public function editTransaction(){
        $config = new config;
        $con = $config->con();
        $sql1 = "UPDATE `tbl_verification` SET `fullname`='$this->fullName',`edate`='$this->edate',`gdate`='$this->gdate',`bdate`='$this->bdate',`Course`='$this->Course',`Status`='$this->Status',`type`='$this->type',`cemail`='$this->cemail',`doca`='$this->doca',`vcompany`='$this->vcompany',`holdreason`='$this->holdreason' where `id` = '$this->id'";
        $data1 = $con-> prepare($sql1);
        // var_dump($data1);
        $data1 ->execute();
    }

}
?>
