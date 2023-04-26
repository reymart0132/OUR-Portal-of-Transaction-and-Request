<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
$view = new view;

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

        <div class="container mt-4 puff-in-center shadow text-center">
            <div class="row p-5 ">
              <div class="jumbotron bg-dark shadow">
                <h1 class="display-4">The Office of the Registrar's Document Request form is currently <b class="ceucolor">unavailable.</b></h1>
                <p class="lead"></p>
                <hr class="my-4">
                <p>The schedule of transactions are as follows:<br> <b class="ceucolor">Monday to Saturday: 8:00 a.m. to 5:00 p.m. (GMT+8) </b></p>
                <p>Thank you and please stay safe!</b></p>

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
