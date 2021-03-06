
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
       supplied List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">supplied List</li>
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
            <div class="box-body">
                            <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                   <th>Name</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Peices</th>
                  <th>Gross</th>
                  <th>Returned</th>
                  <th>expenses</th>
                  <th>Balance</th>
                  <th>Total&nbsp;-&nbsp;amount</th>
                  <th>Date&Time</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
               $userid = $_SESSION['USeR_id'];
                  $sql=$conn->query("SELECT  * FROM supply  WHERE Status='on'  and Payment='on' and Cleared_by='$userid' order by id desc ");
           if ($sql->rowCount() > 0) {
                     while ($row = $sql->fetch()) {
?>
                      
                      <?php
            $return = $row['Returned'];
            $balance =$row['Balance'];
            $Expenses = $row['Expenses'];

            $price = $row['Prod_price'];
                       $trprice = $price*$return;
            $total =  $balance + $Expenses + $trprice ;
            $gtotal= $row['Total']  - $total;

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['Prod_name']; ?></td>
                          <td><?php echo  $row['Prod_price'];?></td>
                           <td><?php echo  $row['Prod_size'];?></td>
                           <td><?php echo  $row['Prod_peices'];?></td>
                            <td><?php echo  number_format($row['Total'], 2) ;?></td>
                             <td><?php echo  $return;?></td>
                              <td><?php echo number_format($Expenses, 2) ;?></td>
                               <td><?php echo  number_format($balance, 2);?></td>
                              <td><?php  echo  number_format($gtotal, 2) ; ?>
                             </td>


                             
                          <td><?php echo date('M d, Y', strtotime($row['Date'])); ?></td>
                          <td>
                       
                          </td>
                        </tr>
                      <?php
                    } }
                  ?>
                </tbody>
              </table>
           <hr>
           <h2>production record </h2>
           <hr>
              <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                   <th>Name</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Peices</th>
                  <th>Gross</th>
                 <th>Status</th>
                  <th>Date&Time</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
               $userid = $_SESSION['USeR_id'];
                  $sql=$conn->query("SELECT  * FROM production WHERE Status='on'  and Cleared_by='$userid' order by id desc ");
           if ($sql->rowCount() > 0) {
                     while ($row = $sql->fetch()) {
?>
                      
                      <?php
         

                      $id = $row['id'];?>
                       

                        <tr>
                          <td><?php echo $row['Prod_name']; ?></td>
                          <td><?php echo  $row['Prod_price'];?></td>
                           <td><?php echo  $row['prod_size'];?></td>
                           <td><?php echo  $row['Prod_peices'];?></td>
                            <td><?php echo  number_format($row['Prod_amount'], 2) ;?></td>
                          
                             <td>
                         <span class="label label-success">Cleared</span>
                          </td>


                             
                          <td><?php echo date('M d, Y', strtotime($row['Datetimes'])); ?></td>
                         
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
