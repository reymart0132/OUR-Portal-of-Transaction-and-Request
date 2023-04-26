<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$view = new view;
$user = new user();
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
             <a class="dropdown-item border " href="updateprofile.php">Update Profile</a>
             <a class="dropdown-item border active" href="changepassword.php">Change Password</a>
             <a class="dropdown-item" href="Logout.php">Logout</a>
           </div>
         </li>

       </ul>
     </div>
 </nav>

         <div class="container mt-5  pt-5 puff-in-center">
             <div class="row">
                 <div class="col-12">
                   <?php changeP(); ?>
                     <h1 class="text-center">Change Password</h1>
                 </div>
            </div>
            <form action="" method="post">
                <table class="table ">
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                 <label for = "password_current"> Enter Current Password:</label>
                                 <input type="password" class="form-control" name="password_current" id="password" value ="" autocomplete="off"required/>
                                </div>
                                <div class="form-group col-4">
                                 <label for = "password"> Enter New Password:</label>
                                 <input type="password" class="form-control" name="password" id="password" value ="" autocomplete="off"required/>
                                </div>
                                <div class="form-group col-4">
                                 <label for = "ConfirmPassword"> Confirm New Password:</label>
                                 <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" value ="" autocomplete="off"required/>
                                </div>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-7">
                                    <label  >&nbsp;</label>
                                <input type="hidden" name ="Token" value="<?php echo Token::generate();?>" />
                                 <input type="submit" value="Change password" class=" form-control btn btn-primary" />
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
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
 </body>
 </html>
