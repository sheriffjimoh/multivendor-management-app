
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
       unclear List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>inventory</li>
        <li class="active">unclear List</li>
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
            <div class='alert alert-info alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-bullhorn'></i> NOTICE!</h4>
             initial value for expenses , Product returned and balance will be zero if you dont provide any,  before click paid / cleared .
            </div>
              <table id="example1" class="table table-bordered  table-responsive">

                <thead>
                   <th>Name</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Peices</th>
                  <th>Tamount</th>
                  <th>Supplier</th>
                  <th>Apayable</th>
                  <th>Expenses</th>
                  <th>P-returned</th>
                  <th>Balance</th>
                  <th>Date&Time</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
         $obj = new Main;
               $date =$obj->Read_uncleard('supply');
        if ($date > 0) { 
          foreach ($date as $row) {?>
                      
                     <?php  $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['Prod_name']; ?></td>
                          <td><?php echo  $row['Prod_price'];?></td>
                           <td><?php echo  $row['Prod_size'];?></td>
                           <td><?php echo  $row['Prod_peices'];?></td>
                            <td><?php echo  $row['Total'];?></td>
                             <td><?php $empid = $row['Supplier'];
                                  $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last;?></td>
                             <td><?php echo  $row['Total'];?></td>
                            
                              <td><?php if (empty($row['Expenses'])) {?>
                                <a class='btn btn-primary btn-sm  btn-flat exp' data-id='<?php echo $row['id'] ?>' data-value='Expenses' > <i class="fa fa-plus"></i> add</a>
                                 <?php }else{ echo $row['Expenses'];}?> 
                              </td>
                              <td><?php if (empty($row['Returned'])) {?>
                                <a class='btn btn-primary btn-sm  btn-flat exp' data-id='<?php echo $row['id'] ?>' data-value='Returned'  > <i class="fa fa-plus"></i> add</a>
                                <?php }else{ echo $row['Returned']; }?> 
                              </td> <td><?php if (empty($row['Balance'])) {?>
                                <a class='btn btn-primary btn-sm  btn-flat exp' data-id='<?php echo $row['id'] ?>' data-value='Balance'  > <i class="fa fa-plus"></i> add</a>
                                 <?php }else{ echo $row['Balance']; }?> 
                              </td>
                          <td><?php echo date('M d, Y', strtotime($row['Date'])); ?></td>
                          <td>
                            <?php if ($row['Payment']=='off') {?> 
                              <a class='btn btn-warning  btn-sm  btn-flat'  href='<?php echo base_url('class/process/update.php?paid='.$id) ?>' ><i class="fa fa-warning"></i>paid</a>
                           <?php  }  ?>
                            <?php  if ($row['Status']=='off'){ ?>
                            <a class='btn btn-danger btn-sm  btn-flat'  href='<?php echo base_url('class/process/update.php?clear='.$id) ?>'> <i class="fa fa-warning"></i>clear</a>
                          <?php }  ?>
                          </td>
                        </tr>
                      <?php
                    } }
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
  <?php include 'includes/supply_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
 

$(window).on('load', function(){
 $msg = $('#msg').html();
      // window.alert($msg);
  });
$(function(){
  $('.exp').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var value = $(this).data('value');
     var valuein = $(this).data('value');
     var prefix = 'Total '+valuein;
    $('.suppid').val(id);
    $('.suppval').val(value);
     $('#label').html(prefix);
   $('#exp').modal('show');
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

</script>

</body>
</html>
