<?php
require_once 'config.php';
class ctransaction{
    public $studentN,$fullname,$Course,$contactNumber,$email,$request,$purpose,$addins,$ygle,$uog,$transnumber;

    function __construct($studentN=null,$fullname=null,$Course=null,$contactNumber=null,$email=null,$request=null,$purpose=null,$addins=null,$ygle=null,$uog=null,$transnumber=null) {

        $this->studentN=$studentN;
        $this->ygle=$ygle;
        $this->fullname=$fullname;
        $this->Course=$Course;
        $this->contactNumber=$contactNumber;
        $this->email=$email;
        $this->uog=$uog;
        $this->purpose=$purpose;
        $this->request=$request;
        $this->addins=$addins;
        $this->transnumber=$transnumber;
    }

    public function insertTransaction(){
        $config = new config;
        $con = $config->con();
        $sql1 = "INSERT INTO `tbl_transaction`(`student_number`, `fullname`, `course`, `contact`, `email`, `drequest`, `purpose`,`instruction`, `grad_date`, `uog`,`transnumber`) VALUES ('$this->studentN','$this->fullname','$this->Course','$this->contactNumber','$this->email','$this->request','$this->purpose','$this->addins','$this->ygle','$this->uog','$this->transnumber')";
        $data1 = $con-> prepare($sql1);
        $data1 ->execute();
    }

    public function insertWork(){
        $config = new config;
        $con = $config->con();
        $purpose = $this->findPurpose();
        $Course = $this->findCourse();
        $College = $this->findCollege();
        $id =$this->findID();
        $sql1 = "INSERT INTO `work`(`id`,`StudentNo`,`LastName`,`FirstName`,`MI`,`Course`,`contact_no`,`Status`,`Applied_For`,`purposes`,`College`,`Date_App`,`Due_date`,`Date_Grad`,`assignee`,`formtype`)VALUES($id,'$this->studentN','$this->Lastname','$this->Firstname','$this->Middlename','$Course','$this->ContactNumber','$this->Status','$this->requests','$purpose','$College','$this->da','$this->dd','$this->ygle','$this->assignee','$this->formtype')";
        $data1 = $con-> prepare($sql1);
        $data1 ->execute();
        echo "success";
    }
    public function findCourse(){
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
