
<?php include 'includes/header.php'; ?>
<?php include '../login.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>


<style type="text/css">
  
.label{
  font-size: 20px;
  font-weight: bolder;
  padding: 10px;
  font-family:  newtimeroman;
 margin-top: 15px;
 display: inline-block;
}.label i {
  color: #9989;
  font-size: 20px;
}

</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
      my profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>profile</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Update profile</a>
            </div>
              <?php 
         $obj = new DBH;
         $conn  = $obj->Connect();
          $empid = $_SESSION['USeR_id'];

         $sql =$conn->query("SELECT * FROM employees WHERE employee_id ='$empid'");
           $row = $sql->fetch();
               $row['created_on'];
                 $sql =$conn->query("SELECT * FROM panel WHERE User_id ='$empid'");
           $unirow = $sql->fetch();
                $username = $unirow['username'];
              $User__id = $unirow['User_id'];
     
           ?>

            <div class="box-body">
             <div class="card  col-sm-8  ">
              <div class="img-card col-sm-offset-4">
                <img src="../images/cover.jpeg" width="100%" style="">
              </div>
                  <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-responsive  col-sm-offset-7  col-xs-offset-5"  style="width: 120px;  text-align: center; margin-top: -50px;" >
                  <div class="card-text  col-sm-offset-4">
                      <label class="label"><i class="fa fa-user"></i>&nbsp;<span class="text-primary">username: </span>  <span class="label label-success"><?php echo  $username ?></span></label>
                       <label class="label"><i class="fa fa-th"></i>&nbsp;<span class="text-primary">user-id: </span> <span class="label label-success"><?php  echo  $unirow['User_id'] ?></span> </label>
                     <label class="label">  <i class="fa fa-calendar"></i>&nbsp;<span class="text-primary"> memeber since: </span><span class="label label-success"><?php echo  $row['created_on']; ?></span> </label>
                     <label class="label">  <i class="fa fa-spinner"></i>&nbsp; <span class="text-primary">Danjuma bakery staff:</span> <span class="label label-success">verified</span></label>

                  </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/profile_modal.php'; ?>
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
