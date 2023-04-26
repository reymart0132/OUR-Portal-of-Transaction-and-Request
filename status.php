<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Portal</title>
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap.min.css">
  <link href="vendor/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css"  href="resource/css/main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">

</head>
<body>
<header>
  <div class="container-fluid navcon">
    <div class="container-fluid slide-in-left">
      <nav class="navbar navbar-expand-md navbar-dark">
        <img src="resource/img/logo.PNG" class="img-fluid logo"/>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a href="index" class="nav-item nav-link navitem ml-4">Home </a>
            <a href="transaction" class="nav-item nav-link navitem ml-4">Request a Document </a>
            <a href="status" class="nav-item nav-link navitem ml-4 active">Check Document Status</a>
          </div>
        </div>
      </nav>
    </div>
  </div>
        <div class="container mt-5  slide-in-left">
            <div class="row justify-content-center">
                <div class="col-md-10">
                      <?php

                      function sanitize($dirty){
                        $clean = filter_var ($dirty, FILTER_SANITIZE_STRING);
                        return $clean;
                      }

                      if(!empty($_POST['tn'])){
                        $transaction =getTransactionDetails(sanitize($_POST['tn']));
                        if($transaction != NULL){
                        $status = $transaction[0]->status;
                        $assignee = $transaction[0]->assignee;
                       }
                        if($transaction == NULL){
                          echo "<div class='p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > <a style='color:#ff8ba0;'>Invalid Transaction Number</a></h5>";
                          echo "Please check your transaction number and make sure that the capitalization and order is correct.<br /> If you have forgotten your transaction number please email  <a style='color:#ff8ba0;'>dcaudal@ceu.edu.ph</a>";
                          echo "<br />Our SRA will contact you regarding your request. Thank you and stay safe!";
                          echo "</div>";
                        }elseif($assignee == NULL){
                          echo "<div class='  p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>Pending Assignment</a></h6>";
                          echo "Your Transaction is now being reviewed and will be assigned to an SRA soon.<br />Once assigned our SRA will contact you thru your email( <a style='color:#ff8ba0;'>".$transaction[0]->email."</a> ) as soon as possible so make sure to keep your lines open. Thank you and stay safe!";
                          echo "<br /><br /> For clarifications you may send an email to <a style='color:#ff8ba0;'>dcaudal@ceu.edu.ph</a>";
                          echo "</div>";
                        }elseif($assignee != NULL && $status =="FPO"){
                          echo "<div class='  p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>Assigned / For Record Search </a></h6>";
                          echo "Our SRA (<a style='color:#ff8ba0;'> ".findAssignee($assignee)." </a>) is now working with your transaction and will be in touch with you soon, Please keep your lines open. Thank you and stay safe!";
                          echo "<br /><br /> For clarifications you may send an email to <a style='color:#ff8ba0;'>".findAssigneeEmail($assignee)."</a>";
                          echo "</div>";
                        }elseif($assignee != NULL && $status =="PENDING"){
                          echo "<div class='  p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>For Document Creation and Printing </a></h6>";
                          echo "Our SRA (<a style='color:#ff8ba0;'> ".findAssignee($assignee)." </a>) is now working with your transaction.</br></br><b>Please see our ETA for the following Transactions:</b><br /> Transcript of Records: <a style='color:#ff8ba0;'>15 working days</a> <br /> Certificates: <a style='color:#ff8ba0;'>3 working days</a> <br /> Diploma: <a style='color:#ff8ba0;'>21 working days</a><p><b>*Please take note that your request will only proceed upon receipt of your proof of payment.</b></p>";
                          echo "<br /><br /> For clarifications you may send an email to <a style='color:#ff8ba0;'>".findAssigneeEmail($assignee)."</a>";
                          echo "</div>";
                        }elseif($assignee != NULL && $status =="PRINTED"){
                          echo "<div class='  p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>For Signature of the Registrar </a></h6>";
                          echo "Your Document/s are now printed and is now <b style='color:#ff8ba0;'>for signature of the Registrar</b>.</br></br><b>Please see our ETA for the following Transactions:</b><br /> Transcript of Records: <a style='color:#ff8ba0;'>15 working days</a> <br /> Certificates: <a style='color:#ff8ba0;'>3 working days</a> <br /> Diploma: <a style='color:#ff8ba0;'>21 working days</a>";
                          echo "<br /><br /> For clarifications you may send an email to <a style='color:#ff8ba0;'>".findAssigneeEmail($assignee)."</a>";
                          echo "</div>";
                        }elseif($assignee != NULL && $status =="FOR RELEASE"){
                          echo "<div class='  p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>Ready for Release </a></h6>";
                          echo "Your Document/s are now ready for claim and release.</br></br>For everyone’s safety, kindly observe safety protocols.<br />Wear your facemask and maintain social distancing when claiming the documents.<br /> Our frontliners on site will assist you in claiming of your documents.";
                          echo "<br /><br /> For clarifications you may send an email to <a style='color:#ff8ba0;'>".findAssigneeEmail($assignee)."</a>";
                          echo "</div>";
                      }elseif($assignee != NULL && $status =="RELEASED"){
                          echo "<div class='  p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>RELEASED </a></h6>";
                          echo "<br />For immediate concern and clarifications you may send an email to <a style='color:#ff8ba0;'>".findAssigneeEmail($assignee)."</a>";
                          echo "</div>";
                      }elseif($assignee != NULL && $status =="REMOVED"){
                          echo "<div class='  p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>REMOVED and DECLINED </a></h6>";
                          echo "<h6 > Reason: <a style='color:#ff8ba0;'>".$transaction[0]->flagdesc."</a></h6>";
                          echo "<br />For immediate concern and clarifications you may send an email to <a style='color:#ff8ba0;'>".findAssigneeEmail($assignee)."</a>";
                          echo "</div>";
                        }elseif($assignee != NULL && $status =="MISC"){
                          echo "<div class='p-5 shadow  slide-in-left bgc'>";
                          echo "<h5 > Requestor: <a style='color:#ff8ba0;'>".$transaction[0]->fullname."</a></h5>";
                          echo "<h6 > Transaction Number: <a style='color:#ff8ba0;'>".$transaction[0]->transnumber."</a></h6>";
                          echo "<h6 > Status: <a style='color:#ff8ba0;'>AWAITING OTHER DOCUMENTS FROM OTHER DEPARTMENT / CHED </a></h6>";
                          echo "<br />For immediate concern and clarifications you may send an email to <a style='color:#ff8ba0;'>".findAssigneeEmail($assignee)."</a>";
                          echo "</div>";
                        }

                      }else{
                        include_once('resource/php/statusform.php');
                      }
                      ?>
              </div>
            </div>
         </div>
      </header>
</body>
    <script src="vendor/js/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/bootstrap-select.min.js"></script>
</body>
</html>
