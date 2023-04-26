<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();

?>

<html>
<head>
  <style>
  *{
  padding:0;
  margin: 0;
  }
  .centered {
  position: fixed; /* or absolute */
  top: 50%;
  left: 50%;
  }
  .lds-ring {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }
  .lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 64px;
    height: 64px;
    margin: 8px;
    border: 8px solid #ff8edc;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #ff8edc transparent transparent transparent;
  }
  .lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
  }
  .lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
  }
  .lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
  }
  @keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
  }

  </style>
</head>
<body>
<div style="background-color: rgb(33, 33, 33); z-index: 10; width:auto;height:100vh;">
  <div class="lds-ring centered"><div></div><div></div><div></div><div></div></div>
</div>
 <a id="click" href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo findSecretaryEmail($_GET['team']); ?>;<?php echo$_GET['email']; ?>&su=CEU GMC Request - [<?php echo $_GET['fullname']; ?>]&body=Goodmorning!%0D%0A%0D%0AEndorsing to your school/department the request for a Good Moral Certificate of Mr/Ms. <?php echo $_GET['fullname']?>.%0D%0AThank you very much for your kind assistance!%0D%0A%0D%0A --------------- %0D%0A Dear Student,%0D%0A For follow-ups regarding your Good Moral Certificate kindly reply to this thread. Thank you and stay safe!"> Send an Email</a>
</body>
</html>

<script>
    window.onload = function(){
      document.getElementById('click').click();
    }
</script>
