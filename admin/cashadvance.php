<?php include '../class/login.php'; ?>
<?php login_attempt();?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cash Advance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Cash Advance</li>
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
          <?php if (isset($_GET['update_cash'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php
            $id= $_GET['update_cash'];     
                  $obj= new Main;
                   $row = $obj->Read_single_record('cashadvance',$id);
               $row['employee_id'];
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit Cashadvance</span> </h2> 
           <form class="form-horizontal" method="POST" action="../class/process/action.php" enctype="multipart/form-data">
             <div class="form-group">
                    <label for="employee" class="col-sm-3 control-label">Employee ID</label>
                   <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="employee" name="employee_id" value="<?php echo $row['employee_id'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $row['amount'] ?>" required>
                    </div>
                </div>

            <div class=" col-sm-6   col-sm-offset-2">
                <button type="submit" class="btn btn-success btn-flat" name="update_cash"><i class="fa fa-save   pull-right"></i> Update</button>
                          </div>
                          <br> <br> <br>
              </form></div>


        <?php  } else{  ?>
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                  <th class="hidden"></th>
                 
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Adddedby</th> 
                  <th>Date</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                                     <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
                $newobj = new Main;
                   $data =$newobj->Read_cash_advance();
                    if ($data >0) {
                   
                   foreach ($data as $row) {
                   

                        $fullname = $row['firstname'].$row['lastname']; $id = $row['caid'];?>

                         <tr>
                           <td><?php echo $row['employee_id']?></td>
                           <td><?php echo $fullname?></td>
                           <td><?php echo number_format( $row['amount'],2)?></td>
                           <td><?php $empid = $row['Addedby'];
                                    $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");
                                    $STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last;?></td>
                           <td><?php echo $row['date_advance']?></td>
                           <td>  
                            <a class='btn btn-success btn-sm  btn-flat' href='cashadvance.php?update_cash=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/delete.php?del_cash=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>
</td>
                         </tr>
                           <?php }  }?>
                </tbody>
              </table>
            </div> <?php } ?>

          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/cashadvance_modal.php'; ?>
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
    url: 'cashadvance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.date').html(response.date_advance);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('.caid').val(response.caid);
      $('#edit_amount').val(response.amount);
    }
  });
}
</script>
</body>
</html>
