
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
        <li class="active">Add production</li>
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
             Hi, Here you can review all submited daily production pending approval from distributor.
            </div>
            <div class="box-body">
              <div class="box-body">
             
          <ul class="list-group">
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
             $userid = $_SESSION['USeR_id'];
           $sql=$conn->query("SELECT  * FROM production  WHERE   Status='on' and Cleared_by ='$userid'  order by id desc ");
           if ($sql->rowCount() > 0) {
                     while ($row = $sql->fetch()) {?>
                      
                      <?php

                      $id = $row['id'];?>
                         <h3 class="text-info"><?php echo  $row['Prod_name'].' ---- '.$row['prod_size'] ?></h3>

        <li class="list-group-item">Prod-name<span class="label label-info pull-right"><?php echo $row['Prod_name']; ?></span></li> 
     <li class="list-group-item">Prod-price<span class="label label-info pull-right"><?php echo number_format($row['Prod_price'],2) ; ?></span></li>     
       <li class="list-group-item">Prod-size<span class="label label-info pull-right"><?php echo $row['prod_size']; ?></span></li>   
       <li class="list-group-item">Prod-peices<span class="label label-info pull-right"><?php echo $row['Prod_peices']; ?></span></li>
         <li class="list-group-item">update-peices<span class="label label-info pull-right"><?php echo (!empty($row['update_peices'])) ? $row['update_peices'] :0; ?></span></li>      <li class="list-group-item">Total-amount<span class="label label-info pull-right"><?php echo  number_format($row['Prod_amount'],2) ?></span></li>           <li class="list-group-item">Date<span class="label label-info pull-right"><?php echo date('M d, Y', strtotime($row['Datetimes']))?></span></li> 
       <li class="list-group-item pull-right"> <span class="label label-success">  Cleared</span>
                 
</li>  <br>               
                 <?php }     } else{?>
                  <h2 class="text-warning lead">Seems you have no cleared production,  </h2>
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
