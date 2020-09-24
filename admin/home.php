<?php include '../login.php'; ?>
<?php login_attempt();?>
<?php 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
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
        Dashboard
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
                $date = date("d", $time);
              $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM employees where DAY(Start)='$date'";
                $query = $conn->query($sql);
               if ($query->rowCount() > 0) {
                 
      ?>
        <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-spinner'></i>Hi admin , you have <?php echo $query->rowCount();  ?> Salary to pay off today !</h4>
             
            </div>
             <?php 
                 }  
       $time=time();
              $from = date("Y-m-d",strtotime('-5', $time));
                $date = date("Y-m-d", $time);
              $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM production where Datetimes='$date'";
                $query = $conn->query($sql);
               $num = $query->rowCount();
               if ($num == 0) {?>
                <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-spinner'></i>Hi admin , check on producer department , no production received today!</h4>
             
            </div>
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
                $sql = "SELECT * FROM employees";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>Total Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                $sql = "SELECT * FROM store" ;
                $query = $conn->query($sql);
                 $remian=0;
               while ($row = $query->fetch()) {
                if ($row['Remain'] !='off') {
                  $remian +=$row['Remain'];
                }
               }
                echo "<h3>".$remian."</h3>";
              ?>
            <p>store item</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="store.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
             <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where Status='off' and Payment='off'";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>
              <p>unclear supply trip</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="unclearlist.php?unclear" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
             <!-- <!-.col  -> -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <span class="label label-default">salary</span>
                <?php
                 $time = time();
                  $from = date("Y-m-d",strtotime('-5 day', $time));
                $date = date("Y-m-d", $time);
               $obj = new DBH;
                $conn= $obj->Connect();      
                $sql = "SELECT * FROM payroll WHERE  Status='unpaid' and date BETWEEN $date and $from";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>
              <p>overdue payment</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="overdue.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <span class="label label-default">salary</span>
              <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $time = time();
                $date = date("d", $time);
                $sql = "SELECT * FROM employees  where   DAY(Start)='$date'";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>

              <p>Today Pay</p>
            </div>
            <div class="icon">
              <i class="fa fa-dashboard"></i>
            </div>
            <a href="pay.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
               <span class="label label-default">Product</span>
             <?php
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM production  " ;
                $query = $conn->query($sql);
                 $remian=0;
               while ($row = $query->fetch()) {
               
                  $remian +=$row['Remain'];
                }
               
                echo "<h3>".$remian."</h3>";
              ?>
            <p>Product available</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="salessheet.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <span class="label label-default">income</span>

             <?php
            
               $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where Status='on' and Payment='off' ";
                $query = $conn->query($sql);

                echo "<h3>".$query->rowCount()."</h3>";
              ?>
              <p>Today pay</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="unclearlist.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
             <!-- <!-.col  -> -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-brown">
            <div class="inner">
              <span class="label label-default">supply</span>
                <?php
                 $time=time();
              $from = date("Y-m-d",strtotime('-5', $time));
                $to = date("Y-m-d", $time);

               $obj = new DBh;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM supply where   Payment='off' and Date  Between $from and $to ";
                $query = $conn->query($sql);


                echo "<h3>".$query->rowCount()." </h3>";
              ?>
              <p>overdue payment</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="overdue.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- <!-.col  -> -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <span class="label label-default">Check  work balance</span>
               

              <p>Work Balance </p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="balance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <!-- <!-.col  -> -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <span class="label label-default"> Add to expenditure</span>
             
              <p>Expenditure</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="expenditure.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>






      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Sales Report</h3>
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        for($i=2015; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div>
            </div>
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

<!-- Chart Data -->
<?php
  $and = 'AND YEAR(Datetime) = '.$year;
  $months = array();
  $moderate = array();
  $lowsales = array();
  for( $m = 1; $m <= 12; $m++ ) {
    $sql = "SELECT * FROM history WHERE MONTH(Datetime) = '$m' AND Status = 'on' $and";
    $oquery = $conn->query($sql);
    array_push($moderate, $oquery->rowCount());

    $sql = "SELECT * FROM history WHERE MONTH(Datetime) = '$m' AND Status = 'off' $and";
    $lquery = $conn->query($sql);
    array_push($lowsales, $lquery->rowCount());

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $lowsales = json_encode($lowsales);
  $moderate = json_encode($moderate);

?>
<!-- End Chart Data -->

<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Lowsales',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?php echo $lowsales; ?>
      },
      {
        label               : 'Moderate',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $moderate; ?>
      }
    ]
  }
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
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
