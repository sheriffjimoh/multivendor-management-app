
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
       staff account list
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>account List</li>
        <li class="active">supplier account List</li>
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
               <?php if (isset($_GET['update_supplier'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php     
                  $obj= new Main;
                  $id= $_GET['update_supplier'];
                   $row = $obj->Read_single_record('panel',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit account</span> </h2> 
                   <form class="form-horizontal" method="POST" action="../class/process/action.php">
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">user ID</label>
               <input type="hidden" name="id"  value="<?php echo $row['id']?>">
                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control"   name="user-id"  value="<?php  echo $row['User_id'] ?>" required>
                      </div>
                    </div>
            </div>
            <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">username</label>

                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control"  name="user-name" value="<?php  echo $row['username'] ?>"  required>
                      </div>
                    </div>
            </div>
            <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">password</label>

                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="password" class="form-control"  name="password" required>
                      </div>
                    </div>
            </div> <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">comfirm password</label>

                  <div class="col-sm-9"> 
                      <div class="date">
                        <input type="password" class="form-control"  name="cpassword" required>
                      </div>
                    </div>
            </div>
           

            <div class="form-group">
                           <button type="submit" class="btn btn-success btn-flat" name="update_supplier"><i class="fa fa-save"></i> update</button></div>
              </form></div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered">
                <thead>
                   <th>user-Id</th>
                   <th>position</th>
                  <th>username</th>
                  <th>password</th>
              
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
                 
  $sql=$conn->query("SELECT  * FROM panel where User_type='staff'");
          while ($row = $sql->fetch()) { ?>
                      <?php

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['User_id']; ?></td>
                          <td>supplier</td>
                           <td><?php echo  $row['username'];?></td>
                           <td><span id="hide">******************** </span> <span id="show" style="display: none;"><?php  echo  $row['Password']; ?></span> <a href="" id="eyeopen"><i  class="fa fa-eye pull-right"></i></a></td>
                          <td>
                  <a class='btn btn-success btn-sm  btn-flat' href='supplier.php?update_supplier=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/delete.php?del_supplier=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
                 <?php  }?>

            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/staff_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('#eyeopen').hover(function(e){
    e.preventDefault();
    $('#show').show();
    $('#hide').hide();
  });
  $('#eyeopen').mouseleave(function(e){
    e.preventDefault();
    $('#show').hide();
    $('#hide').show();
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
