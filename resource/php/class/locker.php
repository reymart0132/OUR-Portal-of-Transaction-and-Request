<?php

class locker extends config{

    public function lockForm() {
        $config = new config();
        $con = $config->con();
        if ($this->checkLock() == "0"){
            $sql = "UPDATE `adminconfig` SET `translock` = '1'"; // close
        }
        else{
             $sql = "UPDATE `adminconfig` SET `translock` = '0'"; // open
        }
        $data = $con->prepare($sql);
        $data ->execute();
    }

    public function checkLock(){
        $config = new config();
        $con = $config->con();
        $sql = "SELECT `translock` FROM `adminconfig`";
        $data = $con->prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['translock'];
    }
}
?>