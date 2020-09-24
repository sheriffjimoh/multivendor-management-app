
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
       Daily used Item List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Stock</li>
        <li class="active">used Item List</li>
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
               <?php if (isset($_GET['update_daily_item'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php     
                  $obj= new Main;
                  $id= $_GET['update_daily_item'];
                   $row = $obj->Read_single_record('daily',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit Item</span> </h2> 
                        <form class="form-horizontal" method="POST" action="../class/process/staff-action.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Item_name</label>
                     <span class="text-info">Selected: </span><?php  echo $row['Item_name']?></span>
                    <div class="col-sm-9"> <select class="form-control" id="schedule" name="item_name" required>
                        <option selected disabled>select item name ----</option>
                        <?php
                       $obj= new Main;
                   $data = $obj->Read_record('item');
                    foreach ($data as $srow) {
                            echo "
                              <option value='".$srow['Item_name']."'>".$srow['Item_name']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Quantity</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="quantity" value="<?php  echo $row['Quantity']?>" required>
                    </div>
                </div>
                                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Size</label>
                   <span class="text-info">Selected: </span><?php  echo $row['Size']?></span>
                    <div class="col-sm-9">
                     <select name="size" class="form-control select-2"   required="">
                       <option selected disabled>select size---</option>
                       <option value="bag">Bag</option>
                        <option value="h-bag">Half-bag</option>
                         <option value="q-bag">Qurtar-bag</option>
                         <option value="p-rubber">paint-rubber</option>
                         <option value="tin">Tin</option>
                         <option value="shachet">Shachet</option>
                      

                     </select>
                    </div>
            <div class="form-group">
             
              <button type="submit" class="btn btn-primary btn-flat" name="add_daily_item"><i class="fa fa-save"></i> Save</button></div>
              </form></div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered">
                <thead>
                   <th>Item-name</th>
                  <th>Quantity</th>
                  <th>Size</th>
                  <th>Addedby</th>
                  <th>Date&Time</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();

                 $obj= new Main;
                   $data = $obj->Read_record('daily');
                    if ($data > 0) {
                    
                    foreach ($data as $row) {?>
                      
                      <?php

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['Item_name']; ?></td>
                          <td><?php echo  $row['Quantity'];?></td>
                           <td><?php echo  $row['Size'];?></td>
                          <td><?php echo  $row['Addedby'];?></td>
                          <td><?php echo date('M d, Y', strtotime($row['Datetimes'])); ?></td>
                          <td>
                            <!-- <a class='btn btn-success btn-sm  btn-flat' href='daily.php?update_daily_item=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a> -->
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/staff-delete.php?del_daily_item=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                      <?php
                    }}
                  ?>
                </tbody>
              </table>
                 <?php   }?>

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
