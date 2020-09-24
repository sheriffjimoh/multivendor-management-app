
<?php include 'includes/header.php'; ?>
<?php include '../class/login.php'; ?>
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
}.label {
  padding: 5px;
}

  </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
     <h3>All items</h3>
          <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Item List</li>
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
             Hi, Here you can view all item in the store.            </div>
            <div class="box-body">
              
          <ul class="list-group">
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
                $time =time();
                $date = date("Y-m-d", $time);
               $userid = $_SESSION['USeR_id'];

             if (isset($_GET['name']) ) {
 echo '<a  href="item.php" class="btn btn-primary btn-flat"> <i class="fa fa-arrow-left"></i> Back</a> ';
 echo "<br>";
              $name =$_GET['name'];
            $sql=$conn->query("SELECT  * FROM store where Item_name='$name' and Status ='on'");
           if ($sql->rowCount() > 0) {
                     $row = $sql->fetch();?>
                     <br>
                 <li class="list-group-item">Item-name <span class="label label-primary pull-right"><?php echo $row['Item_name']  ?></span>   </li>
                  <li class="list-group-item">Quantity <span class="label label-primary pull-right"><?php echo $row['Quantity']  ?></span>   </li>
                   <li class="list-group-item">Item-amount <span class="label label-primary pull-right"><?php echo number_format( $row['Item_amount'],2); ?></span>   </li>
              <li class="list-group-item">Exp-date<?php if ($row['Exp_date'] == $date) {?>

                      <span class="label label-warning pull-right">item expired</span>
                    <?php }else{ ?><span class="label label-primary pull-right"><?php echo $row['Exp_date']; }  ?></span>   </li>
                    <li class="list-group-item">Size<span class="label label-primary pull-right"><?php echo $row['Size'] ?></span>   </li>
                     <li class="list-group-item">Produt-peices-vailable <span class="label label-primary pull-right"><?php 
                      $remain = $row['Remain'];
                   if ($remain=='off') {
                   $remain = $row['Quantity'];
                   }else{
                     $remain = $row['Remain'];
                   }
                      echo$remain ?></span>   </li>
             
          <?php }else{?>
     
             
                   <h2 class="text-warning lead">Seems this item is no more in the store,  </h2>

                  <li class="list-group-item">Step 1: Refresh this page </li>
                  <li class="list-group-item">Step 2: Check your connection! </li>
                  <li class="list-group-item">Step 3: contact manager for help ! </li>
                  <h4 class="text-warning lead">Note : Your booking record are kept to map your relation with <strong>danjuma's bakery</strong> for compensation and the likes.  </h4><?php }  }else{ 
 $obj=new Main;

  $data = $obj->Read_record('item') ;
  if ($data > 0) {
       foreach ($data as $row) {
?>
                      
                      <?php

                      $id = $row['id'];?>
                      

        <li class="list-group-item"><a href="item.php?name=<?php echo $row['Item_name'] ?>"><?php echo $row['Item_name'];?> --------------- 







         <span class="label label-primary"><i class="fa fa-eye"></i>  Preview</span>    <span class="label label-primary pull-right">

          <?php $name = $row['Item_name']; 
                          $remain =0;
       $sql=$conn->query("SELECT  * FROM store where Item_name='$name' ");
                     while ($row = $sql->fetch()){?>
                   <?php 
                  $newre = $row['Remain'];
                   if ($newre=='off') {
                    $newre = $row['Quantity'];
                   }else{
                      $newre = $row['Remain'];
                   }
                    $remain +=$newre; }  echo$remain?>
        </span></a></li>               
                 <?php }     } else{?>
                   <h2 class="text-warning lead">Seems this item is no more in the store,  </h2>
                  <li class="list-group-item">Step 1: Refresh this page </li>
                  <li class="list-group-item">Step 2: Check your connection! </li>
                  <li class="list-group-item">Step 3: contact manager for help ! </li>
                  <h4 class="text-warning lead">Note : Your booking record are kept to map your relation with <strong>danjuma's bakery</strong> for compensation and the likes.  </h4>
              <?php }  }?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
   <?php include 'includes/daily_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.employee_id').html(response.employee_id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
    }
  });
}
</script>

</body>
</html>
