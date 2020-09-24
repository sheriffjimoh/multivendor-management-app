
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
       purchases list
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>inventory</li>
        <li class="active">purchased List</li>
      </ol>
    </section> 
   <style type="text/css">
  
  .label-default{
    padding: 1rem;
    font-size: 15px;
  }   


   </style>
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
           
            <div class="box-body">
               <?php if (isset($_GET['view_suppply'])) {?>
          <ul class="list-group">
            <a href="purchase.php" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i>&nbsp;Back</a><br><br>
<?php     
$trprice = 0;
 $gtotal = 0;
                  $obj= new Main;
                  $id= $_GET['view_suppply'];
                   $row = $obj->Read_single_record('supply',$id);
            $return = $row['Returned'];
            $balance =$row['Balance'];
            $Expenses = $row['Expenses'];

            $price = $row['Prod_price'];
             if (is_numeric($balance) || is_numeric($Expenses)  ||  is_numeric($trprice)) {
               
            $trprice = $price*$return;
            $total =  $balance + $Expenses + $trprice ;
            $gtotal= $row['Total']  - $total;
}

              
 $empid = $row['Supplier'];
    $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];?>
                 <img src="<?php echo (!empty($prow['photo'])) ? '../images/'.$prow['photo'] : '../images/profile.jpg'; ?>" class="img-circle img-card" width='90px' alt="User Image" > 
                 <span class="label label-success">Supplier</span>  
              <h3 class="text-info"><?php echo  $prow['firstname'].$prow['lastname']?></h3></div>
       <li class="list-group-item">Prod-name<span class="label label-default pull-right"><?php echo $row['Prod_name']; ?></span></li> 
     <li class="list-group-item">Prod-price<span class="label label-default  pull-right"><?php echo $row['Prod_price']; ?></span></li>     
       <li class="list-group-item">Prod-size<span class="label label-default  pull-right"><?php echo $row['Prod_size']; ?></span></li>   
       <li class="list-group-item">Prod-peices<span class="label label-default  pull-right"><?php echo $row['Prod_peices']; ?></span></li>
      <li class="list-group-item">Total-returned<span class="label label-default  pull-right"><?php echo (!empty($row['Returned'])) ? $row['Returned'] : 0; ?></span></li>
         <li class="list-group-item">Total-Balance-holding<span class="label label-default  pull-right"><?php echo   (!empty($row['Balance'])) ? number_format($row['Balance'],2) : 0;   ?></span></li> 
           <li class="list-group-item">Total-Expenses<span class="label label-default  pull-right"><?php echo   (!empty($row['Expenses'])) ? number_format($row['Expenses'],2) : 0;   ?></span></li> 
      <li class="list-group-item">Total-amount<span class="label label-default  pull-right">#--<?php echo   (!empty($row['Total'])) ? number_format($row['Total'],2) : 0;   ?></span></li> 
       <li class="list-group-item">Total-amount-payable<span class="label label-default  pull-right">#--<?php echo (!empty($gtotal)) ? number_format($gtotal,2) : 0;   ?></span></li>  <li class="list-group-item">Date<span class="label label-default  pull-right"><?php echo date('M d, Y', strtotime($row['Date']))?></span></li> </ul>
          </div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                   <th>Name</th>
                  <th>price</th>
                  <th>Size</th>
                  <th>peices</th>
                  <th>Balance</th>
                   <th>Expenses</th>
                   <th>Returned</th>
                  <th>Tamount</th>
                  <th>Supplier</th>
                  <th>Date&Time</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
                  $trprice = 0;
                  $total =0;
                 $obj= new Main;
                   $data = $obj->Read_cleard('supply');
                   if ($data > 0) {
                     foreach ($data as $row) {
               $return = $row['Returned'];
            $balance =$row['Balance'];
            $Expenses = $row['Expenses'];

            $price = $row['Prod_price'];
            $trprice = $price*$return;
            if (is_numeric($balance) && is_numeric($Expenses)  &&  is_numeric($trprice)) {
                         $total =  $balance + $Expenses + $trprice ;
            $gtotal = $row['Total']  - $total;
            }

                     ?>
                      
                      <?php

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['Prod_name']; ?></td>
                          <td><?php echo  $row['Prod_price'];?></td>
                           <td><?php echo  $row['Prod_size'];?></td>
                           <td><?php echo  $row['Prod_peices'];?></td>
                           <td><?php echo  $balance;?></td>
                           <td><?php echo  $Expenses;?></td>
                            <td><?php echo  $return;?></td> 
                            <td><?php echo  number_format($row['Total'], 2) ;?></td>
                             <td><?php $empid = $row['Supplier'];
                                  $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last;?></td>
                            
                            
                             
                          <td><?php echo date('M d, Y', strtotime($row['Date'])); ?></td>
                          <td>
                       
   <a class='btn btn-success btn-sm  btn-flat' href='purchase.php?view_suppply=<?php echo $id ?>' ><i class='fa fa-eye'></i>&nbsp;Preview</a>
          <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/staff-delete.php?del_supply=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
                 <?php }  }?>

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
