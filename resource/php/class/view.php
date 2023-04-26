<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class view extends config{

        public function collegeSP2(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `collegeschool`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->college_school.'." value="'.$row->college_school.'">'.$row->college_school.'</option>';
                  echo 'success';
                }
        }

        public function getdpSRA(){
            $user = new user();
            return $user->data()->dp;
        }

        public function getMmSRA(){
            $user = new user();
             return $user->data()->mm;
        }

        public function degreeCourseSPedit(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_course`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);

                foreach ($rows as $row) {
                  echo '<option value="'.$row->id.'">'.$row->course.'</option>';
                }
        }
        public function degreeCourseSP(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_course`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
            echo '<option value="" disabled selected>Degree and Course</option>';
                foreach ($rows as $row) {
                  echo '<option value="'.$row->id.'">'.$row->course.'</option>';
                  echo 'success';
                }
        }

        public function collegeSP(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `collegeschool`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  $state = $row->state;
                  if ($state == "active") {
                    echo '<option data-tokens=".'.$row->college_school.'." value="'.$row->id.'">'.$row->college_school.'</option>';
                    echo 'success';
                  }
                }
        }

        public function findAssignee(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_accounts`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  $state = $row->state;
                    echo '<option data-tokens=".'.$row->name.'." value="'.$row->id.'">'.$row->name.'</option>';
                }
        }
        public function findSecretary(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_secretaries`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  $state = $row->state;
                    echo '<option data-tokens=".'.$row->name.'." value="'.$row->id.'">'.$row->name.' - '.$row->college.'</option>';
                }
        }

        public function reasonFA(){
              $config = new config;
              $con = $config->con();
              $sql = "SELECT * FROM tbl_purposes";
              $data = $con-> prepare($sql);
              $data ->execute();
              $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                  foreach ($rows as $row) {
                      $state = $row->state;
                    if ($state == "active") {
                      if ($row->purposes == 'FOR REFERENCE PURPOSES') {
                        echo '<option SELECTED data-tokens=".'.$row->purposes.'." value="'.$row->purp_id.'">'.$row->purposes.'</option>';
                        echo 'success';
                      }else {
                        echo '<option data-tokens=".'.$row->purposes.'." value="'.$row->purp_id.'">'.$row->purposes.'</option>';
                        echo 'success';
                      }

                    }
                  }
          }
        public function reasonFAedit(){
              $config = new config;
              $con = $config->con();
              $sql = "SELECT * FROM tbl_purposes";
              $data = $con-> prepare($sql);
              $data ->execute();
              $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                  foreach ($rows as $row) {
                      $state = $row->state;
                    if ($state == "active") {
                        echo '<option  data-tokens=".'.$row->purposes.'." value="'.$row->purp_id.'">'.$row->purposes.'</option>';
                      }

                    }
                  }

          public function requestingForSP(){
              $config = new config;
              $con = $config->con();
              $sql = "SELECT * FROM `tbl_applied_for` ORDER BY `appliedfor` ASC";
              $data = $con-> prepare($sql);
              $data ->execute();
              $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                  foreach ($rows as $row) {
                      $state = $row->state;
                    if ($state == "active") {

                      echo '<div class="form-check col-sm-6 mt-2">';
                      echo '<input class="form-check-input checkboxes" name="req[]" type="checkbox" value="'.$row->id.'" id="'.$row->appliedfor.'" required>';
                      echo '<label class="form-check-label" for="'.$row->appliedfor.'">';
                      echo strtoupper("$row->appliedfor");
                      echo '</label></div>';
                    }
                  }
          }



}
