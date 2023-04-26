<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$uid = $user->data()->id;
$viewtables = new viewtables($uid);
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
  <script src="vendor/js/jquery.js"></script>
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
            <a class="dropdown-item active" href="rfpo.php">For Pullout</a>
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
        <div class="container-fluid mt-4 puff-in-center">
          <div class="row">
            <div class="col-md-4 text-center border-bottom pb-3">
              <?php profilePic(); ?>
              <h4><?php echo escape($user->data()->name); ?></h4>
            </div>
            <div class="col-md-4">
              <h5 class="my-3"><i class='fa fa-user-tag'></i> My Pending Transaction: <a href="#"><?php echo countMyPendingTransaction($uid)?> </a></h5>
              <h5 class="mb-3"><i class='fa fa-user-shield'></i> My Pending Verification: <a href="#"><?php echo countMyPendingVerification($uid)?> </a></h5>
              <h5 class="mb-3"><i class='fa fa-user-edit'></i> For Signature: <a href="#"><?php echo countMyForsignature($uid)?> </a></h5>
              <h5 class="mb-3"><i class='fa fa-crosshairs'></i> For Release: <a href="#"><?php echo countMyForRelease($uid)?> </a></h5>
              <h5 class="mb-3"><i class='fa fa-search'></i> For Pullout: <a href="#"><?php echo countFPO($uid)?> </a></h5>
            </div>
            <div class="col-md-4">
              <h3 class="mt-3 ">Available Transactions</h3>
              <h5><a href="transactionpool.php">Transaction Pool: <b style="color:red;"> <?php echo countTP();?></b> </a></h5>
              <h5><a href="verificationpool.php"> Verification Pool:<b style="color:red;"> <?php echo countVP();?></b></a></h5>
            </div>
          </div>
        </div>

        <div class="container-fluid mt-5 puff-in-center">
          <h4 class="text-center">List of Transactions for Record Pullout</h3>
          <?php $viewtables->viewRFPO(); ?>
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
