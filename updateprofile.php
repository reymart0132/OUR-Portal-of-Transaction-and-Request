<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$view = new view;
$user = new user();
updateProfile();
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
   <link rel="stylesheet" type="text/css"  href="resource/css/speech.css">
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
             <a class="dropdown-item border active" href="updateprofile.php">Update Profile</a>
             <a class="dropdown-item border" href="changepassword.php">Change Password</a>
             <a class="dropdown-item" href="Logout.php">Logout</a>
           </div>
         </li>

       </ul>
     </div>
 </nav>

         <div class="container mt-5  pt-5 puff-in-center">
             <div class="row">
                 <div class="col-12">
                     <h1 class="text-center">Update your Information</h1>
                 </div>
            </div>
            <form action="" method="post">
                <table class="table ">
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                 <label for = "username" class=""> Username:</label>
                                 <input class="form-control"  type = "text" name="username" id="username" value ="<?php echo escape($user->data()->username); ?>" autocomplete="off"  />
                                </div>
                                <div class="form-group col-4">
                                 <label for = "fullName" class=""> Full Name</label>
                                 <input class="form-control"  type = "text" name="fullName" id="fullName" value ="<?php echo escape($user->data()->name); ?>"/required>
                                </div>
                                <div class="form-group col-4">
                                 <label for = "email" class=""> Email Address</label>
                                 <input class="form-control"  type = "text" name="email" id="email" value ="<?php echo escape($user->data()->email); ?>"/required>
                                </div>
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <div class="form-group col-5">
                                  <label for="College" >College/s to handle</label>
                                      <select id="College" name="College[]" class="selectpicker form-control" data-live-search="true" multiple required>
                                        <?php $view->collegeSP2();?>
                                      </select>
                                </div>
                                <div class="form-group col-5">
                                    <label  >&nbsp;</label>
                                <input type="hidden" name ="Token" value="<?php echo Token::generate();?>" />
                                 <input type="submit" value="Update your profile" class=" form-control btn btn-primary" />
                                </div>
                             </div>
                        </td>
                    </tr>
                </table>
             </form>
             <form action="updatepropic.php" method="post" enctype="multipart/form-data">
                 <table class="table">
                     <tr>
                         <td>
                             <div class="row justify-content-center">
                                 <div class="form-group col-4 text-right">
                                        <?php profilePic(); ?>
                                 </div>
                                 <div class="form-group col-6">
                                     <label for="myfile">Upload your Picture</label>
                                         <input id="myfile" type="file" name="myfile" class="form-control-file" />
                                         <input type="submit" name="pic" value="Update your Picture" class=" mt-4  form-control btn btn-success" accept=".jpg" />
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
     <script>
     var MAX_FILE_SIZE = 1 * 1024 * 1024;
        $(document).ready(function() {
           $('#myfile').change(function() {
               fileSize = this.files[0].size;
               if (fileSize > MAX_FILE_SIZE) {
                   this.setCustomValidity("File must not exceed 1 MB!");
                   this.reportValidity();
               } else {
                   this.setCustomValidity("");
               }
           });
        });
     </script>
 </body>
 </html>
