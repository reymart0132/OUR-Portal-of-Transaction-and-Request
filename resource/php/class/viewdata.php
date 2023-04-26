<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class viewdata extends config{

  public $id,$date;

  function __construct($id=null,$date=null) {
      $this->id=$id;
      $this->date=$date;
  }

  public function viewPullout(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_status` WHERE `assignee` = $this->id && `type` = 'PULLOUT' && `actiondate` LIKE '$this->date%'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);

      if(count($rows) > 0){

      echo "<h5 class='my-4'>Searched and Pulled-out the data of the following students:</h5>";

      foreach ($rows as $row) {
        echo "<h6 class='text-primary col-12'>-<em>$row->status</em></h6>";
     }
    }
   }
  public function viewPrinted(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_status` WHERE `assignee` = $this->id && `type` = 'PRINTED' && `actiondate` LIKE '$this->date%'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(count($rows) > 0){
      echo "<h5 class='my-4'>Printed the Documents of the following students:</h5>";

      foreach ($rows as $row) {
        echo "<h6 class='text-primary col-12'>-<em>$row->status</em></h6>";
     }
    }
   }
  public function viewRevised(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_status` WHERE `assignee` = $this->id && `type` = 'REVISION' && `actiondate` LIKE '$this->date%'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(count($rows) > 0){
      echo "<h5 class='my-4'>Corrections were made to the following students' documents:</h5>";

      foreach ($rows as $row) {
        echo "<h6 class='text-primary col-12'>-<em>$row->status</em></h6>";
     }
    }
   }
  public function viewSigned(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_status` WHERE `assignee` = $this->id && `type` = 'SIGNED' && `actiondate` LIKE '$this->date%'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(count($rows) > 0){
      echo "<h5 class='my-4'> Filed the following Documents for Releasing and Sent a Ready for release email to the client below:</h5>";

      foreach ($rows as $row) {
        echo "<h6 class='text-primary col-12'>-<em>$row->status</em></h6>";
     }
    }
   }
  public function viewReleased(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_status` WHERE `assignee` = $this->id && `type` = 'RELEASED' && `actiondate` LIKE '$this->date%'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(count($rows) > 0){
      echo "<h5 class='my-4'> Released the documents of the following students:</h5>";

      foreach ($rows as $row) {
        echo "<h6 class='text-primary col-12'>-<em>$row->status</em></h6>";
     }
    }
   }
  public function viewVerified(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_status` WHERE `assignee` = $this->id && `type` = 'VERIFIED' && `actiondate` LIKE '$this->date%'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(count($rows) > 0){
      echo "<h5 class='my-4'>Verification of the data of students listed below:</h5>";

      foreach ($rows as $row) {
        echo "<h6 class='text-primary col-12'>-<em>$row->status</em></h6>";
     }
    }
   }
  public function viewPrintedCount(){
      $con = $this->con();
      $sql = "SELECT `item_name`,sum(`item_count`) AS `quantity` FROM `tbl_items` WHERE `assignee`= $this->id && date(`date`) LIKE '$this->date%' GROUP BY `item_name`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);

      if(count($rows) > 0){
      echo "<h5 class='my-4'>Total Number of Documents Printed</h5>";

      foreach ($rows as $row) {
        echo "<h6 class='col-12'>-<em>".finditems2($row->item_name)." -<span class='text-primary'> $row->quantity </span></em></h6>";

     }
    }
   }
  public function viewPrintedCountM(){
      $con = $this->con();
      $sql = "SELECT `item_name`,sum(`item_count`) AS `quantity` FROM `tbl_items` WHERE `assignee`= $this->id && monthname(`date`) = monthname(now()) AND year(`date`) = year(NOW()) GROUP BY `item_name`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);

      if(count($rows) > 0){
      echo "<p class=''><b>Total Number of Documents Printed</b></p>";

      foreach ($rows as $row) {
        echo "<p>-".finditems2($row->item_name)." -<span class='text-primary'> $row->quantity </span></p>";

     }
    }
   }
  public function viewPrintedCountOffice(){
      $con = $this->con();
      $sql = "SELECT `item_name`,sum(`item_count`) AS `quantity` FROM `tbl_items` WHERE monthname(`date`) = monthname(now()) AND year(`date`) = year(NOW()) GROUP BY `item_name`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);

      if(count($rows) > 0){
      foreach ($rows as $row) {
        echo "<h6 class='col-12'>-<em>".finditems2($row->item_name)." -<span class='text-primary'> $row->quantity </span></em></h6>";

     }
    }
   }
  public function viewPrintedCountOffice2($date){
      $con = $this->con();
      $sql = "SELECT `item_name`,sum(`item_count`) AS `quantity` FROM `tbl_items` WHERE monthname(`date`) = monthname('".$date."-01') AND year(`date`) = year('".$date."-01') GROUP BY `item_name`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);

      if(count($rows) > 0){
      foreach ($rows as $row) {
        echo "<h6 class='col-12'>-<em>".finditems2($row->item_name)." -<span class='text-primary'> $row->quantity </span></em></h6>";

     }
    }
   }
  public function viewVerificationCountOffice(){
      $con = $this->con();
      $sql = "SELECT `remarks`,COUNT(*) AS `quantity` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname(now()) AND year(`date_recieved`) = year(NOW()) GROUP BY `remarks`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);

      if(count($rows) > 0){
      foreach ($rows as $row) {
        echo "<h6 class='col-12'>-<em>".$row->remarks." -<span class='text-primary'> $row->quantity </span></em></h6>";

     }
    }
   }
  public function viewVerificationCountOffice2($date){
      $con = $this->con();
      $sql = "SELECT `remarks`,COUNT(*) AS `quantity` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname('".$date."-01') AND year(`date_recieved`) = year('".$date."-01') GROUP BY `remarks`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);

      if(count($rows) > 0){
      foreach ($rows as $row) {
        echo "<h6 class='col-12'>-<em>".$row->remarks." -<span class='text-primary'> $row->quantity </span></em></h6>";

     }
    }
   }


}
