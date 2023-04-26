<?php
require_once 'config.php';
class etransaction{
    public $studentN,$fullname,$Course,$contactNumber,$email,$request,$purpose,$ygle,$uog,$tn;

    function __construct($studentN=null,$fullname=null,$Course=null,$contactNumber=null,$email=null,$request=null,$purpose=null,$ygle=null,$uog=null,$tn=null) {

        $this->studentN=$studentN;
        $this->ygle=$ygle;
        $this->fullname=$fullname;
        $this->Course=$Course;
        $this->contactNumber=$contactNumber;
        $this->email=$email;
        $this->uog=$uog;
        $this->purpose=$purpose;
        $this->request=$request;
        $this->tn=$tn;
    }

    public function editTransaction(){
        $config = new config;
        $con = $config->con();
        $sql1 = "UPDATE `tbl_transaction` SET  `student_number`='$this->studentN', `fullname`='$this->fullname', `course`='$this->Course', `contact`='$this->contactNumber', `email`='$this->email', `drequest`='$this->request', `purpose`='$this->purpose', `grad_date`='$this->ygle', `uog`='$this->uog' WHERE `transnumber`='$this->tn'";
        $data1 = $con-> prepare($sql1);
        // var_dump($data1);
        $data1 ->execute();
    }

}
?>
