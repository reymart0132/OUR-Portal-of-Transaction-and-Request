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

$purpose = $transaction[0]->purpose;
$tn = $_GET['tn'];
$requests = explode(",",$transaction[0]->drequest);

if(!empty($_POST)){
    foreach($_POST as $inventory => $quantity) {
     $ai = new addinventory($inventory,$tn,$quantity,$purpose,$transaction[0]->assignee);
     $ai->insertinventory();
     $ai->printedDocument();
    }
    $itemlist = finditems2($transaction[0]->drequest);
    printedDocumentStatus($transaction[0]->fullname,$itemlist,$transaction[0]->assignee);
    Redirect::to('dashboard.php');
}
?><!DOCTYPE html>
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
            <a class="dropdown-item active" href="dashboard.php">Pending Transaction <span class="sr-only">(current)</span></a>
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

        <div class="container mt-5 puff-in-center shadow-sm p-4 border">
          <div class="row justify-content-left">
            <h5 class="text-center mb-4">Please enter the quantity of the printed documents</h5>
          </div>
            <form class="" action="" method="POST"><?php
                        foreach ($requests as $request) {
                          echo '<div class="form-group col-12">';
                          echo '<label for="$request">'.strtoupper(findReq($request)).'</label>';
                          echo '<input type="number" class="form-control" id="'.$request.'"  value="" name="'.$request.'" placeholder="Enter Quantity" max="20" required>
                            </div>';
                        }
                        ?><div class="form-group col-12">
                   <input type="submit" value="Submit" class=" form-control btn btn-primary" />
                  </div>
              </form>
        </div>
</body>
<!-- <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom  slide-in-right">
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
</footer> -->
    <script src="vendor/js/jquery.js"></script>
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
