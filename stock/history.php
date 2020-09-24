
<?php include 'includes/header.php'; ?>
<?php include '../class/login.php'; ?>
<?php  Login_attempt()?>
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
    <h3>Stock record</h3>
          <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">stock record</li>
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
             Hi, all  store history appears here, 
            </div>
            <div class="box-body">
               <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
           <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                   <th>Item-Name</th>
                  <th>Item-Type</th>
                  <th>Item-amount(#)</th>
                  <th>Quantity</th>
                  <th>Measure</th>
                  <th>Size</th>
                   <th>Remain</th>
                  <th>Exp-date</th>
                  <th>Addedby</th>
                  <th>date</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
               $userid = $_SESSION['USeR_id'];
                 $obj= new Main;
                   $data = $obj->Read_record('store');
                    if ($data > 0) {
                 
                    foreach ($data as $emrow) {
           $id=$emrow['id'];
                      ?>
                      
                        <tr>
                          <td><?php echo $emrow['Item_name']; ?></td>
                         <td><?php echo $emrow['Item_type']; ?></td>                          
                          <td><?php echo number_format($emrow['Item_amount'], 2)   ; ?></td>
                           <td><?php echo $emrow['Quantity']; ?></td>
                            <td><?php echo $emrow['Measure']; ?>Kg</td>
                             <td><?php echo $emrow['Size']; ?></td>
                             <td><?php 
                  $remain = $emrow['Remain'];
                   if ($remain=='off') {
                   $remain = $emrow['Quantity'];
                   }else if ($remain ==0) {
                    $remain= "<span class='label label-warning'>empty</span>";
                   }else{
                     $remain = $emrow['Remain'];
                   }
                      echo$remain ?></td>
                              <td><?php 
                              $getmonthnow= date('M');
                               $getdaynow= date('D');
                                $getynow= date('Y');
                               $getfulldatenow= date('M D, Y');
                               $getyear=$getmonth=date('Y', strtotime($emrow['Exp_date']));
                               $getmonth=date('M', strtotime($emrow['Exp_date']));
                              $getday=date('D', strtotime($emrow['Exp_date']));
                              $dayandmonth=date('m / D', strtotime($emrow['Exp_date']));
                              $getdate= date('M D, Y', strtotime($emrow['Exp_date'])); 
                             if ($getyear==$getynow && $getmonth==$getmonthnow &&  $getday== $getdaynow) { $Exp_date="this item expired today " .$getday;?>
                              <span class="label label-warning"><?php  echo $Exp_date ?></span>
                          <?php } elseif ($getyear==$getynow && $getmonthnow < $getmonth ) {$Exp_date="this item  expired on "."<stong>'".$dayandmonth."'</strong"; ?>
                                <span class="label label-warning"><?php  echo $Exp_date ?></span>
                           
                            <?php } elseif ($getyear==$getynow && $getmonth==$getmonthnow && $getday != $getdaynow) {$Exp_date="this item  expired on "."<stong>'".$getday."'</strong"; ?>
                                <span class="label label-warning"><?php  echo $Exp_date ?></span>
                            <?php } elseif ($getyear < $getynow ) {$Exp_date="this item expired since ".$getdate;?>
                                   <span class="label label-danger"><?php  echo $Exp_date ?></span>
                            <?php }else{?>
                               <?php echo  $Exp_date=date('M d, Y', strtotime($emrow['Exp_date']));?>
                            <?php  }  ?></td>
                               <td><?php if ($emrow['Addedby']==$userid) {
                                 echo "You";
                               }else{
                                $sql = "SELECT * FROM employees where employee_id ='$userid'";
                $query = $conn->query($sql);
                $row = $query->fetch();
              echo  $empname = $row['firstname'].' '.$row['lastname'];} ?></td>
                          <td><?php echo $emrow['Datetimes'] ?></td>
                          <td>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/delete.php?del_store=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                      <?php
                    }  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
   <?php include 'includes/store_modal.php'; ?>
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
