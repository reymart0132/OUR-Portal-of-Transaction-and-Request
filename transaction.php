<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
$view = new view;
translock(getTransLock());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Portal</title>
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap.min.css">
  <link href="vendor/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css"  href="resource/css/styles2.css">

</head>
<body>
  <header>

      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm slide-in-left">
        <a class="navbar-brand" href="https://ceu.edu.ph/">
            <img src="resource/img/logo.jpg" height="70" class=""
              alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="navbar-nav ml-auto">
            <a href="index" class="nav-item nav-link navitem ml-4 ">Home </a>
            <a href="transaction" class="nav-item nav-link navitem ml-4 active">Request a Document </a>
            <a href="status" class="nav-item nav-link navitem ml-4">Check Document Status</a>
          </div>
        </div>
      </nav>

        <div class="container mt-4 puff-in-center bgl shadow">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mt-5">New Document Request Transaction</h3>
                    
                     <small class="text-danger"><b>This document request form is for CEU Manila Alumni or Students ONLY.</b></small><br>
                    <small class="text-danger"><b>For CEU Makati Alumni/Student please fill up the form using this link:<a href="https://ceumktregistrar.com/report/transaction"> Makati Document Request Form<a/></small></b><br>
                    <small class="text-danger"><b>For CEU Malolos Alumni/Student please fill up the form using this link:<a href="https://ceumlsregistrar.com/report/transaction"> Malolos Document Request Form</a></b></small>

                </div>
                <?php
                if (!empty($_GET['status'])) {
                    CheckSuccess($_GET['status'],$_GET['tn']);
                }
                if (!empty($_GET['error'])) {
                    CheckError($_GET['error']);
                }


                ?>
            </div>
            <form action="/report/resource/php/registerTransaction.php" method="POST">
            <div class="row ">
                <table class="table ">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                      <label for="studentN">Student Number</label>
                                      <input type="text" class="form-control" id="studentN"  value="" name="studentN" aria-describedby="emailHelp" placeholder="Enter Student Number" maxlength="10" required>
                                      <small class="text-muted"><b>*Please enter 0000-00000 if you have forgotten your student number.</b></small>
                                    </div>
                                    <div class="form-group col-lg-4">
                                      <label for="studentN">Year Graduated or Last Enrolled</label>
                                      <input type="number" min="1900" max="2099" step="1" value="" class="form-control" id="ygle" name="ygle" aria-describedby="emailHelp" placeholder="Enter  Year Graduated or Last Enrolled" required>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="ContactNumber">Status</label>
                                        <div class="form-control">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="uog" id="Graduate" value="Graduate" checked>
                                              <label class="form-check-label" for="Graduate">Graduate</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="uog" id="Undergraduate" value="Undergrad">
                                              <label class="form-check-label" for="Undergraduate">Non-Graduate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="form-group col-12">
                                      <label for="Fullname">Full Name</label>
                                      <small class="text-muted"><b>*Please follow the format (Lastname - FirstName - Middlename)</b></small>
                                      <input type="text" class="form-control" id="Fullname" oninput="this.value = this.value.toUpperCase()"  name="fullname" aria-describedby="emailHelp" placeholder="Enter Fullname (Lastname - FirstName - Middlename)"  autocomplete="off" required>
                                      <small class="text-muted"><b>*Please enter the name that you have used during your tenure in CEU.</b></small>
                                      
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <div class="row">
                                  <div class="form-group col-md-12">
                                    <label for="Course" >Course</label><br />
                                        <select id="a" name="course" onchange="change();" class="selectpicker" data-live-search="true" required>
                                          <?php $view->degreeCourseSP();?>
                                        </select>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                      <label for="Purpose" >Reason for Requesting</label>
                                          <select id="Purpose" name="purpose" class="selectpicker form-control" data-live-search="true" required>
                                            <?php $view->reasonFA();?>
                                          </select>
                                      <small class="text-muted"><br><b>*Please indicate the reason for requesting(Scholarship, Abroad,etc.).</b></small>
                                    </div>
                                <div class="form-group col-md-6">
                                  <label for="ContactNumber">Contact Number</label>
                                  <input type="number" class="form-control" id="txtChar" name="contactNumber"  placeholder="Enter Contact Number" maxlength="11" required>
                                </div>
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group col-md-12">
                                  <label for="email">Email Address</label>
                                  <input type="email" class="form-control" id="txtChar" name="email"  placeholder="Enter your Personal Email Address" required>
                                  <small class="text-muted"><b>*Please ensure the correctness of the email address that you have entered as this will be used as the primary medium of communication that will be used to contact you.</b></small>

                                </div>
                              </div>
                            </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <h5>Documents to be Requested</h5>
                             
                            </div>
                            <div class="row">
                              <br><small class="text-muted"><b>*Please select at least 1 document to proceed.</b></small>
                            </div>
                             <small class="text-danger"><b>* For Certificate of Good Moral Request kindly email your college or school.</b></small><br>
                            <div class="row">
                              <?php $view->requestingForSP(); ?>
                            </div>
                        </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group col-md-12">
                                    <label for="addin">Full Instruction / Quantity</label><br />
                                    <small class="text-muted"><b>*Please mention below if already paid on-site for faster transaction. </b></small>
                                    <textarea name="addins" class="form-control" id="addin" placeholder="Kindly put the detail of the request here such as quantity or special instructions.
Example:
TOR x 3
COE x 1
'Request has a CGFNS Form attachments'
                                    " rows="5" required></textarea>
                                  </div>

                                </div>
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row justify-content-center ">
                                    <div class="form-group col-md-5 justify-content-center">
                                      <p><img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
                                      <p><input type="text" size="6" maxlength="5" name="captcha" value="">
                                      <small>copy the digits from the image into this box</small></p>
                                        <label  >&nbsp;</label>
                                     <input type="submit" value="Submit Request" class=" form-control btn btn-primary" />
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label  >&nbsp;</label>
                                        <small id="emailHelp" class="form-text text-muted">In compliance to<b> DATA PRIVACY ACT of 2012 (<em>R.A. No. 10173, Ch. 1 Sec 2)</em></b>.
                                            <p>If Client cannot come personally, the following are the requirements of Authorized Person:</p>
                                            <p class="mb-0">1. Authorization Letter</p>
                                            <p class="mb-0">2. ID of the Applicant and Authorized person with specimen signature(Xerox Copy)</p>
                                            <p class="mb-0"><b>Note:</b>
                                               Documents not claimed after Ninety (90) DAYS will be discarded</p>
                                               <p class="mb-0"><b>Side Note:</b>
                                              Please see the cycle time for each documents TOR 15 working days, Certificates 3 working days, Diploma 21 working days </p>
                                        </small>
                                    </div>
                                </div>
                            </td>
                        </tr>

                </table>
            </div>
        </form>
        </div>
    </header>
</body>
    <script src="vendor/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          var checkboxes = $('.checkboxes');
          checkboxes.change(function(){
              if($('.checkboxes:checked').length>0) {
                  checkboxes.removeAttr('required');
              } else {
                  checkboxes.attr('required', 'required');
              }
          });
      });
    </script>

    <script>
      function copyToClipboard(text) {
        window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
      }
    </script>
</body>
</html>
