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
            <a href="status" class="nav-item nav-link navitem ml-4">Check Document Status</a>
            <a href="status" class="nav-item nav-link navitem ml-4 active">Site Login</a>
          </div>
        </div>
      </nav>
    </div>
  </div>
     <div class="container-fluid ">
      <div class="row justify-content-center mt-lg-5">
          <div class="col-lg-5  mt-lg-5">
            <div class="jumbotron jumbotron-fluid p-4 header-text text-center  ">
              <div class="container slide-in-left">
                <h1 class="headermain3 mt-lg-5">WELCOME <br /><b class="ceupink"> BACK.</b></h1>
              </div>
            </div>
          </div>

          <div class="col-lg-5  mt-lg-5">
              <form class="text-center p-5 shadow slide-in-left bgc" action="" method="post" >
                <h1 class="headermain2 mb-4">Office of the University<b class="ceupink"> Registrar Portal</b></h1>
              <p class="headermain2">Sign in</p>
              <?php logd();?>
              <input type="text" id="username" class="form-control my-4" name="username" placeholder="Enter Username" style="font-size:80%;color:white;background-color: rgba(255, 255, 255, 0);" required>
              <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Enter Password" style="font-size:80%;color:white;background-color: rgba(255, 255, 255, 0);" name ="password" required>
              <div class="d-flex justify-content-around">
              </div>
              <input type =hidden name="token" value="<?php echo Token::generate(); ?>">
              <input  type="submit"  class="btn btn-dark btn-block my-4"value="Login"/>
              <button class="btn-info">Proceed to Special Order Site</button>
              </form>
            </div>
          </div>
      </div>
    </header>
        <script src="vendor/js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="vendor/js/bootstrap.min.js"></script>
    </body>
    </html>
