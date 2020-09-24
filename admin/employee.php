
<?php include 'includes/header.php'; ?>
<?php include '../class/login.php'; ?>
<?php login_attempt();?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

<style type="text/css">
  
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Employee List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Employee List</li>
      </ol>
    </section>    <!-- Main content -->
    <section class="content">


   <?php  
   $time = time();   
    $date = date('Y:m:d', $time);
     $month = date('m');
   $day = date('d');

   ?>



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
               <?php if (isset($_GET['preiview'])) { ?>
 <a href="employee.php"  class="btn btn-primary btn-sm btn-flat"><i class="fa fa-arrow-left"> &nbsp;</i>Back</a>

                 <?php } else if (isset($_GET['update_emp'])) {?>
                <a href="employee.php"  class="btn btn-primary btn-sm btn-flat"><i class="fa fa-arrow-left"></i>Back</a>
                     <?php } else{?>
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            <?php }?>
            </div>
            <div class="box-body">
            <?php if (isset($_GET['preiview'])) { ?>
                <div class="card  ">
                   <h3 class="text-info">employeee info <span class="fa fa-eye"></span></h3>
                   <hr>
                   <div class="card-content col-sm-offset-4">
                     <?php

                      $obj= new Main;
                  $id= $_GET['preiview'];
                   $row = $obj->Read_single_record('employees',$id); $schedule_id = $row['schedule_id'] ;  $emp_id = $row['id'];?>
                   <div class="card-img">
                     <img src="<?php echo (!empty($row['photo']))? '../images/'.$row['photo']:'../images/profile.jpg'; ?>" width="180px" height="100px">   </div>
                      <div class="card-text">
                        <ul class="list-group">
                          <li class="list-item"><strong>Firstname:</strong><?php echo $row['firstname']  ?></li>
                             <li class="list-item"><strong>lasttname:</strong><?php echo $row['lastname']  ?></li>
                         <li class="list-item"><strong>Phone:</strong><?php  echo  $row['contact_info'] ?></li>
                        <li class="list-item"><strong>Gender:</strong><?php echo $row['gender']  ?></li>
                          <li class="list-item"><strong>Address:</strong><?php echo $row['address']  ?></li>
                           <li class="list-item"><strong>Position:</strong> <?php $obj= new Main;$position_id = $row['position_id'];$prow = $obj->Read_single_record('position',$position_id); echo  $prow['Designation'];?></li>
                              <li class="list-item"><strong>work time scheduled:</strong>   <?php $obj= new Main;$srow = $obj->Read_single_record('schedule',$schedule_id); echo  $srow['Time_in']." --- ".$srow['Time_out'];?></li>
                               <li class="list-item"><strong>monthly salary:</strong> <?php echo   $prow['Salary'];?></li>
                                <li class="list-item"><strong>salary date:</strong> <?php echo   $row['Start'];?></li>
                                 <li class="list-item"><strong>Started work since:</strong> <?php if (empty($row['Start'])) {?>
                               <form  method="POST" class="form-group"   action="#">
                              <p class="lead label label-warning" id="warning">this employee have not started working with us !</p>
                              <p class="lead label label-info" id="info">we use this date in relevant to pay our employee salary !</p>
                                <label class="form-label">Select start date:</label>
                                <input type="hidden" name="id"  class="start_id"  value="<?php echo $emp_id; ?>">
                                <span class="text-danger" id="error"></span>
                                <span class="text-success" id="success"></span>
                                   <input type="date" class="datepicker_add" name="start_date" required=""> <a href="#" class="btn  start_submit" 
                                    id="start_submit">SUbmit</a>
                               </form>
                               <?php   } else{ echo  $row['Start']; }?> <span class="label label-info">employee salary date </span> </li>

                               <hr>
                              <h2 class="text-info" style="font-weight: bolder;"> My  Guarantor</h2>
                              <hr>
                               <div class="card-img">
                     <img src="<?php echo (!empty($row['gPhoto']))? '../images/'.$row['gPhoto']:'../images/profile.jpg'; ?>" width="180px" height="100px">   </div>
                             <li class="list-item"><strong>Fullname:</strong> <?php echo $row['gFullname'] ;?></li>
                             <li class="list-item"><strong>profession:</strong> <?php echo $row['gProfession'] ;?></li>
                             <li class="list-item"><strong>Contact-Address:</strong> <?php echo $row['gAddress'] ;?></li>
                             <li class="list-item"><strong>Contact-Phone:</strong> <?php echo $row['gPhone'] ;?></li>
                        </ul>

                      </div>              

                   </div>
                 </div>
                 <?php } else if (isset($_GET['update_emp'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php     
                  $obj= new Main;
                  $id= $_GET['update_emp'];
                   $row = $obj->Read_single_record('employees',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit employee info</span> </h2> 
           <form class="form-horizontal" method="POST" action="../class/process/action.php" enctype="multipart/form-data">
                <div class="form-group">
                 
                          <input type="hidden" name="id"  value="<?php echo $row['id'] ?>"> 
                            <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="address" id="address" ><?php echo $row['address'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Birthdate</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="birthdate" value="<?php echo $row['birthdate'] ?>">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">phone</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['contact_info'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9"> 
                      <span class="label label-primary"><?php echo $row['gender'] ?></span>
                      <select class="form-control" name="gender" id="gender" required="" >
                        <option value="" selected>- Select -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Position</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="position" id="position"">
                        <option value="" >- Select -</option>
                         <option  value="<?php echo $row['position_id'] ?> " selected>- Selected -</option>
                        <?php
                     $obj= new Main;
                   $data = $obj->Read_record('position');
                    foreach ($data as $prow) {
                            echo "
                              <option value='".$prow['id']."'>".$prow['Designation']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule" class="col-sm-3 control-label">Schedule</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="schedule" name="schedule" required>
                         <option  value="<?php echo $row['schedule_id'] ?> " selected>- Selected -</option>
                        <option value="" >- Select -</option>
                        <?php
                       $obj= new Main;
                   $data = $obj->Read_record('schedule');
                    foreach ($data as $srow) {
                            echo "
                              <option value='".$srow['id']."'>".$srow['Time_in'].' - '.$srow['Time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                <img src="<?php echo (!empty($row['photo']))? '../images/'.$row['photo']:'../images/profile.jpg'; ?>" width="60px" height="30px">                  
                  <label for="photo" class="col-sm-3 control-label">Photo</label>
        
                    <div class="col-sm-9">
                      <input type="file" name="photo" id="photo" class="pull-right" required>
                    </div>
                </div>
              


                 <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Full name </label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="gfname"  value="<?php echo $row['gFullname']; ?>"    required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Profession</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="gprofession" value="<?php echo $row['gProfession']; ?>"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control"  name="gaddress" value="<?php echo $row['gAddress']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Mobile Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="gphone"  value="<?php echo $row['gPhone']; ?>"   required>
                    </div>
                </div>


                  <div class="form-group">
                <img src="<?php echo (!empty($row['gPhoto']))? '../images/'.$row['gPhoto']:'../images/profile.jpg'; ?>" width="60px" height="30px">                  
                  <label for="photo" class="col-sm-3 control-label">Photo</label>
        
                    <div class="col-sm-9">
                      <input type="file" name="gphoto" id="photo" class="pull-right" required>
                    </div>
                </div>
            </div>
            <div class=" col-sm-6   col-sm-offset-2">
                            <button type="submit" class="btn btn-primary btn-flat" name="update_employee"><i class="fa fa-save   pull-right"></i> Save</button>
                          </div>
              </form></div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered table-responsive">
                <thead>
                   <th>Employee ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Schedule</th>
                  <th>Member Since</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();

                 $obj= new Main;
                   $data = $obj->Read_record('employees');
                    foreach ($data as $emrow) {?>
                      
                      <?php

                      $id = $emrow['id'];
                       $position_id=$emrow['position_id'];
                             $schedule_id=$emrow['schedule_id'];

                       $sql=$conn->query("SELECT * FROM position WHERE id='$position_id' ");
                           while($porow = $sql->fetch()){
                                $Designation= $porow['Designation'];
                           }
                           $sql=$conn->query("SELECT * FROM schedule WHERE id='$schedule_id' ");
                           while($scrow = $sql->fetch()){
                                $time_in= $scrow['Time_in'];
                                 $time_out= $scrow['Time_out'];
                           }
                       ?>

                        <tr>
                          <td><?php echo $emrow['employee_id']; ?></td>
                          <td><img src="<?php echo (!empty($emrow['photo']))? '../images/'.$emrow['photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> <a href="#edit_photo" data-toggle="modal" class="pull-right photo" ></a></td>
                          <td><?php echo $emrow['firstname'].' '.$emrow['lastname']; ?></td>
                          <td><?php echo  $Designation; ?></td>
                          <td><?php echo date('h:i A', strtotime( $time_in)).' - '.date('h:i A', strtotime( $time_out)); ?></td>
                          <td><?php echo date('M d, Y', strtotime($emrow['created_on'])) ?></td>
                          <td>
                            <a class='btn btn-success btn-sm  btn-flat' href='employee.php?update_emp=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/delete.php?del_employee=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>
                   <a  class='btn btn-primary btn-sm  btn-flat'href='employee.php?preiview=<?php echo $id ?>' ><i class='fa fa-eye'></i>Preview</a>

                          </td>
                        </tr>
                      <?php
                    }
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
  <?php include 'includes/employee_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){

  $('#start_submit').click(function(e){
    e.preventDefault();
    var date = $(".datepicker_add").val();
    var id = $(".start_id").val();
    if (date=="") {
     var date = $(".datepicker_add").css('border-color','red');
      $('#error').html("pick date please !");

 }else{
     getRow(id,date);
    }
  
  
  });

});

function getRow(id,date){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id, date:date },
    dataType: 'json',
    success: function(response){
      $('#success').html("start date added");
      $('#error').hide();
     $(".datepicker_add").hide();
    $(".start_id").hide();
    $("#warning").hide();
     $("#info").hide();
    }
  });
}
</script>

</body>
</html>
