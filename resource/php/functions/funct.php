<?php
function CheckSuccess($status,$tn){
    if($status =='Success'){
        echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> You have successfully submitted your request!<br />Please take note of your transaction number: <b><a id="tn" onclick="copyToClipboard(document.getElementById(\'tn\').innerHTML)" href="#">'.$tn.'</a></b>
                <p>Our SRA will contact you as soon as possible; once instructed to pay, please <b>make the payment within 5 days or your transaction will be forfeited,
                to check the status of your request you may click <a href="status.php">here</a>.</b></p>
                <p>If you question or concern please email dcaudal@ceu.edu.ph. Thank you!</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}
function SuccessV($status){
    if($status =='Success'){
      echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
              <b>Congratulations!</b> You have successfully a New Candidate Verification!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>';
    }
}

function CheckError($error){
    if($error =='MultipleTrans'){
      echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
              <b>Error!</b> Multiple transactions detected. You can only create <b>1 transaction per day only.</b>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>';
      }elseif($error =='captchaError'){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Incorrect CAPTCHA entry Detected. Please enter the correct captcha numbers below.</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
      }elseif($error =='tamper'){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Hi! we are having trouble validating your email address. Please use a different one and make sure to complete all the fields required. Thank you and stay safe!</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }elseif($error =='tamper2'){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Form tampering detected please make sure to complete all the fields required. Thank you and stay safe!</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}
function Success(){
    echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            <b>Congratulations!</b> You have successfully registered a new Student Records Assistant!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

function loginError(){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid Username/Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
function curpassError(){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid Current Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

function pError($error){
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
            <b>Error!</b> '.$error.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

function vald(){
     if(Input::exists()){
      if(Token::check(Input::get('Token'))){
         if(!empty($_POST['College'])){
             $_POST['College'] = implode(',',Input::get('College'));
         }else{
            $_POST['College'] ="";
         }
        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'username'=>array(
                'required'=>'true',
                'min'=>4,
                'max'=>20,
                'unique'=>'tbl_accounts'
            ),
            'password'=>array(
                'required'=>'true',
                'min'=>6,
            ),
            'ConfirmPassword'=>array(
                'required'=>'true',
                'matches'=>'password'
            ),
            'fullName'=>array(
                'required'=>'true',
                'min'=>2,
                'max'=>50,
            ),
            'email'=>array(
                'required'=>'true'
            ),
            'College'=>array(
                'required'=>'true'
            )));

            if($validate->passed()){
                $user = new user();
                $salt = Hash::salt(32);
                try {
                    $user->create(array(
                        'username'=>Input::get('username'),
                        'password'=>Hash::make(Input::get('password'),$salt),
                        'salt'=>$salt,
                        'name'=> Input::get('fullName'),
                        'joined'=>date('Y-m-d H:i:s'),
                        'groups'=>1,
                        'colleges'=> Input::get('College'),
                        'email'=> Input::get('email'),
                    ));

                    $user->createC(array(
                        'checker'=> Input::get('fullName'),

                    ));
                    $user->createV(array(
                        'verifier'=> Input::get('fullName'),
                    ));

                    $user->createR(array(
                        'releasedby'=> Input::get('fullName'),

                    ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }

                Success();
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
            }
        }
            }else{
                return false;
            }
        }

        function logd(){
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST,array(
                        'username' => array('required'=>true),
                        'password'=> array('required'=>true)
                    ));
                    if($validation->passed()){
                        $user = new user();
                        $remember = (Input::get('remember') ==='on') ? true :false;
                        $login = $user->login(Input::get('username'),Input::get('password'),$remember);
                        if($login){
                            if($user->data()->groups == 1){
                                 Redirect::to('dashboardOUR.php');
                                echo $user->data()->groups;
                            }else{
                                 Redirect::to('dashboardOUR.php');
                                echo $user->data()->groups;
                            }
                        }else{
                            loginError();
                        }
                    }else{
                        foreach($validation->errors() as $error){
                            echo $error.'<br />';
                        }
                    }
                }
            }
        }

        function isLogin(){
            $user = new user();
            if(!$user->isLoggedIn()){
                Redirect::to('sitelogin.php');
            }
        }

function profilePic(){
    $view = new view();
    if($view->getdpSRA()!=="" || $view->getdpSRA()!==NULL){
        echo "<img class='rounded-circle profpic img-thumbnail ml-3' height='5' alt='100x100' src='data:".$view->getMmSRA().";base64,".base64_encode($view->getdpSRA())."'/>";
    }else{
        echo "<img class='rounded-circle profpic img-thumbnail' alt='100x100' src='resource/img/user.jpg'/>";
    }
}

function updateProfile(){
    if(Input::exists()){
        if(!empty($_POST['College'])){
            $_POST['College'] = implode(',',Input::get('College'));
        }else{
           $_POST['College'] ="";
        }

        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'username'=>array(
                'required'=>'true',
                'min'=>4,
                'max'=>20,
                'unique'=>'tbl_accounts'
            ),
            'fullName'=>array(
                'required'=>'true',
                'min'=>2,
                'max'=>50,
            ),
            'email'=>array(
                'required'=>'true',
                'min'=>5,
                'max'=>50,
            ),
            'College'=>array(
                'required'=>'true'
            )));

            if($validate->passed()){
                $user = new user();

                try {
                    $user->update(array(
                        'username'=>Input::get('username'),
                        'name'=> Input::get('fullName'),
                        'colleges'=> Input::get('College'),
                        'email'=> Input::get('email')
                    ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                Redirect::to('dashboard.php');
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
        }

    }
}


function changeP(){
    if(Input::exists()){
        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'password_current'=>array(
                'required'=>'true',
            ),
            'password'=>array(
                'required'=>'true',
                'min'=>6,
            ),
            'ConfirmPassword'=>array(
                'required'=>'true',
                'matches'=>'password'
            )));

            if($validate->passed()){
                $user = new user();
                if(Hash::make(Input::get('password_current'),$user->data()->salt) !== $user->data()->password){
                    curpassError();
                }else{
                    $user = new user();
                    $salt = Hash::salt(32);
                    try {
                        $user->update(array(
                            'password'=>Hash::make(Input::get('password'),$salt),
                            'salt'=>$salt
                        ));
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                    Redirect::to('dashboard.php');
                }
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
        }
    }
}

function identifyItem($item){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_applied_for` where `id`=$item";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->appliedfor;
  }

function finditems($items){
  $items= explode(",", $items);
  $inventory="";
  $numItems = count($items);
  $i = 0;
  foreach ($items as $item) {
    if(++$i === $numItems) {
      $inventory .=identifyItem($item)."<br>";
    }else{
      $inventory .=identifyItem($item).",<br>";
    }
  }
  return strtoupper($inventory);
}

function finditems2($items){
  $items= explode(",", $items);
  $inventory="";
  $numItems = count($items);
  $i = 0;
  foreach ($items as $item) {
    if(++$i === $numItems) {
      $inventory .=identifyItem($item);
    }else{
      $inventory .=identifyItem($item).",";
    }
  }
  return strtoupper($inventory);
}

function dateconvert($date){
  $date = new DateTime($date);
  return $date->format('F-d-Y');
}

function findCourse($course){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_course` where `id`=$course";
    $data = $con-> prepare($sql);
    $data ->execute();
    $rows =$data-> fetchAll(PDO::FETCH_OBJ);
    return $rows[0]->course;
}
function findPurpose($purpose){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_purposes` where `purp_id`=$purpose";
    $data = $con-> prepare($sql);
    $data ->execute();
    $rows =$data-> fetchAll(PDO::FETCH_OBJ);
    return $rows[0]->purposes;
}

function findReq($req){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_applied_for` where `id`=$req";
    $data = $con-> prepare($sql);
    $data ->execute();
    $rows =$data-> fetchAll(PDO::FETCH_OBJ);
    return $rows[0]->appliedfor;
}

function datevalidation($email){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_transaction` WHERE `email`='$email' AND DATE(`dateapp`) = CURRENT_DATE()";
    $data = $con-> prepare($sql);
    $data ->execute();
    $rows =$data-> fetchAll(PDO::FETCH_OBJ);

    if(count($rows)==0){
      return true;
    }else{
      return false;
    }
  }

  function countMyPendingTransaction($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_transaction` WHERE `status` = 'PENDING' AND `assignee` =$id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countOfficePendingTransaction(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_transaction` WHERE `status` IN('FPO','PENDING')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countOfficePendingTransaction2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_transaction` WHERE `status` IN('FPO','PENDING')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      echo $rows[0]->COUNT;
  }
  function countMyPendingVerification2($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_verification` WHERE `remarks` = 'PENDING' AND `assignee` =$id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countTP(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_transaction` WHERE `status` = 'FPO' AND `assignee` IS NULL";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countMyForsignature($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_transaction` WHERE `status` = 'PRINTED' AND `assignee` =$id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countMyForRelease($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_transaction` WHERE `status` = 'FOR RELEASE' AND `assignee` =$id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countMyPendingVerification($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_verification` WHERE `remarks` = 'PENDING' AND `assignee` =$id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countVP(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_verification` WHERE `remarks` = 'PENDING' AND `assignee` IS NULL";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function countFPO($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS 'COUNT' FROM `tbl_transaction` WHERE `status` = 'FPO' AND `assignee` =$id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows[0]->COUNT;
  }
  function getTransactionDetails($tn){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_transaction` WHERE `transnumber` = '$tn'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows;
  }
  function getVerificationDetails($tn){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_verification` WHERE `id` = '$tn'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      return $rows;
  }

 function printedDocumentStatus($name,$items,$id){
    $config = new config;
    $con = $config->con();
    $itemname = $name."(".$items.")";
    $sql = "INSERT INTO `tbl_status`(`status`,`assignee`,`actiondate`,`type`) VALUES ('$itemname','$id',NOW(),'PRINTED') ";
    $data= $con->prepare($sql);
    $data->execute();
    }

    function findCourse2($course){
     $config = new config;
     $con = $config->con();
     $sql = "SELECT * FROM `tbl_course` where `id`=$course";
     $data = $con-> prepare($sql);
     $data ->execute();
     $rows =$data-> fetchAll(PDO::FETCH_OBJ);
     return $rows[0]->course;
    }
    function findpurpose2($purpose){
     $config = new config;
     $con = $config->con();
     $sql = "SELECT * FROM `tbl_purposes` where `purp_id`=$purpose";
     $data = $con-> prepare($sql);
     $data ->execute();
     $rows =$data-> fetchAll(PDO::FETCH_OBJ);
     return $rows[0]->purposes;
    }

  function cd($date){
    if ($date == NULL){
      return NULL;
    }else{
      return dateconvert($date);
    }
  }

  function findcycle($date1,$date2){
    if ($date1 == NULL || $date2 == NULL){
      return NULL;
    }else{
      $date3 = strtotime($date2) - strtotime($date1);
      $date3 = round($date3/(60 * 60 * 24));
      if($date3 == 0){
        return "1 day/s";
      }else{
        return $date3." day/s";
      }
    }
  }

  function findCycleTime(){ //regular month
      $config = new config;
      $con = $config->con();
      $sql = "SELECT AVG(datediff(`dateapp`,`readydate`)) AS `cycletime` FROM `tbl_transaction` WHERE monthname(`pulloutdate`) = monthname(now()) AND year(`dateapp`) = year(NOW())";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $cycletime = $rows[0]->cycletime;

      $cycletime = ($cycletime * -1);
      return $cycletime;
  }
  function findCycleTime3($date){ //custom month
      $config = new config;
      $con = $config->con();
      $sql = "SELECT AVG(datediff(`dateapp`,`readydate`)) AS `cycletime` FROM `tbl_transaction` WHERE monthname(`pulloutdate`) = monthname('".$date."-01') AND year(`dateapp`) = year('".$date."-01')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $cycletime = $rows[0]->cycletime;

      $cycletime = ($cycletime * -1);
      return $cycletime;
  }
  function findCycleTime2(){ //regularmonthverification
      $config = new config;
      $con = $config->con();
      $sql = "SELECT AVG(datediff(`date_recieved`,`date_verified`)) AS `cycletime` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname(now()) AND year(`date_recieved`) = year(NOW())";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $cycletime = $rows[0]->cycletime;

      $cycletime = ($cycletime * -1);
      return $cycletime;
  }
  function findCycleTime4($date){ //custommonthverification
      $config = new config;
      $con = $config->con();
      $sql = "SELECT AVG(datediff(`date_recieved`,`date_verified`)) AS `cycletime` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname('".$date."-01') AND year(`date_recieved`) = year('".$date."-01')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $cycletime = $rows[0]->cycletime;

      $cycletime = ($cycletime * -1);
      return $cycletime;
  }
  function findPending(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE `status` IN ('FPO','PENDING')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findPending3($date){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE `status` IN ('FPO','PENDING') AND monthname(`dateapp`) = monthname('".$date."-01') AND year(`dateapp`) = year('".$date."-01')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findPending2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE `remarks`= 'PENDING'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findPending4($date){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE `remarks`= 'PENDING' AND monthname(`date_recieved`) = monthname('".$date."-01') AND year(`date_recieved`) = year('".$date."-01')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findReceivedTransaction(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname(now()) AND year(`dateapp`) = year(NOW()) ";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }
  function findReceivedTransaction2($date){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname('".$date."-01') AND year(`dateapp`) = year('".$date."-01') ";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }
  function findReceivedTransactionSRA($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname(now()) AND `assignee`= '$id'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findReceivedVerification(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname(now()) AND year(`date_recieved`) = year(NOW()) ";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findReceivedVerification2($date){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname('".$date."-01') AND year(`date_recieved`) = year('".$date."-01') ";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findReceivedVerificationSRA($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname(now()) AND year(`date_recieved`) = year(NOW()) AND `assignee`= '$id'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findCompletedTransaction(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname(now()) AND year(`dateapp`) = year(NOW()) AND `status` NOT IN ('FPO','PENDING') ";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }
  function findCompletedTransaction2($date){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname('".$date."-01') AND year(`dateapp`) = year('".$date."-01') AND `status` NOT IN ('FPO','PENDING') ";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }
  function findCompletedVerification(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname(now()) AND year(`date_recieved`) = year(NOW()) AND `remarks` NOT IN ('PENDING')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }
  function findCompletedVerification2($date){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname('".$date."-01') AND year(`date_recieved`) = year('".$date."-01') AND `remarks` NOT IN ('PENDING')";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }
  function findReleasedTransaction(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname(now()) AND year(`dateapp`) = year(NOW()) AND `status`= 'RELEASED'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }
  function findReleasedTransaction2($date){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname('".$date."-01') AND year(`dateapp`) = year('".$date."-01') AND `status`= 'RELEASED'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;
      return $count;
  }

  function findAssignee($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_accounts` where `id` = $id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(!empty($rows)){
        return $rows[0]->name;
      }else{
        return "N/A";
      }

  }
  function findAssigneeEmail($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_accounts` where `id` = $id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(!empty($rows)){
        return $rows[0]->email;
      }else{
        return "N/A";
      }

  }

  function findResource(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_accounts`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      foreach ($rows as $row) {
        echo "<div class='col-12 my-4'>";
        echo "<div class='row '>";
        echo "<div class='col-5 col-md-2'>";
        if($row->dp =="" || $row->dp == NULL){
          echo "<img class='rounded-circle profpic img-thumbnail' alt='100x100' src='resource/img/user.jpg'/>";
        }else{
          echo "<img class='rounded-circle profpic img-thumbnail' alt='100x100' src='data:".$row->mm.";base64,".base64_encode($row->dp)."'/>";
        }
        echo  "</div>";
        echo "<div class='col-7'>";
        echo "<h5 class='text-left border-bottom'>$row->name</h5>";
        echo "<h6>Pending Transaction: <a class='text-primary'>".countMyPendingTransaction($row->id)."</a></h6>";
        echo "<h6>Total Transaction Received: <a class='text-primary'>".findReceivedTransactionSRA($row->id)."</a></h6>";
        echo "<h6>Pending Verification: <a class='text-primary'>".countMyPendingVerification2($row->id)."</a></h6>";
        echo "<h6>Total Verification Received: <a class='text-primary'>".findReceivedVerificationSRA($row->id)."</a></h6>";
        $vd = new viewdata($row->id);
        $vd->viewPrintedCountM();
        echo  "</div>";
        echo "</div>";
        echo "</div>";
      }
  }

//start report mail transaction
  function findResourceStatusCount(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_accounts`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $array = [];
      foreach ($rows as $row) {
        $ctransaction = findCompletedTransactionSRA($row->id);
        $array += [$row->name => $ctransaction];
      }
      return $array;
  }
  function findResourceStatusCount2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_accounts`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $array = [];
      foreach ($rows as $row) {
        $ctransaction = findCompletedVerificationSRA($row->id);
        $array += [$row->name => $ctransaction];
      }
      return $array;
  }


  function arrayCleaner($array){
    $x= count($array);
    for ($i=0; $i < $x ; $i++) {
      $key = array_search("0", $array);
        if ($key !== false) {
            unset($array[$key]);
        }
    }
   arsort($array);
   $statement="";
     if(count($array) ==0){
       return "<p>Not a single task has been completed today</p>";
     }else{

       foreach ($array as $key => $value) {
          $statement .="$key : <b style='font-size:110%;color:#ff8ba0;'>$value transaction/s </b> <br />";
        }
        return $statement;
      };
  }

  function findCompletedTransactionSRA($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_transaction` WHERE DATE(`printdate`)=CURDATE() AND `assignee`= '$id'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }
  function findCompletedVerificationSRA($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT count(*) AS `count` FROM `tbl_verification` WHERE DATE(`date_verified`)=CURDATE() AND `assignee`= '$id'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $count = $rows[0]->count;

      return $count;
  }

  function createTransactionReport($report){
    $key = array_search("0", $report);
    if ($key !== false) {
        unset($array[$key]);
    }
  }

  //start report mail transaction

  function profilePic2(){

      if($view->getdpSRA()!=="" || $view->getdpSRA()!==NULL){
          echo "<img class='rounded-circle profpic img-thumbnail ml-3' height='5' alt='100x100' src='data:".$view->getMmSRA().";base64,".base64_encode($view->getdpSRA())."'/>";
      }else{
          echo "<img class='rounded-circle profpic img-thumbnail' alt='100x100' src='resource/img/user.jpg'/>";
      }
  }

  function findReceivedTransactionToday(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_transaction` WHERE date(`dateapp`) =curdate() AND `status` <>'REMOVED' LIMIT 6";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $i=0;
      foreach ($rows as $row) {
      $i++;
      echo $i."<a href='viewtransaction.php?tn=$row->transnumber'>".". ".$row->fullname."  - ".$row->transnumber."</a><br />";
      }
      if(count($rows)>5){
        echo "<a class='btn btn-sm btn-info col-12 mt-5' href='transactionpool.php'> View More Transaction >>> </a>";
      }
  }
  function findReceivedVerificationToday(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_verification` WHERE date(`date_recieved`) =curdate() LIMIT 6";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $i=0;
      foreach ($rows as $row) {
      $i++;
      echo $i.". <a href='assigntoteamV.php?tn=$row->id'</a>$row->fullname</a><br />";
      }
      if(count($rows)>5){
        echo "<a class='btn btn-sm btn-info col-md-12 mt-5' href='verificationpool.php'> View More Verification >>> </a>";
      }
  }

  function findTeam(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_accounts`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $names="";
      foreach ($rows as $row) {
      $names= $names."'".$row->name."',";
      }
      $names=rtrim($names,",");
      return $names;
  }
  function findTeam2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_accounts`";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      $names="";
      foreach ($rows as $row) {
      $names= $names.$row->id.",";
      }
      $names=rtrim($names,",");
      return $names;
  }
  function findCountMember($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_transaction` WHERE `assignee` ='$id' AND date(`printdate`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        return 0;
      }else{
        return $rows[0]->count;
      }
  }
  function findCountMember2($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT SUM(`item_count`) AS `count` FROM `tbl_items` WHERE `assignee` ='$id' AND date(`date`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        return 0;
      }else{
        return $rows[0]->count;
      }
  }
  function countReceivedToday(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_transaction` WHERE date(`dateapp`) =curdate() AND `status` <>'REMOVED'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        return 0;
      }else{
        return $rows[0]->count;
      }
  }
  function countReceivedToday2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_transaction` WHERE date(`dateapp`) =curdate() AND `status` <>'REMOVED'";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        echo 0;
      }else{
        echo $rows[0]->count;
      }
  }
  function countVerificationToday(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_verification` WHERE date(`date_recieved`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        return 0;
      }else{
        return $rows[0]->count;
      }
  }
  function countVerificationToday2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_verification` WHERE date(`date_recieved`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        echo 0;
      }else{
        echo $rows[0]->count;
      }
  }
  function countVerificationCompletedToday(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_verification` WHERE date(`date_verified`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        return 0;
      }else{
        return $rows[0]->count;
      }
  }
  function countVerificationCompletedToday2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_verification` WHERE date(`date_verified`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        echo 0;
      }else{
        echo $rows[0]->count;
      }
  }
  function countPrintedToday(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_transaction` WHERE date(`printdate`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        return 0;
      }else{
        return $rows[0]->count;
      }
  }
  function countPrintedToday2(){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT COUNT(*) AS `count` FROM `tbl_transaction` WHERE date(`printdate`) =curdate()";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if($rows =="" || $rows == NULL){
        echo 0;
      }else{
        echo $rows[0]->count;
      }
  }

  function findTeamPrintedData(){
      $members = explode(",",findTeam2());
      $qty="";
      for ($i=0; $i <count($members); $i++) {
        $qty= $qty.findCountMember($members[$i]).",";
      }
      $qty=rtrim($qty,",");
      return $qty;

  }
  function findTeamPrintedData2(){
      $members = explode(",",findTeam2());
      $qty="";
      for ($i=0; $i <count($members); $i++) {
        $qty= $qty.findCountMember2($members[$i]).",";
      }
      $qty=rtrim($qty,",");
      return $qty;

  }

  function dynamicColor(){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts`";
    $data = $con-> prepare($sql);
    $data ->execute();
    $rows =$data-> fetchAll(PDO::FETCH_OBJ);
    $colors="";
    for ($i=0; $i < count($rows) ; $i++) {
      $colors= $colors."'".rand_color()."',";
    }
    $colors=rtrim($colors,",");
    return $colors;

  }

  function rand_color() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
  }

  function findSecretaryEmail($id){
      $config = new config;
      $con = $config->con();
      $sql = "SELECT * FROM `tbl_secretaries` where `id` = $id";
      $data = $con-> prepare($sql);
      $data ->execute();
      $rows =$data-> fetchAll(PDO::FETCH_OBJ);
      if(!empty($rows)){
        return $rows[0]->email;
      }else{
        return "N/A";
      }
  }

 function findGMC($transaction){
    $transaction = explode(",",$transaction);
    if(in_array('37',$transaction) == false){
      echo "hidden";
    }
 }

 function findSdocs($transaction){
    $transaction = explode(",",$transaction);
    if(array_intersect(["5","9","24","36"],$transaction) == true){
      return true;
    }
 }

 function findResourceEmail(){
     $config = new config;
     $con = $config->con();
     $sql = "SELECT * FROM `tbl_accounts`";
     $data = $con-> prepare($sql);
     $data ->execute();
     $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
     return $rows;
   }
function translock($lock){
 if($lock == 0){
   //do what it is supposed to do
 }
 else {
   header("location:locked");
   exit;
 }
}

function getTransLock(){
   $config = new config;
   $con = $config->con();
   $sql = "SELECT * FROM `adminconfig`";
   $data = $con-> prepare($sql);
   $data ->execute();
   $rows =$data-> fetchAll(PDO::FETCH_OBJ);
   return $rows[0]->translock;
}
function getLocker(){
   $config = new config;
   $con = $config->con();
   $sql = "SELECT * FROM `adminconfig`";
   $data = $con-> prepare($sql);
   $data ->execute();
   $rows =$data-> fetchAll(PDO::FETCH_OBJ);
   echo $rows[0]->lastlocker;
}

function checklock($lock){
 if($lock == 0){
   echo "Unlocked";
 }else{
   echo "Locked";
 }
}

