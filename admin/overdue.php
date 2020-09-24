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
      Overdue paylist
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Overdue</li>
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
             <div class="box-header with-border"><h3>Overdue Salary</h3>             
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
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
                  $time = time();
                  $from = date("Y-m-d",strtotime('-5 day', $time));
                $date = date("Y-m-d", $time);
               $obj = new DBH;
                $conn= $obj->Connect();      
                $sql=$conn->query("SELECT * FROM payroll WHERE  Status='unpaid' and date BETWEEN $date and $from ");
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
              <?php }?>
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
    window.location.href = 'Overdue.php?type='+$(this).val();
  });
});

</script>
</body>
</html>
