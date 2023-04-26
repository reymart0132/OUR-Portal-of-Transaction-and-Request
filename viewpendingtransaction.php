<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$uid = $user->data()->id;
if(empty($_GET['tn'])){
  Redirect::to('dashboard.php');
}else{
  $transaction =getTransactionDetails($_GET['tn']);

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
  <script src="vendor/js/jquery.js"></script>
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
            <a class="dropdown-item border" href="changepassword.php">Change Password</a>
            <a class="dropdown-item" href="Logout.php">Logout</a>
          </div>
        </li>

      </ul>
    </div>
</nav>

        <div class="container mt-5 puff-in-center">
          <div class="row justify-content-left">
            <div class="col-12 text-center mb-4">
              <h4><b style="color:#ff8ba0;"><?php echo $_GET['tn'] ?></b> Transaction Details</h4>
            </div>
            <div class="col-md-4 mb-4">
              <h6>Fullname: <b style="color:#ff8ba0;"><?php echo $transaction[0]->fullname;?></b></h6>
            </div>
            <div class="col-md-4 mb-4">
              <h6>Student Number: <b style="color:#ff8ba0;"><?php echo $transaction[0]->student_number;?></b></h6>
            </div>
            <div class="col-md-4 mb-3">
              <h6>Course: <b style="color:#ff8ba0;"><?php echo findCourse($transaction[0]->course);?></b></h6>
            </div>
            <div class="col-md-4 mb-3">
              <h6>Email: <b style="color:#ff8ba0;"><?php echo $transaction[0]->email;?></b></h6>
            </div>
            <div class="col-md-4 mb-3">
              <h6>Date Applied: <b style="color:#ff8ba0;"><?php echo $transaction[0]->dateapp;?></b></h6>
            </div>
            <div class="col-md-4 mb-3">
              <h6>Year Last Enrolled / Graduated: <b style="color:#ff8ba0;"><?php echo $transaction[0]->grad_date;?></b></h6>
            </div>
            <div class="col-md-4 mb-3">
              <h6>Phone Number: <b style="color:#ff8ba0;"><?php echo $transaction[0]->contact;?></b></h6>
            </div>
            <div class="col-md-4 mb-3">
              <h6>Status: <b style="color:#ff8ba0;"><?php echo $transaction[0]->uog;?></b></h6>
            </div>
            <div class="col-md-4 mb-3">
              <h6>Purpose: <b style="color:#ff8ba0;"><?php echo findPurpose($transaction[0]->purpose);?></b></h6>
            </div>
          </div>
          <div class="row justify-content-left">
            <div class="col-md-12 mb-3">
              <h6>Documents Requested: <b style="color:#ff8ba0;"><?php echo finditems2($transaction[0]->drequest);?></b></h6>
            </div>
            <div class="col-md-12 mb-3">
              <h6><b style="color:#ff8ba0;">Additional Instructions:</b></h6>
              <textarea class="my-4"style="width:100%;" rows="10" name="" value="" disabled><?php echo $transaction[0]->instruction;?></textarea>
            </div>

            </div>
          </div>
          <div class="row justify-content-center">
            <a href='https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $transaction[0]->email; ?>&su=CEU Document Request <?php echo $_GET['tn']; ?>&body=Goodmorning!%0D%0A%0D%0AWe have received and acknowledged your request!%0D%0A%0D%0ATotal Break down of your transaction is listed below:%0D%0A %0D%0ATranscript of Records - PHP 826.00 %0D%0ACertificate of Grades - PHP 175.00 %0D%0A  %0D%0APayments may be made on site or via this link%0D%0A https://ptipages.paynamics.net/ceu/default.aspx %0D%0A *please send us the proof of payment to this email address for us to proceed with your documents. %0D%0A %0D%0A Release date is 15 working days after submission of proof of payment for TOR %0D%0A and 5 working days after submission of proof of payment for certificates ( please send it to this email thread for faster transaction) %0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm mr-3 mb-3 col-md-2'><i class='fa fa-envelope-open-text'> Send an Email</i></a>
            <a href="printeddocument.php?tn=<?php echo $_GET['tn'];?>"class='btn btn-success btn-sm mr-3 mb-3 col-md-3'><i class='fa fa-file-signature'></i> Documents Printed</a>
            <a href='assigntoteam.php?tn=<?php echo $_GET['tn'];?>' class='btn btn-primary btn-sm mr-3 mb-3 col-md-3'><i class='fa fa-user-friends'></i> Assign to Team</a>
            <a href='edittransaction.php?tn=<?php echo $_GET['tn'];?>' class='btn btn-warning btn-sm mr-3 mb-3 col-md-3'><i class='fa fa-user-edit'></i> Edit Transaction</a>
            <a href='removetransaction.php?tn=<?php echo $_GET['tn'];?>' class='btn btn-danger btn-sm mr-3 mb-3 col-md-3'><i class='fa fa-trash'></i> Delete Transaction</a>
            <a href='gmcmail.php?tn=<?php echo $_GET['tn'];?>' class='btn btn-info btn-sm mr-3 mb-3 col-md-3' <?php findGMC($transaction[0]->drequest); ?>><i class='fa fa-envelope'></i> Create GMC Email Request</a>
          </div><br />
        </div>
</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/bootstrap-select.min.js"></script>
    <script>
    $(document).ready(function(){
      window.$('#scholartable').DataTable();
    });
    </script>
</body>
</html>
