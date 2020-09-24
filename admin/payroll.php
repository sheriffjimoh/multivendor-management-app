<?php include '../class/login.php'; ?>
<?php login_attempt();

  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border"><form class="form-inline">
                  <div class="form-group">
                    <label>Select View type: </label>
                    <select class="form-control input-sm" id="select_year">
                      <option selected disabled>select----</option>
                     <option value="single">by person</option> 
                     <option value="date">by date</option>
                      </select>
                  </div>
                </form>
              <div class="pull-right">

                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button>
               
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-responsive">
                <thead>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Gross</th>
                  <th>Cash Advance</th>
                  <th>Deductions</th>
                    <th>Net Pay</th>
                    <th>date</th>

                </thead>
                <tbody>
                  <?php
                  $objdb= new DBH;
                  $conn = $objdb->Connect();
                  if (isset($_GET['type'])  &&  $_GET['type']=='date') {
                 
                $sql=$conn->query("SELECT * FROM payroll WHERE  Status='paid' and type='date' ");
               while ($row=$sql->fetch()) {
              $empname = $row['employee_name'];
               $empid =explode(',', $row['employee_id']);
                 $gross = explode(',', $row['gross']);
                 $cashadvance = explode(',', $row['cashadvance']);
                  $deduction = explode(',', $row['deduction']);
                   $netpay =  explode(',',$row['netpay']);
                    $date = $row['date'];
              $exploname = explode(',', $empname);

                ?>
                <tr>
                  <td> <?php 
                  foreach ($exploname  as $name) {
                  echo $name."<br>"; 
                  }?></td>

                    <td> <?php 
                  foreach ($empid  as $id) {
                  echo $id."<br>"; 
                  }?></td>

                  <td> <?php 
                  foreach ($gross  as $gross) {
                  echo $gross."<br>"; 
                  }?></td>
                       
                       <td> <?php 
                  foreach ($cashadvance as $cashadvance) {
                  echo $cashadvance."<br>"; 
                  }?></td>

                  <td> <?php 
                  foreach ($deduction as $deduction) {
                  echo $deduction."<br>"; 
                  }?></td>
                <td> <?php 
                  foreach ($netpay as $netpay) {
                  echo $netpay."<br>"; 
                  }?></td>
                       <td> <?php 
                 echo $row['date'] ;
                  ?></td>
                </tr>
              
               <?php  } }else if(isset($_GET['type'])  &&  $_GET['type']=='single') {
                 
                $sql=$conn->query("SELECT * FROM payroll WHERE  Status='paid' and type='single' ");
               while ($row=$sql->fetch()) {
              $empname = $row['employee_name'];
               $empid = $row['employee_id'];
                 $gross = $row['gross'];
                 $cashadvance =$row['cashadvance'];
                  $deduction =  $row['deduction'];
                   $netpay =$row['netpay'];
                    $date = $row['date'];
              $exploname =$empname;

                ?>
                <tr>
                  <td> <?php echo $empname?></td>

                    <td> <?php echo $empid?></td>
                  <td> <?php echo $gross?></td>
                  <td> <?php echo $cashadvance?></td>
                <td> <?php echo $deduction?></td>
               <td> <?php echo $gross?></td>  
                <td> <?php echo $date?></td>
                </tr>  
                <?php } }else{  ?>
              
  <?php  $sql=$conn->query("SELECT * FROM payroll WHERE  Status='paid' and type='date' ");
               while ($row=$sql->fetch()) {
              $empname = $row['employee_name'];
               $empid =explode(',', $row['employee_id']);
                 $gross = explode(',', $row['gross']);
                 $cashadvance = explode(',', $row['cashadvance']);
                  $deduction = explode(',', $row['deduction']);
                   $netpay =  explode(',',$row['netpay']);
                    $date = $row['date'];
              $exploname = explode(',', $empname);

                ?>
                <tr>
                  <td> <?php 
                  foreach ($exploname  as $name) {
                  echo $name."<br>"; 
                  }?></td>

                    <td> <?php 
                  foreach ($empid  as $id) {
                  echo $id."<br>"; 
                  }?></td>

                  <td> <?php 
                  foreach ($gross  as $gross) {
                  echo $gross."<br>"; 
                  }?></td>
                       
                       <td> <?php 
                  foreach ($cashadvance as $cashadvance) {
                  echo $cashadvance."<br>"; 
                  }?></td>

                  <td> <?php 
                  foreach ($deduction as $deduction) {
                  echo $deduction."<br>"; 
                  }?></td>
                <td> <?php 
                  foreach ($netpay as $netpay) {
                  echo $netpay."<br>"; 
                  }?></td>
                       <td> <?php 
                 echo $row['date'] ;
                  ?></td>
                </tr>

              <?php  } } ?>        
                    </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'payroll.php?type='+$(this).val();
  });
});
</script>
</body>
</html>
