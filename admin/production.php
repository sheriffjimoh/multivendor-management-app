
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
       Daily production List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Inventory</li>
        <li class="active">Daily production List</li>
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
               <?php if (isset($_GET['update_product'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php     
                  $obj= new Main;
                  $id= $_GET['update_product'];
                   $row = $obj->Read_single_record('production',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit production</span> </h2> 
                      <form class="form-horizontal" method="POST" action="../class/process/action.php" enctype="multipart/form-data">
               <input type="hidden" name="id"  value="<?php  echo $row['id'] ?>">
                     <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Product name</label>
                     <span class="text-info">selected </span><?php echo $row['Prod_name'] ?>
                    <div class="col-sm-9">
                      <select class="form-control" name="prod_name" id="position" required>
                        <option value="" selected>Select---</option>
                        <?php
                     $obj= new Main;
                   $data = $obj->Read_record('product');
                    foreach ($data as $prow) {
                            echo "
                              <option value='".$prow['P_name']."'>".$prow['P_name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                    <div class="form-group"> 
                    <label for="rate" class="col-sm-3 control-label">Product piecies</label>
                      
                        <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="prod_peices" value="<?php echo $row['Prod_peices'] ?>"  required>
                    </div></div>
                     <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Product size</label>
              <span class="text-info">selected </span><?php echo $row['prod_size'] ?>
                    <div class="col-sm-9">
                      <select class="form-control" name="prod_size" id="position" required>
                        <option value="" selected>Select---</option>
                        <?php
                     $obj= new Main;
                   $data = $obj->Read_record('product');
                    foreach ($data as $prow) {
                            echo "
                              <option value='".$prow['P_size']."'>".$prow['P_size']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                  
                  
            </div>

            <div class="modal-footer">
                           <button type="submit" class="btn btn-primary btn-flat" name="update_production"><i class="fa fa-save"></i> Save</button></div>
              </form></div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                   <th>prod -name</th>
                  <th>prod-price</th>
                  <th>prod-size</th>
                  <th>prod-peices</th>
                  <th>prod-remain</th>
                  <th>update-Peices</th>
                  <th>update-date</th>
                  <th>Total-amount</th>
                  <th>Status</th>
                  <th>Addedby</th>
                  <th>Date&Time</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();

                 $obj= new Main;
                   $data = $obj->Read_record('production');
                   if ($data > 0) {
                     
                   
                    foreach ($data as $row) {?>
                      
                      <?php

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['Prod_name']; ?></td>
                          <td><?php echo  $row['Prod_price'];?></td>
                           <td><?php echo  $row['prod_size'];?></td>
                           <td><?php echo  $row['Prod_peices'];?></td>
                           <td>&nbsp;&nbsp;<spain class="label label-info"> <?php echo  $row['Remain'];?>&nbsp;&nbsp;</spain></td>
                              <td>&nbsp;&nbsp;<spain class="label label-info"> <?php echo  $row['update_peices'];?>&nbsp;&nbsp;</spain></td>
                      <td>&nbsp;&nbsp;<?php echo  $row['update_date'];?>&nbsp;&nbsp;</td>

                            <td><?php echo  $row['Prod_amount'];?></td>
                              <td><?php if ($row['Status'] =='off') {?>
                                <span class="label label-warning">pending</span>
                            
                             <?php  } else {?>     <span class="label label-success">Approved</span>  <?php }?></td>
                             <td><?php $empid = $row['Addedby'];
                                  $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last;?></td>
                            <td><?php echo date('M d, Y', strtotime($row['Datetimes'])); ?></td>
                          <td>
                            <a class='btn btn-success btn-sm  btn-flat' href='production.php?update_product=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/delete.php?del_production=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
                 <?php }  }?>

            </div>


     <?php 

 ?>
















          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/production_modal.php'; ?>
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
