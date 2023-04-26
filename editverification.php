<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$view = new view();
$uid = $user->data()->id;
if(empty($_GET['tn'])){
  Redirect::to('pendingverificationpool.php');
}else{
  $transaction =getVerificationDetails($_GET['tn']);
}
// var_dump($transaction);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Portal</title>
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap.min.css">
  <link href="vendor/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css"  href="resource/css/styles.css">
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">
  <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.print.min.js"></script>
  <link rel="stylesheet" type="text/css"  href="resource/css/styles.css">

</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm slide-in-left" style="z-index:10; ">
    <a class="navbar-brand" href="https://ceu.edu.ph/">
        <img src="resource/img/logo.jpg" height="70" class=""
          alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuTransaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Transaction Menu
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuTransaction">
            <a class="dropdown-item " href="transactionpool.php">Transaction Pool</a>
            <a class="dropdown-item " href="rfpo.php">For Pullout</a>
            <a class="dropdown-item " href="dashboard.php">Pending Transaction <span class="sr-only">(current)</span></a>
            <a class="dropdown-item " href="fsign.php">For Signature </a>
			<a class="dropdown-item " href="sfiles.php">Special Files </a>
			<a class="dropdown-item " href="frelease.php">For Releasing </a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuVerification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Verification Menu
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuVerification">
            <a class="dropdown-item " href="addverification.php">Add Verification</a>
            <a class="dropdown-item " href="verificationpool.php">Verification Pool</a>
            <a class="dropdown-item " href="pendingverificationpool.php">Pending Verification</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuAccounts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            R & S
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuAccounts">
            <a class="dropdown-item" href="office.php">OUR Transaction Report</a>
            <a class="dropdown-item" href="officeV.php">OUR Verification Report</a>
            <a class="dropdown-item" href="sraM.php">SRA Monthly Report</a>
            <a class="dropdown-item" href="releasedT.php">Released Transactions</a>
            <a class="dropdown-item" href="ftrm.php">Failed Transaction and Revisions(Monthly)</a>
            <a class="dropdown-item" href="dashboardOUR.php">OUR Dashboard</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuAccounts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Accounts Menu
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuAccounts">
            <a class="dropdown-item " href="output.php">OFT</a>
            <a class="dropdown-item border" href="updateprofile.php">Update Profile</a>
            <a class="dropdown-item" href="Logout.php">Logout</a>
          </div>
        </li>

      </ul>
    </div>
</nav>

    <div class="container mt-4 puff-in-center mb-5">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Edit Verification Request (<a style="color:#ff8ba0" href="#"><?php echo $transaction[0]->fullname ?> - <?php echo $transaction[0]->vcompany ?> </a>)</h3>
            </div>
        </div>
        <form action="/report/resource/php/editverification.php" method="POST">
        <div class="row mb-5">
            <table class="table">
              <tr>
                  <td>
                      <div class="row">
                        <div class="form-group col-12">
                          <label for="FullName">FullName</label>
                          <input type="hidden" class="form-control" value="<?php echo $_GET['tn'] ?>"  name="id" required>
                          <input type="text" class="form-control" value="<?php echo $transaction[0]->fullname ?>" id="Lastname" oninput="this.value = this.value.toUpperCase()"  name="FullName" aria-describedby="emailHelp" placeholder="Enter Lastname" maxlength="49" required>
                        </div>
                          <div class="form-group col-lg-4">
                            <label for="edate">Entrance Date</label>
                            <input type="text"  class="form-control" value="<?php echo $transaction[0]->edate ?>" id="edate" name="edate" aria-describedby="emailHelp" placeholder="Enter  Year Graduated or Last Enrolled">
                          </div>
                          <div class="form-group col-lg-4">
                            <label for="gdate">Graduation Date / Last Enrolled Date </label>
                            <input type="text"  class="form-control"value="<?php echo $transaction[0]->gdate ?>" id="gdate" name="gdate" aria-describedby="emailHelp" placeholder="Enter  Year Graduated or Last Enrolled">
                          </div>
                          <div class="form-group col-lg-4">
                            <label for="gdate">Birthdate</label>
                            <input type="date"  class="form-control" value="<?php echo $transaction[0]->bdate ?>" id="bdate" name="bdate" aria-describedby="emailHelp" placeholder="Enter  Year Graduated or Last Enrolled" required>
                          </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td>
                      <div class="row">
                          <div class="form-group col-md-12">
                            <label for="Course" >Course</label>
                            <input type="text" class="form-control" id="Lastname" value="<?php echo $transaction[0]->course ?>"  name="Course" placeholder="Enter Course" required>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="ContactNumber">Status</label>
                              <div class="form-control">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Status" id="Graduate" value="Graduate" <?php  if($transaction[0]->status == 'Graduate'){ echo 'checked';} ?>>
                                    <label class="form-check-label" for="Graduate">Graduate</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Status" id="Undergraduate" value="Undergrad" <?php  if($transaction[0]->status == 'Undergrad'){ echo 'checked';} ?>>
                                    <label class="form-check-label" for="Undergraduate">Undergraduate</label>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="ContactNumber">Type</label>
                              <div class="form-control">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="International" value="International" <?php  if($transaction[0]->type == 'International'){ echo 'checked';} ?>>
                                    <label class="form-check-label" for="International">International</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="Local" value="Local" <?php  if($transaction[0]->type == 'Local'){ echo 'checked';} ?>>
                                    <label class="form-check-label" for="Local">Local</label>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Course" >Verifying Company Name:</label>
                          <input type="text" class="form-control" id="vname" value="<?php echo $transaction[0]->vcompany ?>"  name="vcompany" placeholder="Enter Verifying Company">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="Course" >Document Attachments</label>
                          <input type="text" class="form-control" id="doca" value="<?php echo $transaction[0]->doca ?>" name="doca" placeholder="Document Attachments">
                        </div><div class="form-group col-md-4">
                          <label for="holdreason" >ON-HOLD Reason</label>
                          <input type="text" class="form-control" id="holdreason" value="<?php echo $transaction[0]->holdreason ?>" name="holdreason" placeholder="Hold Reason">
                        </div>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td>
                      <div class="row">
                          <div class="form-group col-md-7">
                            <label for="Email" >Email of the Verification Company</label>
                            <input type="text" class="form-control" value="<?php echo $transaction[0]->cemail ?>" id="Email"  name="Email" aria-describedby="emailHelp" placeholder="Enter Email" maxlength="99" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label  >&nbsp;</label>
                         <input type="submit" value="Edit Student Verification Request" class=" form-control btn btn-warning" />
                        </div>
                      </div>
                  </td>
              </tr>
            </table>
        </div>
    </form>
    </div>



</body>
<footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom  slide-in-right">
  <div class="container text-center">
    <div class="row">
       <div class="col col-sm-5 text-left">
           <small>Copyright &copy;Centro Escolar University     Office of the Registrar 2021</small>
       </div>
       <div class="col text-right">
           <small>Created for: Dr. Rhoda Aguilar, Mrs. Cynthia Sarmiento and Mr. Ivan Mercado.<br /> Developed by CEU Malolos OUR </small>
       </div>
   </div>
  </div>
</footer>
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
</body>
</html>
