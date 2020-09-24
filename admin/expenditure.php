
<?php include 'includes/header.php'; ?>
<?php include '../class/login.php'; ?>
<?php login_attempt();?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
     Today Pay List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>employee</li>
        <li class="active">pay List</li>
      </ol>
    </section>    <!-- Main content -->
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
             <ul class="list-group">
              <h3 class="pull-center text-info">Totall expenditure</h3>
              <hr>
                <?php
                $addedby = $_SESSION['USeR_id'];
                echo '<a href="home.php" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> &nbsp; Back</a> ';
            echo "<br>";  echo "<br>";
                   $time=time();
                $date = date("Y-m-d", $time);

                   $obj = new DBH;
                $conn= $obj->Connect();
                            $expenses =0;
                           $sql=$conn->query("SELECT * FROM supply WHERE Expenses !=0 and Date='$date' ");
                           while($row = $sql->fetch()){
                              $expenses += $row['Expenses'];
                           }

                          
                       ?>
              <span class="text-success lead">just today</span>
              <br>
              <span class="text-success lead" id="success"></span>
              <br>
                <li class="list-group-item">Supplier expenditure <span class="text-info pull-right"><?php echo  '#'.number_format($expenses,2); ?></span></li>
                <li class="list-group-item">general admin expenditure

            <?php $addedby = $_SESSION['USeR_id'];
                        $sql=$conn->query("SELECT * FROM expenses WHERE Date='$date'");
                           if ($sql->rowCount() > 0) {
                           while($row = $sql->fetch()){
                              $adminexpenses = $row['Expenses']; } 
                               $total = $expenses + $adminexpenses; 

                              ?>
                     <span class="lead text-info pull-right"> <?php echo '#'. (!empty(number_format($adminexpenses,2))) ? number_format($adminexpenses,2) : 0;  ?></span>
                               <?php  }else{    $total  =0; ?>
            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm   btn-flat pull-right" > <i class="fa fa-plus"></i> add</a>
                               <?php  } ?>
                          
                       
                </li>
                <li class="list-group-item">Addedby <span class="lead text-info pull-right"><?php if ($addedby==$row['Addedby']) {
                 echo "You";                }else{ $empid =$row['Addedby']; 
                 $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last; }?></span></li>
                <li class="list-group-item">Total daily  expenditure <span class="lead text-info pull-right"><?php echo '#'. (!empty(number_format($total,2))) ? number_format($total, 2) : 0;   ?></span></li>
             </ul>
            
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/expenses_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  
  $('#Save').click(function(e){
    e.preventDefault();
    var expenses = $(".expense").val();
    if (expenses == "") {
      $(".expense").css('border-color','red');
       $('.error').html("input some value !");
 }else{
     getRow(expenses);
       $(".expense").css('border-color','grey');
    }
  
  
  });

});

function getRow(expenses){
  $.ajax({
    type: 'POST',
    url: 'expenses_action.php',
    data: {expenses:expenses},
    dataType: 'json',
    success: function(response){
      $('#success').html(response.input);
      $('#addnew').hide();
    }
  });
}
</script>

</body>
</html>
