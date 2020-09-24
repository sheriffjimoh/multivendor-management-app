
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
}.label {
  padding: 5px;
}

  </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
          <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product List</li>
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
             Hi, Here you can no more about our product, 
              kindly read through for details.
            </div>
            <div class="box-body">
              
          <ul class="list-group">
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
               $userid = $_SESSION['USeR_id'];

             if (isset($_GET['name'])  && isset($_GET['size'])) {
 echo '<a  href="product.php" class="btn btn-primary btn-flat"> <i class="fa fa-arrow-left"></i> Back</a> ';
 echo "<br>";
              $name =$_GET['name'];
              $size = $_GET['size'];
            $sql=$conn->query("SELECT  * FROM production where Prod_name='$name'  and prod_size='$size' and Status='on' ");
           if ($sql->rowCount() > 0) {
               while ($row = $sql->fetch()) {
                        $remain += $row['Remain'];
 $name = $row['Prod_name']; 
  $price = $row['Prod_price']; 
  $size = $row['prod_size'];
                     };
                         $price;       ?>
                     <br>
                 <li class="list-group-item">Produt-name <span class="label label-primary pull-right"><?php echo $name  ?></span>   </li>
                  <li class="list-group-item">Produt-size <span class="label label-primary pull-right"><?php echo $size  ?></span>   </li>
                   <li class="list-group-item">Produt-price <span class="label label-primary pull-right"><?php echo $price ?></span>   </li>
                     <li class="list-group-item">Produt-peices-vailable <span class="label label-primary pull-right"><?php 
                     echo (!empty($remain)) ? $remain : 0;  ?></span>   </li>
             
          <?php }else{?>
      <h2 class="text-warning lead">Seems this product as  not been in production,kindly  check out some other! </h2>
                     <li class="list-group-item">Step 1: Refresh this page </li>
                  <li class="list-group-item">Step 2: Check your connection! </li>
                  <li class="list-group-item">Step 3: contact manager for help ! </li>
                  <h4 class="text-warning lead">Note : Your booking record are kept to map your relation with <strong>danjuma's bakery</strong> for compensation and the likes.  </h4>
       <?php }  }else{ 

        $sql=$conn->query("SELECT  * FROM product ");
           if ($sql->rowCount() > 0) {
                     while ($row = $sql->fetch()) {?>
                      
                      <?php

                      $id = $row['id'];?>
                      

        <li class="list-group-item"><a href="product.php?name=<?php echo $row['P_name'] ?>&&size=<?php echo $row['P_size'] ?>"><?php echo $row['P_name'] ?> --------------- <?php echo $row['P_size'] ?>  <span class="label label-primary pull-right"><i class="fa fa-eye"></i>  Preview</span></a></li>               
                 <?php }     } else{?>
                  <h2 class="text-warning lead">Seems no product in bank,we regain as soon!  you can always follow this stepsfor your booking services</h2>
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
  <?php include 'includes/supply_modal.php'; ?>
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
