<?php
require_once 'config.php';
class userverification{
    public $fullname,$edate,$gdate,$bdate,$Course,$Status,$type,$cemail,$vcompany,$doca;

    function __construct($fullname =null,$edate=null,$gdate=null,$bdate=null,$Course=null,$Status=null,$type=null,$cemail=null,$vcompany=null,$doca=null) {

        $this->fullname=$fullname;
        $this->edate = $edate;
        $this->gdate = $gdate;
        $this->bdate = $bdate;
        $this->Course=$Course;
        $this->Status=$Status;
        $this->type=$type;
        $this->cemail=$cemail;
        $this->vcompany=$vcompany;
        $this->doca=$doca;
    }

    public function insertVerification(){
        $config = new config;
        $con = $config->con();
        $sql1 = "INSERT INTO `tbl_verification`(`fullname`,`edate`,`gdate`,`bdate`,`Course`,`Status`,`type`,`cemail`,`date_recieved`,`doca`,`vcompany`)VALUES('$this->fullname','$this->edate','$this->gdate','$this->bdate','$this->Course','$this->Status','$this->type','$this->cemail',NOW(),'$this->doca','$this->vcompany')";
        $data1 = $con-> prepare($sql1);
        $data1 ->execute();
        echo "success";
    }
    public function findCourse2(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT * FROM `tbl_course` where `id`=$this->Course";
        $data = $con-> prepare($sql);
        $data ->execute();
        $rows =$data-> fetchAll(PDO::FETCH_OBJ);
        return $rows[0]->course;
    }
    public function findPurpose(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT * FROM `tbl_purposes` where `purp_id`=$this->Purpose";
        $data = $con-> prepare($sql);
        $data ->execute();
        $rows =$data-> fetchAll(PDO::FETCH_OBJ);
        return $rows[0]->purposes;
    }
    public function findCollege(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT * FROM `collegeschool` where `id`=$this->College";
        $data = $con-> prepare($sql);
        $data ->execute();
        $rows =$data-> fetchAll(PDO::FETCH_OBJ);
        return $rows[0]->college_school;
    }
    public function findID(){
        $config = new config;
        $con = $config->con();
        $sql = "SELECT * FROM `applications` WHERE `LastName` = '$this->Lastname' ORDER BY `created` DESC LIMIT 1";
        $data = $con-> prepare($sql);
        $data ->execute();
        $rows =$data-> fetchAll(PDO::FETCH_OBJ);
        return $rows[0]->id;
    }
}
?>
