
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
     Today Pay List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>employee</li>
        <li class="active">pay List</li>
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
              <div class="pull-center">
                 <?php $timestamp = time();
 $date = date("Y-m-d", $timestamp) ?>
           <a class='btn btn-success btn-sm  btn-flat'  onclick="return confirm('please make sure this salaries are paid,      if yes => click only one paid button to mark it paid')" href='../class/process/update.php?update_pay=<?php echo $date ?>'   id="markall" ><i class='fa fa-click'></i>Mark-all</a>               
              </div>
            </div>
             
              <table id="example1" class="table table-bordered">
                <thead>
                   <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Gross</th>
                  <th>Deductions</th>
                  <th>Cash Advance</th>
                  <th>Net Pay</th>
                  <th>Status</th>
                  <th>Date&Time</th>
                  <th>Tools</th>
                </thead>
                <tbody>

                                     <?php
                   $obj = new DBH;
                $conn= $obj->Connect();
                $timestamp = time();
                $date = date("Y-m-d", $timestamp);
                $yandm = date("m-d", $timestamp);
                  $day = date("d", $timestamp);
                $month=date("m", $timestamp);
                $daysago = date("d", strtotime( '+5 day'));
                    $sql =$conn->query("SELECT *, employees.employee_id AS empid , cashadvance.amount AS cashamount , deductions.amount AS damount   FROM employees  LEFT JOIN cashadvance ON  employees.employee_id=cashadvance.employee_id LEFT JOIN deductions ON   employees.employee_id=deductions.employee_id   LEFT JOIN position ON   employees.position_id = position.id   where employees.Start='$date'");
                    if ($sql->rowCount() > 0) {
                     
                  while ($row = $sql->fetch()) { 
                        $row['employee_id'];
                       $empid = $row['empid'];
                         $damount = $row['damount'];
                         $camount = $row['cashamount'];
                $empstart = date("Y-m-d", strtotime($row['Start'])); 
                     $empstartd = date("d", strtotime($row['Start']));
                      $ago = date("d", strtotime( '+5 day', strtotime($row['Start'])));
                    $empstartm = date("m", strtotime($row['Start']));
                    if ($empstartd == $day   ) { 
  
                    ?>

                        <tr>
                          <td><?php echo $row['firstname'].$row['lastname']?></td>
                          <td><?php echo $row['empid'];?></td>
                          <td><?php echo $row['Salary']?></td>
                             <td><?php echo  (!empty($damount ))?  $damount  :  "0" ; ?></td>
                              <td><?php echo  (!empty($camount))?  $camount :  "0" ;  ?></td>
                              <td><?php if (empty($damount)) { $damount =0 ; }if (empty($camount)) {$camount=0; }
                            $add = $camount + $damount;
                              $net = $row['Salary']- $add;
                              if ( $net < 0) {
                                echo $netpay = 0;
                              }else{
                               $netpay = number_format($net,2); echo $netpay ;
                             }





                                ?></td>
                              <td><span class="label label-warning">not clear</span></td>
                               <td><?php echo $empstart ?></td>
                               <td>
                                <form  method="post"  action="<?php echo base_url('class/process/action.php') ?>">
                                   <input type="hidden" class='employee_name' name="employee_name" value="<?php  echo $row['firstname'].$row['lastname'] ?>">
                                    <input type="hidden"class='employee_id' name="employee_id" value="<?php  echo $empid ?>">
                                     <input type="hidden"  class="gross"   name="gross" value="<?php  echo $row['Salary'] ?>">
                                    <input type="hidden" class="damount" name="damount" value="<?php  echo (!empty($damount ))?  $damount  :  "0" ;?>">
                                   <input type="hidden" class="camount" name="camount" value="<?php  echo  (!empty($camount))?  $camount :  "0" ;  ?>">
                                      <input type="hidden" class="netpay" name="netpay" value="<?php  echo  $netpay  ?>">
                                      <input type="submit"  name="send_pay"  onclick="return confirm('please make sure this salaries are paid')"  class='btn btn-success btn-sm  btn-flat'  value="Mark-pay">
                                        <input type="submit" name="not_pay"  onclick="return confirm('please make sure this salaries are paid')"  class='btn btn-warning btn-sm  btn-flat'  value="Not-pay">

                                </form>

                     
                               </td>
                        </tr>
 
 <?php              $employee_id= $row['empid'];
                    $employee_name =$row['firstname'].$row['lastname'];
                     if ($net < 0) { $netpay =0;  }else{ $netpay = number_format($net,2);}  // netpay 
                     if (empty($row['damount'])) {$damount =0; } else{$damount = number_format($row['damount'],2); } // deducted amount
                     if (empty($row['cashamount'])) { $camount =0;  }else{ $camount = number_format($row['cashamount'],2); } // cashadvance 
                    



                 //  store  all values in arrays 
                     $gross[] = $row['Salary'];
                      $netpayar[] =$netpay;
                    $damountar[]= $damount;
                    $camountar[] = $camount;
                    $emid[]=$employee_id;
                  $empname[]=$employee_name;
                    
                                          } // closing daily check
                                          }// closing loop
                                          // implode the value with ',' to be readable
                           $impempname = implode(' , ', $empname);
                             $impemid = implode(' , ', $emid);
                             $impcamountar = implode(' , ', $camountar);
                              $impdamountar = implode(' , ', $damountar);
                                 $impnetpayar = implode(' , ', $netpayar);
                               $impgross = implode(' , ', $gross);


               $mandd = date("m-d", $timestamp);
                     $sql = $conn->query("SELECT  * FROM payroll WHERE date LIKE '%$mandd%'");
                    $rowcount = $sql->rowCount();
                      if ($rowcount == 0) {
$value_item = array('employee_id' =>':user_id' , 'employee_name' =>':employee_name','netpay' =>':netpay' , 'gross' =>':gross' , 'cashadvance' =>':cashadvance' , 'deduction' =>':deduction', 'date' =>':date' ,'Status' =>':status' , 'addedby' =>':addedby','type' =>':type');  
   
     $execute_item =array(':user_id' =>$impemid, ':employee_name' => $impempname, ':netpay' =>$impnetpayar,':gross' =>$impgross, ':cashadvance' =>$impcamountar, ':deduction' =>$impdamountar, ':date' =>$date, ':status' =>'unpaid',':addedby' => 'addedby', ':type' => 'date');
  $obj = new Main;
   $insert = $obj->Insert_record('payroll',$value_item,$execute_item);
                      }     

                         
                    }  ?>

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

  $('#markall').click(function(e){
    e.preventDefault();
    var empid = $('.employee_id').val();
     var empname = $('.employee_name').val();
      var gross= $('.gross').val();
   if (empid== '' || empname='' ||  gross='') {
    alert('no value in the fields');
    return false;
   }
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
