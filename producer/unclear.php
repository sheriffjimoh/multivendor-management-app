
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
        <li class="active">Add production</li>
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
             Hi, Here you can review all submited daily production pending approval from distributor.
            </div>
            <div class="box-body">
              <div class="box-body">
                   <?php if (isset($_GET['update_product'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php     
                  $obj= new Main;
                  $id= $_GET['update_product'];
                   $row = $obj->Read_single_record('production',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit production</span> </h2> 
                      <form class="form-horizontal" method="POST" action="../class/process/staff-action.php" enctype="multipart/form-data">
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
          <ul class="list-group">
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
               $userid = $_SESSION['USeR_id'];
           $sql=$conn->query("SELECT  * FROM production  WHERE   Status='off' AND Addedby='$userid' order by id desc ");
           if ($sql->rowCount() > 0) {
                     while ($row = $sql->fetch()) {?>
                      
                      <?php

                      $id = $row['id'];?>
                         <h3 class="text-info"><?php echo  $row['Prod_name'].' ---- '.$row['prod_size'] ?></h3>

        <li class="list-group-item">Prod-name<span class="label label-info pull-right"><?php echo $row['Prod_name']; ?></span></li> 
     <li class="list-group-item">Prod-price<span class="label label-info pull-right"><?php echo number_format($row['Prod_price'],2) ; ?></span></li>     
       <li class="list-group-item">Prod-size<span class="label label-info pull-right"><?php echo $row['prod_size']; ?></span></li>   
       <li class="list-group-item">Prod-peices<span class="label label-info pull-right"><?php echo $row['Prod_peices']; ?></span></li>
         <li class="list-group-item">update-peices<span class="label label-info pull-right"><?php echo (!empty($row['update_peices'])) ? $row['update_peices'] :0; ?></span></li>      <li class="list-group-item">Total-amount<span class="label label-info pull-right"><?php echo  number_format($row['Prod_amount'],2) ?></span></li>           <li class="list-group-item">Date<span class="label label-info pull-right"><?php echo date('M d, Y', strtotime($row['Datetimes']))?></span></li> 
       <li class="list-group-item pull-right">  <a class='btn btn-success btn-sm  btn-flat' href='unclear.php?update_product=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/staff-delete.php?del_production=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>
</li>  <br>               
                 <?php }     } else{?>
                     <h2 class="text-warning lead">Seems you have no pending order</h2>
                  <li class="list-group-item">Step 1: Refresh this page </li>
                  <li class="list-group-item">Step 2: Check your connection! </li>
                  <li class="list-group-item">Step 3: contact manager for help ! </li>
                  <h4 class="text-warning lead">Note : Your booking record are kept to map your relation with <strong>danjuma's bakery</strong> for compensation and the likes.  </h4>
              <?php } ?>
              </ul>
            <?php } ?>
            </div>
          </div>
        </div>
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
