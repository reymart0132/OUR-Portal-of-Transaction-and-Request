<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
isLogin();
$user = new user();
$uid = $user->data()->id;

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
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-3 slide-in-left" style="z-index:10; ">
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
            <a class="dropdown-item active" href="dashboardOUR.php">OUR Dashboard</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuAccounts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Accounts Menu
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuAccounts">
            <a class="dropdown-item " href="output.php">OFT</a>
            <a class="dropdown-item border" href="updateprofile.php">Update Profile</a>
            <a class="dropdown-item border" href="updateprofile.php">Change Password</a>
            <a class="dropdown-item" href="Logout.php">Logout</a>
          </div>
        </li>

      </ul>
    </div>
</nav>

        <div class="container-fluid  slide-in-left shadow-sm p-3 p-4">
          <div class="row">
            <div class="col-lg-6 shadow-sm p-4 tg uh">
              <div class="ah">
                <h5 class="text-center">Number of Task Completed Today</h5>
                <canvas id="chart1"></canvas>
              </div>
            </div>
            <div class="col-lg-4 shadow-sm p-3 tg">
               Transaction Received and Transaction Completed
              <canvas id="chart3"></canvas>
            </div>
            <div class="col-lg-2 shadow-sm p-3 tg">
              <h6>List of Transaction Received Today</h6>
              <?php findReceivedTransactionToday();?>
            </div>
          </div>

           <div class="row">
               <div class="col-lg-4 shadow-sm p-1 tg uh">
              <div class="yh">
                <h5 class="text-center">Number of Task Printed Today</h5>
                <canvas id="chart2"></canvas>
              </div>
            </div>

            <div class="col-lg-4 shadow-sm p-3 tg">
              Verification Received and Verified Today
              <canvas id="chart4"></canvas>
            </div>
            <div class="col-lg-4 shadow-sm p-3 tg">
              <form action="dashboardSettings.php" method="POST" class="">
                <h6><i class='fa fa-lock mr-2'></i>Transaction Form Lock Settings</h6>
                <p class="text-info">Current Status: <?php  checklock(getTransLock());?></p>
                <small>Warning the value of this select box will change the locking mechanism of the document transaction form. Please use with caution. Thank you!</small><br>
                <select id="lock" name="lock" class="form-control form-control-sm">
                  <?php
                  if(getTransLock() == 1){
                    echo '<option value="0">Unlock</option>
                          <option value="1" selected ="selected">Locked</option>';
                  }else{
                    echo '<option value="0" selected ="selected">Unlock</option>
                          <option value="1">Locked</option>';
                  }
                  ?>
                </select><br>
                  <input type="submit" value="Change Lock Settings" class=" form-control btn btn-primary" />
                  <p class="text-info">Last Resource who updated the settings:<b> <?php getLocker(); ?></b></p>
              </form>
            </div>


          </div>

        </div>
</body>
    <script src="vendor/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const data = {
      labels: [
        <?php echo findTeam();?>
      ],
      datasets: [{
        label: 'Number of Completed Documents',
        data: [<?php echo findTeamPrintedData();?>],
        backgroundColor: ['#f95d6a', '#ff7c43', '#89fc60','#665191', '#ffa600', '#2f4b7c', '#003f5c', '#a05195', '#d45087',
		   '#ff0080', '#FDFFB6', '#CAFFBF', '#9BF6FF',
      '#A0C4FF', '#BDB2FF', '#E6B3B3', '#6680B3', '#66991A',
		  '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
		  '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC',
		  '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
		  '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680',
		  '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
		  '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3',
		  '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'],
        hoverOffset: 4,
        borderColor:'rgba(167, 167, 167, 0.44)',
        spacing: 2,

      }]
    };
      const config = {
        type: 'pie',
        data: data,
        options: {
        responsive: true,
        maintainAspectRatio: false
    }
      };


    const data2 = {
      labels: [
        <?php echo findTeam();?>
      ],
      datasets: [{
        label: 'Number of Printed Documents',
        data: [<?php echo findTeamPrintedData2();?>],
        backgroundColor: ['#f95d6a', '#ff7c43', '#89fc60','#665191','#ffa600', '#2f4b7c', '#003f5c', '#a05195', '#d45087',
		   '#ff0080', '#FDFFB6', '#CAFFBF', '#9BF6FF',
      '#A0C4FF', '#BDB2FF', '#E6B3B3', '#6680B3', '#66991A',
		  '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
		  '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC',
		  '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
		  '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680',
		  '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
		  '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3',
		  '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'],
        hoverOffset: 4,
        borderColor:'#1C1C1C1',
        spacing: 2,

      }]
    };
      const config2 = {
        type: 'bar',
        data: data2,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          indexAxis: 'y',
          plugins: { legend: { display: false }}
        }
      };


    const data3 = {
      labels: ['# Task Received','# Task Completed' ],
      datasets: [{
        label: 'Task Received vs Task Completed',
        data: [<?php echo countReceivedToday();?>,<?php echo countPrintedToday()?>],
        backgroundColor: ['rgb(249, 93, 106,0.2)', 'rgb(104, 105, 250,0.2)'],
        borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)'
        ],
        borderWidth:2,
      }]
    };
      const config3 = {
        type: 'bar',
        data: data3,
        options: {
          indexAxis: 'y',
          plugins: { legend: { display: false }}
        }
      };

    const data4 = {
      labels: ['# Verification Received','# Verification Completed' ],
      datasets: [{
        label: 'Verification Received vs Verification Completed',
        data: [<?php echo countVerificationToday();?>,<?php echo countVerificationCompletedToday()?>],
        backgroundColor: ['rgba(250, 188, 51,0.2)', 'rgba(142, 250, 104,0.2)'],
        borderColor: [
            'rgba(250, 188, 51)', 'rgba(142, 250, 104)'
        ],
        borderWidth:2,
      }]
    };
      const config4 = {
        type: 'bar',
        data: data4,
        options: {
          indexAxis: 'y',
          plugins: { legend: { display: false }}
        }
      };
    </script>

    <script>
      const myChart = new Chart(
        document.getElementById('chart1'),
        config
      );

      const myChart2 = new Chart(
        document.getElementById('chart2'),
        config2
      );
      const myChart3 = new Chart(
        document.getElementById('chart3'),
        config3
      );
      const myChart4 = new Chart(
        document.getElementById('chart4'),
        config4
      );
    </script>
</body>
</html>
