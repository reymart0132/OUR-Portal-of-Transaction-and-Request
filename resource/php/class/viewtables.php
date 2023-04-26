<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/report/resource/php/class/core/init.php';
require_once 'config.php';

class viewtables extends config{

  public $id;
  public $date;

  function __construct($id=null,$date=null) {

      $this->id=$id;
      $this->date=$date;
  }

  public function viewPendingTable(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_transaction` WHERE `status` = 'PENDING' AND `assignee` =$this->id";
      $data= $con->prepare($sql);
      $data->execute();
      $result = $data->fetchAll(PDO::FETCH_ASSOC);

      echo "<h3 class='text-center'> My Pending Transaction</h3>";
      echo "<div class='table-responsive'>";
      echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
      echo "<thead class='thead-dark'>";
      echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
      echo "<th>Fullname</th>";
      echo "<th>Items</th>";
      echo "<th class='d-none d-sm-table-cell'>Course</th>";
      echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
      echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
      echo "<th style='font-size: 85%;'>Date of Request</th>";
      echo "<th>Actions</th>";
      echo "</thead>";
      foreach ($result as $data) {
      echo "<tr>";
      echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
      echo "<td>$data[fullname]</td>";
      echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
      echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
      echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
      echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
      echo "<td style='font-size: 85%;'>".dateconvert($data['dateapp'])."</td>";
      echo "<td>
                <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fullname] - CEU Document Request -  $data[transnumber]&body=Goodmorning!%0D%0A%0D%0AWe have received and acknowledged your request!%0D%0A%0D%0ATotal Break down of your transaction is listed below:%0D%0A %0D%0ATranscript of Records - PHP 826.00 %0D%0ACertificate of Grades - PHP 175.00 %0D%0A  %0D%0APayments can be made through this link %0D%0A https://ptipages.paynamics.net/ceu/default.aspx %0D%0A *please send us the proof of payment to this email address for us to proceed with your documents. %0D%0A %0D%0A Release date is 15 working days after submission of proof of payment for TOR %0D%0A and 5 working days after submission of proof of payment for certificates ( please send it to this email thread for faster transaction) %0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-lg-3 my-1'><i class='fa fa-envelope-open-text'></i></a>
                <a href='viewpendingtransaction.php?tn=$data[transnumber]' class='btn btn-info btn-sm col-lg-3 my-1'><i class='fa fa-eye'></i></a>
                <a href='assigntoteam.php?tn=$data[transnumber]' class='btn btn-primary btn-sm col-lg-3 m1'><i class='fa fa-user-friends'></i></a>
                <a href='edittransaction.php?tn=$data[transnumber]' class='btn btn-warning btn-sm col-lg-3 m1'><i class='fa fa-edit'></i></a>
                <a href='printeddocument.php?tn=$data[transnumber]' class='btn btn-success btn-sm col-lg-3 m1'><i class='fa fa-file-signature'></i></a>
                <a href='removetransaction.php?tn=$data[transnumber]' class='btn btn-danger btn-sm col-lg-3 m1'><i class='fa fa-trash'></i></a>
                </td>";
      echo "</tr>";
      }
      echo "</table>";
      echo "</div>";

    }


    public function viewPoolTable(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_transaction` WHERE `status` = 'FPO' AND `assignee` IS NULL";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='table-responsive'>";
        echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
        echo "<thead class='thead-dark'>";
        echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
        echo "<th>Fullname</th>";
        echo "<th>Items</th>";
        echo "<th class='d-none d-sm-table-cell'>Course</th>";
        echo "<th class='d-none d-sm-table-cell'>Year</th>";
        echo "<th class='d-none d-sm-table-cell'>Status</th>";
        echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
        echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
        echo "<th style='font-size: 85%;'>Date of Request</th>";
        echo "<th>Actions</th>";
        echo "</thead>";
        foreach ($result as $data) {
        echo "<tr>";
        echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
        echo "<td>$data[fullname]</td>";
        echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
        echo "<td class='d-none d-sm-table-cell'>$data[grad_date]</td>";
        echo "<td class='d-none d-sm-table-cell'>$data[uog]</td>";
        echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
        echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
        echo "<td style='font-size: 85%;'>".dateconvert($data['dateapp'])."</td>";
        echo "<td>
                  <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fullname] - CEU Document Request -  $data[transnumber]&body=Goodmorning!%0D%0A%0D%0AWe have received and acknowledged your request!%0D%0A%0D%0ATotal Break down of your transaction is listed below:%0D%0A %0D%0ATranscript of Records - PHP 826.00 %0D%0ACertificate of Grades - PHP 175.00 %0D%0A  %0D%0APayments can be made through this link.%0D%0A https://ptipages.paynamics.net/ceu/default.aspx %0D%0A *please send us the proof of payment to this email address for us to proceed with your documents. %0D%0A %0D%0A Release date is 15 working days after submission of proof of payment for TOR %0D%0A and 5 working days after submission of proof of payment for certificates ( please send it to this email thread for faster transaction) %0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-12'><i class='fa fa-envelope-open-text'></i>Email Template</a>
                  <a href='viewtransaction.php?tn=$data[transnumber]' class='btn btn-info btn-sm my-1 col-12'><i class='fa fa-eye'></i> View Transaction</a>
                  <a href='assigntome.php?tn=$data[transnumber]' class='btn btn-success btn-sm my-1 col-12'><i class='fa fa-user-check'></i> Assign to Me</a>
                  <a href='assigntoteam.php?tn=$data[transnumber]' class='btn btn-warning btn-sm my-1 col-12'><i class='fa fa-user-friends'></i> Assign to Team</a>
                  <a href='removetransaction.php?tn=$data[transnumber]' class='btn btn-danger btn-sm my-1 col-12'><i class='fa fa-trash'></i> Delete Transaction</a>
                  </td>";
        echo "</tr>";
        }
        echo "</table>";
      echo "</div>";
      }


    //verificaiton
    public function viewPool2Table(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_verification` WHERE `remarks` = 'PENDING' AND `assignee` IS NULL";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='table-responsive'>";
        echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
        echo "<thead class='thead-dark'>";
        echo "<th>Fullname</th>";
        echo "<th >Course</th>";
        echo "<th >Verificator Email Address</th>";
        echo "<th >Entrance Date</th>";
        echo "<th >Graduation Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Date Created</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Type</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Status</th>";
        echo "<th>Actions</th>";
        echo "</thead>";
        foreach ($result as $data) {
        echo "<tr>";
        echo "<td>$data[fullname]</td>";
        echo "<td style='font-size: 85%;'>".$data['course']."</td>";
        echo "<td style='font-size: 75%;'>$data[cemail]</td>";
        echo "<td style='font-size: 75%;'>$data[edate]</td>";
        echo "<td style='font-size: 75%;'>$data[gdate]</td>";
        echo "<td class='d-none d-sm-table-cell'  style='font-size: 85%;'>".dateconvert($data['date_recieved'])."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['type']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['status']."</td>";
        echo "<td>
                <a href='assigntomeV.php?tn=$data[id]' class='btn btn-success btn-sm m-1 col-lg-5'><i class='fa fa-user-check'></i> Assign to Me</a>
                <a href='assigntoteamV.php?tn=$data[id]' class='btn btn-warning btn-sm m-1 col-lg-5'><i class='fa fa-user-friends'></i> Assign to Team</a>
                <a href='removetransactionV.php?tn=$data[id]' class='btn btn-danger btn-sm m-1 col-lg-10'><i class='fa fa-trash'></i> Delete Transaction</a>
              </td>";
        echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
    public function viewVerificationTbl(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname(now()) AND year(`date_recieved`) = year(NOW())";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='table-responsive'>";
        echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
        echo "<thead class='thead-dark'>";
        echo "<th>Fullname</th>";
        echo "<th >Course</th>";
        echo "<th >Verification Company</th>";
        echo "<th >Verificator Email Address</th>";
        echo "<th >Document Attachments</th>";
        echo "<th >Type</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Date Created</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Verification Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Entrance Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Graduation Date</th>";
        echo "<th style='font-size: 85%;'>Hold Reason</th>";
        echo "<th style='font-size: 85%;'>Remarks</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Hold-Release Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Hold by</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Verificator</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Cycle Time</th>";
        echo "</thead>";
        foreach ($result as $data) {
        echo "<tr>";
        echo "<td>$data[fullname]</td>";
        echo "<td style='font-size: 85%;'>".$data['course']."</td>";
        echo "<td style='font-size: 75%;'>$data[vcompany]</td>";
        echo "<td style='font-size: 75%;'>$data[cemail]</td>";
        echo "<td style='font-size: 75%;'>$data[doca]</td>";
        echo "<td style='font-size: 75%;'>$data[type]</td>";
        echo "<td class='d-none d-sm-table-cell'  style='font-size: 85%;'>".$data['date_recieved']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['date_verified']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['edate']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['gdate']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['holdreason']."</td>";
        echo "<td style='font-size: 85%;'>".$data['remarks']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['holdreleasedate']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findAssignee($data['holdyby'])."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findAssignee($data['verified_by'])."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcycle($data['date_recieved'],$data['date_verified'])."</td>";
        echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
    public function viewVerificationTbl2(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_verification` WHERE monthname(`date_recieved`) = monthname('".$this->date."-01') AND year(`date_recieved`) = year('".$this->date."-01')";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class='table-responsive'>";
        echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
        echo "<thead class='thead-dark'>";
        echo "<th>Fullname</th>";
        echo "<th >Course</th>";
        echo "<th >Verification Company</th>";
        echo "<th >Verificator Email Address</th>";
        echo "<th >Document Attachments</th>";
        echo "<th >Type</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Date Created</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Verification Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Entrance Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Graduation Date</th>";
        echo "<th style='font-size: 85%;'>Hold Reason</th>";
        echo "<th style='font-size: 85%;'>Remarks</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Hold-Release Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Hold by</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Verificator</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Cycle Time</th>";
        echo "</thead>";
        foreach ($result as $data) {
        echo "<tr>";
        echo "<td>$data[fullname]</td>";
        echo "<td style='font-size: 85%;'>".$data['course']."</td>";
        echo "<td style='font-size: 75%;'>$data[vcompany]</td>";
        echo "<td style='font-size: 75%;'>$data[cemail]</td>";
        echo "<td style='font-size: 75%;'>$data[doca]</td>";
        echo "<td style='font-size: 75%;'>$data[type]</td>";
        echo "<td class='d-none d-sm-table-cell'  style='font-size: 85%;'>".$data['date_recieved']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['date_verified']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['edate']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['gdate']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['holdreason']."</td>";
        echo "<td style='font-size: 85%;'>".$data['remarks']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['holdreleasedate']."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findAssignee($data['holdyby'])."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findAssignee($data['verified_by'])."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcycle($data['date_recieved'],$data['date_verified'])."</td>";
        echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }

   //pending verification
    public function viewPool3Table(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_verification` WHERE `remarks` = 'PENDING' AND `assignee` = $this->id";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3> My Pending  Verification</h3>";
        echo "<div class='table-responsive'>";
        echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
        echo "<thead class='thead-dark'>";
        echo "<a href='pendingverificationpool.php' class='btn btn-info btn-sm active'><i class='fa fa-user' disable></i> View Pending Verifications </a>";
        echo "<a href='onholdV.php' class='btn btn-warning btn-sm'><i class='fa fa-user-shield'></i> View ON-HOLD Verifications </a>";
        echo "<th>Fullname</th>";
        echo "<th >Course</th>";
        echo "<th >Verificator Email Address</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Date Created</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Entrance Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Graduation Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Birth Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Type</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Status</th>";
        echo "<th>Actions</th>";
        echo "</thead>";
        foreach ($result as $data) {
        echo "<tr>";
        echo "<td>$data[fullname]</td>";
        echo "<td style='font-size: 85%;'>".$data['course']."</td>";
        echo "<td style='font-size: 75%;'>$data[cemail]</td>";
        echo "<td class='d-none d-sm-table-cell'  style='font-size: 85%;'>".dateconvert($data['date_recieved'])."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[edate]</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[gdate]</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[bdate]</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[type]</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[status]</td>";
        echo "<td>
                <a href='verified.php?tn=$data[id]' class='btn btn-success btn-sm col-lg-5'><i class='fa fa-user-shield'></i> Candidate Verified</a>
                <a href='editverification.php?tn=$data[id]' class='btn btn-warning btn-sm col-lg-5'><i class='fa fa-edit'></i> Edit Verification</a>
                <a href='vhold.php?id=$data[id]' class='btn btn-warning btn-sm col-lg-5'><i class='fa fa-stop'></i> On-Hold</a>
                <a href='removetransactionV.php?rm=f&tn=$data[id]' class='btn btn-danger btn-sm col-lg-5'><i class='fa fa-user-alt-slash'></i> Reject Verification</a>
              </td>";
        echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
    public function onHoldVTable(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_verification` WHERE `remarks` = 'ON-HOLD' AND `assignee` = $this->id";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3> My ON-HOLD  Verification</h3>";
        echo "<a href='pendingverificationpool.php' class='btn btn-info btn-sm'><i class='fa fa-user' disable></i> View Pending Verifications </a>";
        echo "<a href='onholdV.php' class='btn btn-warning btn-sm active'><i class='fa fa-user-shield'></i> View ON-HOLD Verifications </a>";
        echo "<div class='table-responsive'>";
        echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
        echo "<thead class='thead-dark'>";
        echo "<th>Fullname</th>";
        echo "<th >Course</th>";
        echo "<th >Verificator Email Address</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Date Created</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Entrance Date</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Graduation Date</th>";
        echo "<th style='font-size: 85%; color:red;'>Hold-Reason</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Type</th>";
        echo "<th class='d-none d-sm-table-cell' style='font-size: 85%;'>Status</th>";
        echo "<th>Actions</th>";
        echo "</thead>";
        foreach ($result as $data) {
        echo "<tr>";
        echo "<td>$data[fullname]</td>";
        echo "<td style='font-size: 85%;'>".$data['course']."</td>";
        echo "<td style='font-size: 75%;'>$data[cemail]</td>";
        echo "<td class='d-none d-sm-table-cell'  style='font-size: 85%;'>".dateconvert($data['date_recieved'])."</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[edate]</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[gdate]</td>";
        echo "<td style='font-size: 85%;'>$data[holdreason]</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[type]</td>";
        echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>$data[status]</td>";
        echo "<td>
                <a href='verified.php?id=$data[id]' class='btn btn-success btn-sm col-12'><i class='fa fa-user-shield'></i> Candidate Verified</a>
                <a href='clearhold.php?tn=$data[id]' class='btn btn-primary btn-sm col-12'><i class='fa fa-eraser'></i> Clear Verification</a>
                <a href='editverification.php?tn=$data[id]' class='btn btn-warning btn-sm col-12'><i class='fa fa-edit'></i> Edit Verification</a>
                <a href='removetransactionV.php?rm=f&tn=$data[id]' class='btn btn-danger btn-sm col-12'><i class='fa fa-user-alt-slash'></i> Reject Verification</a>
              </td>";
        echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }

      public function viewPrintedTable(){
          $con = $this->con();
          $sql = "SELECT * FROM `tbl_transaction` WHERE `status` = 'PRINTED' AND `assignee` = $this->id";
          $data= $con->prepare($sql);
          $data->execute();
          $result = $data->fetchAll(PDO::FETCH_ASSOC);
          echo "<div class='table-responsive'>";
          echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
          echo "<thead class='thead-dark'>";
          echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
          echo "<th>Fullname</th>";
          echo "<th>Items</th>";
          echo "<th class='d-none d-sm-table-cell'>Course</th>";
          echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
          echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
          echo "<th style='font-size: 85%;'>Date of Request</th>";
          echo "<th>Actions</th>";
          echo "</thead>";
          foreach ($result as $data) {
          echo "<tr>";
          echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
          echo "<td>$data[fullname]</td>";
          echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
          echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
          echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
          echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
          echo "<td style='font-size: 85%;'>".dateconvert($data['dateapp'])."</td>";
          echo "<td>";
          if(findSdocs($data['drequest'])){
              echo "<a href='signed2.php?tn=$data[transnumber]' class='btn btn-info btn-sm my-1 col-12'><i class='fa fa-pen-fancy'></i> Sign Special Document</a>";
          }else{
              echo "<a href='signed.php?tn=$data[transnumber]' class='btn btn-success btn-sm my-1 col-12'><i class='fa fa-pen-fancy'></i> Sign Document</a>";
          };


          echo "<a href='revision.php?tn=$data[transnumber]' class='btn btn-warning btn-sm my-1 col-12'><i class='fa fa-edit'></i>Revision</a>
                    <a href='removetransaction.php?tn=$data[transnumber]' class='btn btn-danger btn-sm my-1 col-12'><i class='fa fa-trash'></i> Not Signed</a>
                    </td>";
          echo "</tr>";
          }
          echo "</table>";
          echo "</div>";
        }
      public function viewSFilesTable(){
          $con = $this->con();
          $sql = "SELECT * FROM `tbl_transaction` WHERE `status` = 'MISC' AND `assignee` = $this->id";
          $data= $con->prepare($sql);
          $data->execute();
          $result = $data->fetchAll(PDO::FETCH_ASSOC);
          echo "<div class='table-responsive'>";
          echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
          echo "<thead class='thead-dark'>";
          echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
          echo "<th>Fullname</th>";
          echo "<th>Items</th>";
          echo "<th class='d-none d-sm-table-cell'>Course</th>";
          echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
          echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
          echo "<th style='font-size: 85%;'>Date of Request</th>";
          echo "<th>Actions</th>";
          echo "</thead>";
          foreach ($result as $data) {
          echo "<tr>";
          echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
          echo "<td>$data[fullname]</td>";
          echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
          echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
          echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
          echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
          echo "<td style='font-size: 85%;'>".dateconvert($data['dateapp'])."</td>";
          echo "<td> <a href='signed3.php?tn=$data[transnumber]' class='btn btn-info btn-sm my-1 col-12'><i class='fa fa-get-pocket'></i> Special Document Received</a>
               <a href='removetransaction.php?tn=$data[transnumber]' class='btn btn-danger btn-sm my-1 col-12'><i class='fa fa-trash'></i> Not Signed</a>
                </td>";
          echo "</tr>";
          }
          echo "</table>";
          echo "</div>";
        }

      public function viewRFPO(){
          $con = $this->con();
          $sql = "SELECT * FROM `tbl_transaction` WHERE `status` = 'FPO' AND `assignee` = $this->id";
          $data= $con->prepare($sql);
          $data->execute();
          $result = $data->fetchAll(PDO::FETCH_ASSOC);
          echo "<div class='table-responsive'>";
          echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
          echo "<thead class='thead-dark'>";
          echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
          echo "<th>Fullname</th>";
          echo "<th>Items</th>";
          echo "<th class='d-none d-sm-table-cell'>Course</th>";
          echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
          echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
          echo "<th style='font-size: 85%;'>Date of Request</th>";
          echo "<th>Actions</th>";
          echo "</thead>";
          foreach ($result as $data) {
          echo "<tr>";
          echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
          echo "<td>$data[fullname]</td>";
          echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
          echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
          echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
          echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
          echo "<td style='font-size: 85%;'>".dateconvert($data['dateapp'])."</td>";
          echo "<td class='text-center'>
                    <a href='pullout.php?tn=$data[transnumber]' class='btn btn-success btn-sm my-1 col-lg-12'><i class='fa fa-clipboard-check'></i> Record Found</a>
                    <a href='removetransaction.php?tn=$data[transnumber]' class='btn btn-danger btn-sm my-1 col-lg-12'><i class='fa fa-trash'></i>Remove Transaction</a>
                    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fullname] - CEU Document Request -  $data[transnumber]&body=Goodmorning!%0D%0A%0D%0AWe have received and acknowledged your request!%0D%0A%0D%0ATotal Break down of your transaction is listed below:%0D%0A %0D%0ATranscript of Records - PHP 826.00 %0D%0ACertificate of Grades - PHP 175.00 %0D%0A  %0D%0APayments can be made through this link.%0D%0A https://ptipages.paynamics.net/ceu/default.aspx %0D%0A *please send us the proof of payment to this email address for us to proceed with your documents. %0D%0A %0D%0A Release date is 15 working days after submission of proof of payment for TOR %0D%0A and 5 working days after submission of proof of payment for certificates ( please send it to this email thread for faster transaction) %0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-lg-12'><i class='fa fa-envelope-open-text'></i>Email Template</a>
                    <a href='viewtransaction2.php?tn=$data[transnumber]' class='btn btn-info btn-sm col-lg-12'><i class='fa fa-eye'></i>View transaction</a>
                    <a href='assigntoteam.php?tn=$data[transnumber]' class='btn btn-primary btn-sm col-lg-12'><i class='fa fa-user-friends'></i> Assign to Team</a>
                    <a href='edittransaction.php?tn=$data[transnumber]' class='btn btn-warning btn-sm col-lg-12'><i class='fa fa-edit'></i>Edit Transaction</a>
                    </td>";
          echo "</tr>";
          }
          echo "</table>";
          echo "</div>";
        }

      public function viewSignedTable(){
          $con = $this->con();
          $sql = "SELECT * FROM `tbl_transaction` WHERE `status` = 'FOR RELEASE'";
          $data= $con->prepare($sql);
          $data->execute();
          $result = $data->fetchAll(PDO::FETCH_ASSOC);
          echo "<div class='table-responsive'>";
          echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
          echo "<thead class='thead-dark'>";
          echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
          echo "<th>Fullname</th>";
          echo "<th>Items</th>";
          echo "<th class='d-none d-sm-table-cell'>Course</th>";
          echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
          echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
          echo "<th style='font-size: 85%;'>Date of Request</th>";
          echo "<th>Actions</th>";
          echo "</thead>";
          foreach ($result as $data) {
          echo "<tr>";
          echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
          echo "<td>$data[fullname]</td>";
          echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
          echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
          echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
          echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
          echo "<td style='font-size: 85%;'>".dateconvert($data['dateapp'])."</td>";
          echo "<td>
                    <a href='release.php?tn=$data[transnumber]' class='btn btn-success btn-sm my-1 col-md-5'><i class='fa fa-sign-out-alt'></i> Released</a>
                    <a href='revision.php?tn=$data[transnumber]' class='btn btn-warning btn-sm my-1 col-md-5'><i class='fa fa-user-edit'></i>Client Revision</a>
                    <a href='removetransaction.php?tn=$data[transnumber]' class='btn btn-danger btn-sm my-1 col-md-10'><i class='fa fa-trash'></i> Remove from Records</a>
                    </td>";
          echo "</tr>";
          }
          echo "</table>";
          echo "</div>";
        }

        public function viewTransactionTable(){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname(now()) AND year(`dateapp`) = year(NOW())";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='table-responsive'>";
            echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
            echo "<thead class='thead-dark'>";
            echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
            echo "<th>Fullname</th>";
            echo "<th>Items</th>";
            echo "<th class='d-none d-sm-table-cell'>Course</th>";
            echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
            echo "<th class='d-none d-sm-table-cell'>Status</th>";
            echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
            echo "<th class='d-none d-sm-table-cell'>Assignee</th>";
            echo "<th style='font-size: 85%;'>Date of Request</th>";
            echo "<th style='font-size: 85%;'>Date of Payment</th>";
            echo "<th style='font-size: 85%;'>Date Signed</th>";
            echo "<th style='font-size: 85%;'>Date Released</th>";
            echo "<th style='font-size: 85%;'>Transaction Cycle Time</th>";
            echo "<th>Actions</th>";
            echo "</thead>";
            foreach ($result as $data) {
            echo "<tr>";
            echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
            echo "<td>$data[fullname]</td>";
            echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
            echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
            echo "<td class='d-none d-sm-table-cell'>$data[status]</td>";
            echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>".findAssignee($data['assignee'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['dateapp'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['pulloutdate'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['readydate'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['releasedate'])."</td>";
            echo "<td style='font-size: 85%;'>".findcycle($data['pulloutdate'],$data['readydate'])."</td>";
            echo "<td>
                      <a href='viewtransaction2.php?tn=$data[transnumber]' class='btn btn-info btn-sm my-1 col-12'><i class='fa fa-eye'></i> View Transaction</a>
                      </td>";
            echo "</tr>";
            }
            echo "</div>";
          }
        public function viewTransactionTable2(){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_transaction` WHERE monthname(`dateapp`) = monthname('".$this->date."-01') AND year(`dateapp`) = year('".$this->date."-01')";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='table-responsive'>";
            echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
            echo "<thead class='thead-dark'>";
            echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
            echo "<th>Fullname</th>";
            echo "<th>Items</th>";
            echo "<th class='d-none d-sm-table-cell'>Course</th>";
            echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
            echo "<th class='d-none d-sm-table-cell'>Status</th>";
            echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
            echo "<th class='d-none d-sm-table-cell'>Assignee</th>";
            echo "<th style='font-size: 85%;'>Date of Request</th>";
            echo "<th style='font-size: 85%;'>Date of Payment</th>";
            echo "<th style='font-size: 85%;'>Date Signed</th>";
            echo "<th style='font-size: 85%;'>Date Released</th>";
            echo "<th style='font-size: 85%;'>Transaction Cycle Time</th>";
            echo "<th>Actions</th>";
            echo "</thead>";
            foreach ($result as $data) {
            echo "<tr>";
            echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
            echo "<td>$data[fullname]</td>";
            echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
            echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
            echo "<td class='d-none d-sm-table-cell'>$data[status]</td>";
            echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>".findAssignee($data['assignee'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['dateapp'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['pulloutdate'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['readydate'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['releasedate'])."</td>";
            echo "<td style='font-size: 85%;'>".findcycle($data['pulloutdate'],$data['readydate'])."</td>";
            echo "<td>
                      <a href='viewtransaction2.php?tn=$data[transnumber]' class='btn btn-info btn-sm my-1 col-12'><i class='fa fa-eye'></i> View Transaction</a>
                      </td>";
            echo "</tr>";
            }
            echo "</div>";
          }
        public function viewReleaseTable(){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_transaction` WHERE `status` = 'RELEASED'";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='table-responsive'>";
            echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
            echo "<thead class='thead-dark'>";
            echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
            echo "<th>Fullname</th>";
            echo "<th>Items</th>";
            echo "<th class='d-none d-sm-table-cell'>Course</th>";
            echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
            echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
            echo "<th style='font-size: 85%;'>Date Released</th>";
            echo "<th style='font-size: 85%;'>Released by</th>";
            echo "<th style='font-size: 85%;'>Release Notes</th>";
            echo "<th style='font-size: 85%;'>Transaction Cycle Time</th>";
            echo "<th>Actions</th>";
            echo "</thead>";
            foreach ($result as $data) {
            echo "<tr>";
            echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
            echo "<td>$data[fullname]</td>";
            echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
            echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
            echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['releasedate'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>".findAssignee($data['releaseby'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>".$data['releasenotes']."</td>";
            echo "<td style='font-size: 85%;'>".findcycle($data['dateapp'],$data['readydate'])."</td>";
            echo "<td>
                      <a href='viewtransaction2.php?tn=$data[transnumber]' class='btn btn-info btn-sm my-1 col-12'><i class='fa fa-eye'></i> View Transaction</a>
                      </td>";
            echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
          }
        public function viewRemoveTable(){
            $con = $this->con();
            $sql = "SELECT * FROM `tbl_transaction` WHERE `flagdesc` !=''";
            $data= $con->prepare($sql);
            $data->execute();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            echo "<div class='table-responsive'>";
            echo "<table id='scholartable' class='table table-hover shadow display' width='100%'>";
            echo "<thead class='thead-dark'>";
            echo "<th class='d-none d-sm-table-cell'>Transaction Number</th>";
            echo "<th>Fullname</th>";
            echo "<th>Items</th>";
            echo "<th style='font-size: 85%;'>R. Reason</th>";
            echo "<th class='d-none d-sm-table-cell'>Course</th>";
            echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
            echo "<th class='d-none d-sm-table-cell'>Purpose</th>";
            echo "<th style='font-size: 85%;'>Date of Request</th>";
            echo "<th class='d-none d-sm-table-cell'>Status</th>";

            echo "<th>Actions</th>";
            echo "</thead>";
            foreach ($result as $data) {
            echo "<tr>";
            echo "<td class='d-none d-sm-table-cell' >$data[transnumber]</td>";
            echo "<td>$data[fullname]</td>";
            echo "<td style='font-size: 85%;'><em>".finditems($data['drequest'])."</em></td>";
            echo "<td>$data[flagdesc]</td>";
            echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".findcourse($data['course'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
            echo "<td class='d-none d-sm-table-cell'>".findPurpose($data['purpose'])."</td>";
            echo "<td style='font-size: 85%;'>".cd($data['dateapp'])."</td>";
            echo "<td class='d-none d-sm-table-cell'>$data[status]</td>";

            echo "<td>
                      <a href='viewtransaction2.php?tn=$data[transnumber]' class='btn btn-info btn-sm my-1 col-12'><i class='fa fa-eye'></i> View Transaction</a>
                      </td>";
            echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
          }


}
 ?>
