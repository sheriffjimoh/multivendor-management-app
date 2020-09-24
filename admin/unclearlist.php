
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
       new trip  list
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>inventory</li>
        <li class="active">purchased List</li>
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
            <div class="box-body">
            <div class='alert alert-info alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-bullhorn'></i> NOTICE!</h4>
             Hi, Your  pendings  offer appear here!
            
            </div>   
            <ul class="list-group">                
    <?php     if (isset($_GET['unclear'])) {?>
                 <?php $obj = new DBH;
                 $conn = $obj->Connect();
                 $sql= $conn->query("SELECT * FROM supply INNER JOIN employees ON supply.Supplier= employees.employee_id  where supply.Status='off' and supply.Payment='off'");
                 if ($sql->rowCount() > 0) {
                  while ($row=$sql->fetch()) {
                       $row['firstname'];
                          $row['lastname'];
                       $supp = $row['employee_id'];
                       $id= $row['id']; ?>
            <div class="card">
            <br> 
                 <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-circle img-card" width='90px' alt="User Image" >   
              <h3 class="text-info"><?php echo  $row['firstname'].$row['lastname']?></h3></div>

        <li class="list-group-item">Prod-name<span class="label label-info pull-right"><?php echo $row['Prod_name']; ?></span></li> 
     <li class="list-group-item">Prod-price<span class="label label-info pull-right"><?php echo $row['Prod_price']; ?></span></li>     
       <li class="list-group-item">Prod-size<span class="label label-info pull-right"><?php echo $row['Prod_size']; ?></span></li>   
       <li class="list-group-item">Prod-peices<span class="label label-info pull-right"><?php echo $row['Prod_peices']; ?></span></li>      <li class="list-group-item">Total-amount<span class="label label-info pull-right"><?php echo  $row['Total'] ?></span></li>           <li class="list-group-item">Date<span class="label label-info pull-right"><?php echo date('M d, Y', strtotime($row['Date']))?></span></li> 
       <li class="list-group-item pull-right">  <a class='btn btn-success  btn-sm  btn-flat'  href='<?php echo base_url('class/process/update.php?paid='.$id) ?>' ><i class='fa fa-check'></i>paid</a>
        <a class='btn btn-danger btn-sm  btn-flat'  href='<?php echo base_url('class/process/update.php?clear='.$id) ?>'> <i class="fa fa-warning"></i>clear</a>

</li> <?php } } else {?>
                  <h2 class="text-warning lead">No pending order. </h2>
                 
              <?php } } else{
                 $obj = new DBH;
                 $conn = $obj->Connect();
                 $sql= $conn->query("SELECT * FROM supply INNER JOIN employees ON supply.Supplier= employees.employee_id  where Status='on' and Payment='off'");
                 if ($sql->rowCount() > 0) {
                  while ($row=$sql->fetch()) {
                       $row['firstname'];
                          $row['lastname'];
                       $supp = $row['employee_id'];
                       $id= $row['id']; ?>
            <div class="card">
            <br> 
                 <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-circle img-card" width='90px' alt="User Image" >   
              <h3 class="text-info"><?php echo  $row['firstname'].$row['lastname']?></h3></div>

        <li class="list-group-item">Prod-name<span class="label label-info pull-right"><?php echo $row['Prod_name']; ?></span></li> 
     <li class="list-group-item">Prod-price<span class="label label-info pull-right"><?php echo $row['Prod_price']; ?></span></li>     
       <li class="list-group-item">Prod-size<span class="label label-info pull-right"><?php echo $row['Prod_size']; ?></span></li>   
       <li class="list-group-item">Prod-peices<span class="label label-info pull-right"><?php echo $row['Prod_peices']; ?></span></li>      <li class="list-group-item">Total-amount<span class="label label-info pull-right"><?php echo  $row['Total'] ?></span></li>           <li class="list-group-item">Date<span class="label label-info pull-right"><?php echo date('M d, Y', strtotime($row['Date']))?></span></li> 
       <li class="list-group-item pull-right">  <a class='btn btn-success  btn-sm  btn-flat'  href='<?php echo base_url('class/process/update.php?paid='.$id) ?>' ><i class='fa fa-check'></i>paid</a>
    
</li>
                <?php }}  else{?>
                  <h2 class="text-warning lead">No pending payment. </h2>
                 
              <?php } } ?></ul>
            

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
