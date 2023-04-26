<?php
require_once 'config.php';
class addinventory{
    public $itemname,$tn,$quantity,$purpose,$assignee;

    function __construct($itemname=null,$tn=null,$quantity=null,$purpose=null,$assignee=null) {

        $this->itemname = $itemname;
        $this->tn = $tn;
        $this->quantity = $quantity;
        $this->purpose = $purpose;
        $this->assignee = $assignee;
    }

    public function insertinventory(){
        if($this->quantity > 0){
        $config = new config;
        $con = $config->con();
        $sql1 = "INSERT INTO `tbl_items`(`item_name`, `transaction_id`, `item_count`, `purpose`,`assignee`) VALUES ('$this->itemname','$this->tn','$this->quantity','$this->purpose','$this->assignee')";
        $data1 = $con-> prepare($sql1);
        $data1 ->execute();
      }
    }


      public function printedDocument(){
        $config = new config;
        $con = $config->con();
          $sql = "UPDATE `tbl_transaction` SET `status`= 'PRINTED',`printdate`=NOW() WHERE `transnumber` = '$this->tn'";
          $data= $con->prepare($sql);
          $data->execute();
        }


}

?>
