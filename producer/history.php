
<?php include 'includes/header.php'; ?>
<?php include '../class/login.php'; ?>
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
        <li class="active">Product List</li>
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
             Hi, Here you can glance history of produced items  uploaded all days , by you only.
            </div>
       <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                   <th>Name</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Peices</th>
                  <th>Remain</th>
                  <th>update&nbsp;-&nbsp;peices</th>
                  <th>update&nbsp;-&nbsp;date</th>
                  <th>Total&nbsp;-&nbsp;amount</th>
                  <th>Date&time</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
                 $userid = $_SESSION['USeR_id'];
                $sql =$conn->prepare("SELECT * FROM production where Addedby='$userid' and Status='on'");
                 $STH =$sql->execute();
                  while ($row =$sql->fetch(PDO::FETCH_ASSOC)){?>
                      
                      <?php

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['Prod_name']; ?></td>
                          <td><?php echo  number_format($row['Prod_price'],2) ;?></td>
                           <td><?php echo  $row['prod_size'];?></td>
                           <td><?php echo  $row['Prod_peices'];?></td>
                           <td>&nbsp;&nbsp;<spain class="label label-info"> <?php echo  $row['Remain'];?>&nbsp;&nbsp;</spain></td>
                              <td>&nbsp;&nbsp;<spain class="label label-info"> <?php echo  (!empty($row['update_peices']))? $row['update_peices']:0;;?>&nbsp;&nbsp;</spain></td>
                      <td>&nbsp;&nbsp;<?php echo  (!empty($row['update_date']))? $row['update_date']:0;?>&nbsp;&nbsp;</td>

                            <td><?php echo  number_format($row['Prod_amount'],2) ;?></td>
                      
                            <td><?php echo date('M d, Y', strtotime($row['Datetimes'])); ?></td>
                           <td><span class="label label-success">Approved</span></td>
                        </tr>
                      <?php
                    }
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
