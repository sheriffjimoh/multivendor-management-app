
<?php include 'includes/header.php'; ?>
<?php include '../login.php'; ?>
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
       Product List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Product List</li>
        <li class="active">Product List</li>
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
                   $row = $obj->Read_single_record('product',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit Item</span> </h2> 
                      <form class="form-horizontal" method="POST" action="../class/process/staff-action.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Product name</label>
                 <input type="hidden" name="id"  value="<?php echo $row['id'] ?>">
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id=">Product name" name="p_name" value="<?php  echo $row['P_name']?>" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">size</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="size" name="p_size" value="<?php  echo $row['P_size']?>" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Price</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="Price" name="p_price" value="<?php  echo $row['P_price']?>" required>
                    </div>
                </div>

            <div class="modal-footer">
                           <button type="submit" class="btn btn-primary btn-flat" name="update_product"><i class="fa fa-save"></i> Save</button></div>
              </form></div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered">
                <thead>
                   <th>product-name</th>
                  <th>product-price</th>
                  <th>product-size</th>
                  <th>Date&Time</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();

                 $obj= new Main;
                   $data = $obj->Read_record('product');
                   if ($data > 0) {
                     
                   
                    foreach ($data as $row) {?>
                      
                      <?php

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['P_name']; ?></td>
                          <td><?php echo  $row['P_price'];?></td>
                           <td><?php echo  $row['P_size'];?></td>
                          <td><?php echo date('M d, Y', strtotime($row['Datetimes'])); ?></td>
                          <td>
                            <a class='btn btn-success btn-sm  btn-flat' href='product.php?update_product=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/staff-delete.php?del_product=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
                 <?php }  }?>

            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/product_modal.php'; ?>
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
