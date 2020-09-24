<?php include '../login.php'; ?>
 <?php include 'includes/header.php'; ?> 
 <?php login_attempt();?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

     <?php include 'includes/navbar.php'; ?> 
      <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background: #fff; padding: 10px;">
      <h1>
      <strong>Distributor | my account </strong> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content --> 
    <section class="content">
      <div class="card">
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
   <?php
                  
       $time=time();
              $from = date("Y-m-d",strtotime('-5', $time));
                $date = date("Y-m-d", $time);
                $day = date('d' ,$time);
              $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM employees where DAY(birthdate)='$day' and employee_id='$userid' ";
                $query = $conn->query($sql);
               $num = $query->rowCount();
               if ($num > 0) {?>
                <div class='alert alert-info alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4 style="font-weight: lighter;"><i class='icon fa fa-bull-horn'></i>Dear  <strong><?php echo $empname ?></strong>&nbsp;we wish you  a very happy birthday to day and forever, from <strong>Danjuma bakery</strong>
               .</h4></div>
              <?php }?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM production where Status='off'";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>unclear production</p>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="newprod.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where Status='off'";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>unclear order</p>
            </div>
            <div class="icon">
              <i class="fa fa-cog"></i>
            </div>
            <a href="unclearo.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where Status='on' and payment='off'";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>unclear payment</p>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="unclearp.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM product";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>Product</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="product.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

       




      </div>
      
      </section>
      <!-- right col -->
    </div>
    <?php include 'includes/footer.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
<!-- ./wrapper -->
</script>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script>
</body>
</html>
