
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
       Daily used Item List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Stock</li>
        <li class="active">used Item List</li>
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
            
         <div class="box-tools ">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Show total value: </label>
                      <select class="form-control" id="item_name" name="item_name" required>
                        <option selected disabled>select item name ----</option>
                        <?php
                       $obj= new Main;
                   $data = $obj->Read_record('item');
                    foreach ($data as $srow) {
                            echo "
                              <option value='".$srow['Item_name']."'>".$srow['Item_name']."</option>
                            ";
                          }
                        ?>
                      </select>

                  </div>
                </form>
              </div>
        
      
               <?php
                 if(isset($_GET['item'])){
                 $item_name = $_GET['item'];

                      ?>
                      
                      <?php 
                       $obj = new DBH;
                $conn= $obj->Connect();
                    $total = 0;
                    $cremain = 0;
                    $addnewq = 0;
                     $intremian = 0;
             $sql=$conn->query("SELECT * FROM store WHERE  Item_name= '$item_name' AND Status='on'");

                    while($value = $sql->fetch()){
                     $remain = $value['Remain'];
                       $item_name = $value['Item_name'];
                         $size =$value['Size'];
                           $qty = $value['Quantity'];
                          $total += $qty;
                          if ($remain =='off') {
                            $addnewq  += $qty;
                            
                          } if ($remain !='off' ) {
                             $intremian =  $remain;
                          }

             } 
               $cremain = $addnewq  + $intremian;
             ?>
                  
              <table border="2" style="margin: 10px; padding: 2rem;" class="table"><tr><th>total  <?php echo  $item_name ?> in the store </th><th>Total  <?php echo  $item_name ?> Remained</th><th>measurement</th></tr>
          <tr><td align="center">    <?php echo  ceil($total)  ?></td><td><?php if ($value['Remain'] ='off') { echo $cremain  ; }else if ($value['Remain'] = 0) {

            echo "empty";
          }?></td>
            <td>
              bag
            </td></tr></table>
<?php } ?>

        
              <table id="example1" class="table table-bordered  table-responsive">
                <thead>
                   <th>Item-name</th>
                  <th>T/Quantity</th>
                  <th>T/remain</th>
                  <th>Date&Time</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                      <?php 
                       $obj = new DBH;
                $conn= $obj->Connect();
                    $total = 0;
          
                   $sql=$conn->query("SELECT * FROM store where Status ='on' ");
                        while ($row = $sql->fetch()) {
                           $itemname  = $row['Item_name'];
                           $qty =$row['Quantity'];
                         if ($row['Remain']=='off' && $row['Item_name'] == $row['Item_name'] ) {
                             $total += $qty;
                         }else{
                           $total=$row['Remain'];
                         }
                       
                                          ?>
                      <td><?php echo $itemname    ?></td>
                       <td><?php echo  $qty ?></td> 
                       <td><span class="label label-info"><?php echo $total ?></span></td>          
                           <td><?php echo $row['Datetimes'] ?></td>       
                      <td><a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/delete.php?del_daily_item=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>  <br> <?php   } ?>
                    </tbody>
              </table>
               


            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/daily_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('#item_name').change(function(){
    window.location.href = 'remain.php?item='+$(this).val();
  });
});
</script>
</body>
</html>
