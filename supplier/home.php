<?php include '../login.php'; ?>
<?php login_attempt();?>

 <?php include 'includes/header.php'; ?> 
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

     <?php include 'includes/navbar.php'; ?> 
      <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background: #fff; padding: 10px;">
      <h1>
       Supplier | My Acount
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
     
             <?php 
                  
       $time=time();
              $from = date("Y-m-d",strtotime('-5', $time));
                $date = date("Y-m-d", $time);
                $day = date("d", $time);
              $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where DAY(Date)='$day' and Supplier='$userid' ";
                $query = $conn->query($sql);
               $num = $query->rowCount();
               if ($num == 0) {?>
                <div class='alert alert-report alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-spinner'></i>
                Hi  <?php echo $empname ?>,we checked on you , you have not book  any offer today,
                <strong>Danjuma Bakery</strong> as made   your booking system and payment more easier, you can easily get to us for any report, nice regards!.</h4></div>
              <?php }?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where Status='off' and Payment='off'  and Supplier='$userid' and Date='$date'";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>uncleared Offer</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="outgoing.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                            $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where Status='on' and Payment='off'  and Supplier='$userid' ";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>unpaid Offer</p>            
                          </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="supply.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      

   <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
               $from = date("Y-m-d",strtotime('-5 day', $time));
                $date = date("Y-m-d", $time);
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where Status='on' and Payment='off'  and Supplier='$userid' and Date='$from'";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>Overdue payment Offer</p>            
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="overdue.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <?php
               $from = date("Y-m-d",strtotime('-5 day', $time));
                $date = date("Y-m-d", $time);
               $obj = new DBH;
                $conn= $obj->Connect();
                $balance =0;
                $sql = "SELECT * FROM supply where Status='on' and Payment='on'  and Supplier='$userid'";
                $query = $conn->query($sql);
                 while ($row =$query->fetch()) {
                 $balance +=$row['Balance'];
                 }
                echo "<h3>".number_format($balance,2)."</h3>";
              ?>

              <p>Balance to pay</p>            
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="balance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->





      </div>
      
      </section>
      <!-- right col -->
    </div>
 <?php include 'includes/supply_modal.php'; ?>
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
