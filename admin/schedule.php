
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
        Schedules
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
                   $data = $obj->Read_single_record('schedule',$id);
          $time_in =date('h:i A', strtotime($data['Time_in']));
          $time_out =date('h:i A', strtotime($data['Time_out']));
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit schedule</span> </h2> 
            <form class="form-horizontal" method="POST" action="../class/process/schedule_edit.php">
              <input type="hidden" name="id"  value="<?php echo  $data['id'] ?>">
                <div class="form-group">
                    <label for="edit_time_in" class="col-sm-3 control-label">Time In</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_time_in" name="time_in" value="<?php echo  $time_in ?>"   required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_time_out" class="col-sm-3 control-label">Time out</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_time_out" name="time_out" value="<?php echo  $time_out ?>"  required="">
                      </div>
                    </div>
                </div>
            </div>
            <div class="input-group col-sm-8 col-sm-offset-4">
              <button type="submit" class="btn btn-success btn-flat"  name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form></div>


        <?php  } else{  ?>
          <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>NO of Employeee</th>
                  <th>Addedby</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                  $objdb= new DBH;
                  $conn = $objdb->Connect();
                  $obj= new Main;
                   $data= $obj->Read_record('schedule');
                    foreach ($data as $row) {
                      $id = $row['id'];

                      
                   
                      $sql=$conn->query("SELECT  CoUNT(*) FROM employees WHERE  schedule_id= '$id'");
               $conut = $sql->fetch();
                $num = array_shift($conut); 
             
                    echo "
                        <tr>
                          <td>".date('h:i A', strtotime($row['Time_in']))."</td>
                          <td>".date('h:i A', strtotime($row['Time_out']))."</td>
                           <td><span class='label label-primary'>".$num."</span></td>
                          <td>".$row['Addedby']."</td>
                          <td>";?>
                    <a class='btn btn-success btn-sm  btn-flat' href='schedule.php?update_id=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/schedule_delete.php?del_schedule=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>
                          </td>
                        </tr>
                      
                    <?php  } ?>

                  

                </tbody>
              </table>
                <?php  } ?>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
   <?php include 'includes/schedule_modal.php'; ?>

</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(window).on('load', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    });
});

</script>

</script>




</html>
