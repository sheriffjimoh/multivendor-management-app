
<?php include 'includes/header.php'; ?>
<?php include '../class/login.php'; ?>
<?php login_attempt();?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <style type="text/css">
    
.table-responsive{
  display: block;
   overflow-x: scroll;
   width: 100%;
  -webkit-overflow-scrolling:touch;
}

  </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
          <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">outgoing List</li>
      </ol>
    </section>    <!-- Main content -->
    <br>
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
            <div class='alert alert-info alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-bullhorn'></i> NOTICE!</h4>
             Hi, all pendings  offer appear here!
              kindly verify all supplier visualy before clicking clear.
            </div>
            <div class="box-body">
             
          <ul class="list-group">
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
                 $neobj = new Main;
               $userid = $_SESSION['USeR_id'];
           $sql=$conn->query("SELECT  * FROM supply  WHERE   Status='on'  and  Payment='off'   order by id desc ");
           if ($sql->rowCount() > 0) {
                     while ($row = $sql->fetch()) {?>
                      
                      <?php
                         $return = $row['Returned'];
            $balance =$row['Balance'];
            $Expenses = $row['Expenses'];

            $price = $row['Prod_price'];
             if (is_numeric($balance) || is_numeric($Expenses)  ||  is_numeric($trprice)) {
               
            $trprice = $price*$return;
           $total =  $balance + $Expenses + $trprice ;

           $row['Total'];

           $gtotal= $row['Total']  - $total;
}

                      $id = $row['id'];?>
                         <h3 class="text-info"><?php echo  $row['Prod_name'].' ---- '.$row['Prod_size'] ?></h3>
            <h3>Supplier    ----<?php 
               echo  $neobj->get_employeees_name($row['Supplier']);

            ?></h3>
        <li class="list-group-item">Prod-name<span class="label label-info pull-right"><?php echo $row['Prod_name']; ?></span></li> 
     <li class="list-group-item">Prod-price<span class="label label-info pull-right"><?php echo $row['Prod_price']; ?></span></li>     
       <li class="list-group-item">Prod-size<span class="label label-info pull-right"><?php echo $row['Prod_size']; ?></span></li>   
       <li class="list-group-item">Prod-peices<span class="label label-info pull-right"><?php echo $row['Prod_peices']; ?></span></li>
      <li class="list-group-item">Gross-amount<span class="label label-info pull-right"><?php echo  $row['Total'] ?></span></li>

       <li class="list-group-item">Expenses
                     <?php if ($row['Expenses']==0) {?> <span class="pull-right">
  <a class='btn btn-primary btn-sm  btn-flat exp' data-id='<?php echo $row['id'] ?>' data-value='Expenses' > <i class="fa fa-plus"></i> add</a>    </span>
     <?php }else{ echo '<span class="label label-info pull-right">'.$row['Expenses'].'</span>';}?>
       <li class="list-group-item">Returned-peices
 <?php if ($row['Returned']==0) {?> <span class="pull-right">
  <a class='btn btn-primary btn-sm  btn-flat exp' data-id='<?php echo $row['id'] ?>' data-value='Returned' > <i class="fa fa-plus"></i> add</a>   </span>
     <?php }else{ echo '<span class="label label-info pull-right">'.$row['Returned'].'</span>';}?> 
      </li>  
 <li  class="list-group-item">Returned-amount<span class="label label-info pull-right"><?php echo (!empty($trprice))? $trprice:0;  ?> </span></li>

    <li class="list-group-item">Credit <?php if ($row['Balance']==0) { ?> <span class="pull-right">
 <a class='btn btn-primary btn-sm  btn-flat exp' data-id='<?php echo $row['id'] ?>' data-value='Balance'  > <i class="fa fa-plus"></i> add</a><?php }else{ echo '<span class="label label-info pull-right">'.$row['Balance'].'</span>'; }?> 
            </span></li>
 <li  class="list-group-item">Total-amount<span class="label label-info pull-right"><?php echo (!empty($gtotal))? $gtotal:0;  ?> </span></li>

  <li class="list-group-item">Date<span class="label label-info pull-right"><?php echo date('M d, Y', strtotime($row['Date']))?></span></li> 
       <li class="list-group-item pull-right">
        <a  class='btn btn-warning btn-sm  btn-flat' onclick='return confirm("this attempt is to clear this order,please note that you must verified before clear this  !");' href='../class/process/staff-update.php?paid_supply=<?php echo $id ?>' ><i class='fa fa-check'></i> Clear</a>
</li>  <br>               
                 <?php }     } else{?>
                  <h2 class="text-warning lead">Seems you have no pending payment, you can order from your home </h2>
                      <li class="list-group-item">Step 1: Refresh this page </li>
                  <li class="list-group-item">Step 2: Check your connection! </li>
                  <li class="list-group-item">Step 3: contact manager for help ! </li>
                  <h4 class="text-warning lead">Note : Your booking record are kept to map your relation with <strong>danjuma's bakery</strong> for compensation and the likes.  </h4>
              <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/supply_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

$(function(){
  $('.exp').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var value = $(this).data('value');
     var valuein = $(this).data('value');
     var prefix = 'Total '+valuein;
    $('.suppid').val(id);
    $('.suppval').val(value);
     $('#label').html(prefix);
   $('#exp').modal('show');
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

</script>

</body>
</html>
