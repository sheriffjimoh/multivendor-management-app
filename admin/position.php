
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
        Position
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Position</li>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
               <?php if (isset($_GET['update_id'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php     
                  $obj= new Main;
                  $id= $_GET['update_id'];
                   $row = $obj->Read_single_record('position',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit schedule</span> </h2> 
            <form class="form-horizontal" method="POST" action="../class/process/position_edit.php">
              <input type="hidden" id="posid" name="id"  value="<?php echo $row['id']?>">
                <div class="form-group">
                    <label for="edit_title" class="col-sm-3 control-label">Position Title</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_title" name="title" value="<?php echo $row['Designation']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_rate" class="col-sm-3 control-label">Salary per Hr/Mh</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_rate" name="rate"  value="<?php echo $row['Salary']?>">
                    </div>
                </div>
            </div>
            <div class="input-group col-sm-8 col-sm-offset-4">
              <button type="submit" class="btn btn-success btn-flat"  name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form></div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                  <th>Position Title</th>
                  <th>#salary per hour </th>
                  <th>#salary per month</th>
                  <th>Addedby</th>
                  <th>No of Employee</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                  $obj= new Main;
                  $objdb= new DBH;
                  $conn = $objdb->Connect();
                   $data = $obj->Read_record('position');
                    foreach ($data as $row) {
                      $id=$row['id'];

                      $sql=$conn->query("SELECT  COUNT(*) FROM employees WHERE  position_id= '$id'");
               $conut = $sql->fetch();
                $num = array_shift($conut); 
                    echo "
                        <tr>
                          <td>".$row['Designation']."</td>
                          <td>".number_format(ceil($row['Salary_hour']), 2)."</td>
                           <td>".number_format($row['Salary'], 2)."</td>
                          <td>".$row['Addedby']."</td>
                            <td> <span class='label label-primary' >".$num."</span></td>
                          <td>" ?>
                <a class='btn btn-success btn-sm  btn-flat' href='position.php?update_id=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/position_delete.php?del_position=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                  
                   <?php }?>
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
  <?php include 'includes/position_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'schedule_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#timeid').val(response.id);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#del_timeid').val(response.id);
      $('#del_schedule').html(response.time_in+' - '+response.time_out);
    }
  });
}
</script>
</body>
</html>
