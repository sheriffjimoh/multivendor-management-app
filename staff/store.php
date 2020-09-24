
<?php include 'includes/header.php'; ?>
<?php include '../login.php'; ?>
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
      Stock control
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Stock</li>
        <li class="active">Stock control</li>
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
      <?php

     //   $arrr1=array('sheriff','tunde','sheriff');
     //  $arrr2=array('sheriff','tunde','tunde','tunde','sheriff');
     //  // $intersact = array_unique(array)
     //  // print_r( $arrr1);
     //  // print_r( $arrr2);
     // // echo  $name= $arrr1[0];
     //    $intersact = array_intersect( $arrr1,  $arrr2);
     //    $intersactu=array_diff($arrr1,  $arrr2);
     //     $arraysort = arsort($arrr1);
     //     $count=count($intersact);
     //  $cout=array_intersect($arrr2,array_unique(array_diff_key($arrr2, array_unique($arrr2))));
     //  echo $count;
     // foreach ($cout as $key) { 
     
     //  }
     //  echo $key;
      ?>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <div class="card  col-sm-6  col-sm-offset-4" style="">
                 <!-- /.row -->
      
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
             $sql=$conn->query("SELECT * FROM store WHERE  Item_name= '$item_name' AND Status='on'");

                    while($value = $sql->fetch()){
                      $remain = $value['Remain'];
                       $item_name = $value['Item_name'];
                         $size =$value['Size'];
                       if ($size=="bag") {
                           $qty = $value['Quantity'];
                       }elseif ($size=="h-bag") {
                           $qty = $value['Quantity']/2;
                       }elseif ($size=="q-bag") {
                           $qty = $value['Quantity']/3;
                       }elseif ($size=="p-rubber") {
                          $qty = $value['Quantity']/6;
                       }elseif ($size=="shachet") {
                            $qty = $value['Quantity']/8;
                       }elseif ($size=="tin") {
                           $qty = $value['Quantity']/10;
                       }
                       $total += $qty;
             } ?>
                  
              <table border="2" style="margin: 10px; padding: 2rem;"><tr><th>total  <?php echo  $item_name ?> in the store </th><th>Total  <?php echo  $item_name ?> Remained</th></tr>
          <tr><td align="center">    <?php echo  ceil($total)  ?></td><td><?php if ($value['Remain'] == 0) { echo 'empty'; }else{ echo $value['Remain'];}?></td></tr></table>
<?php } ?>

           
              </div>
               <?php if (isset($_GET['update_store'])) {?>
          <div class="col-sm-6 col-sm-offset-2">
            </div><?php     
                  $obj= new Main;
                  $id= $_GET['update_store'];
                   $row = $obj->Read_single_record('store',$id);
      
                    ?>
          <h2> <span style="font-family: alrgerian; color: navy; font-weight: bolder;">Edit Item</span> </h2> 
          <form class="form-horizontal" method="POST" action="../class/process/staff-action.php">
                <input type="hidden" name="id"  value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Item_name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="item_name" value="<?php echo $row['Item_name']?>" required> 
                    </div>
                     </div>
                    <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Item-type</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="item_type" value="<?php echo $row['Item_type']?>" required>
                    </div></div>
                  <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Item_amount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="item_amount" value="<?php echo $row['Item_amount']?>" required>
                    </div></div>
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Quantity</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="quantity" value="<?php echo $row['Quantity']?>" required>
                    </div></div>
                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Size</label>

                    <div class="col-sm-9">
                     selected: <span class="label label-primary"><?php echo $row['Size']?></span>
                     <select name="size" class="form-control select-2"   required="">
                       <option selected disabled>select size---</option>
                       <option value="bag">Bag</option>
                        <option value="h-bag">Half-bag</option>
                         <option value="q-bag">Qurtar-bag</option>
                         <option value="p-rubber">paint-rubber</option>
                         <option value="tin">Tin</option>
                         <option value="shachet">Shachet</option>
                         <option value="tablet">Tablet</option>

                     </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Measure</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="rate" name="measure" value="<?php echo $row['Measure']?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rate" class="col-sm-3 control-label">Exp_Date</label>
                     Selected: <span class="label label-primary"><?php echo $row['Exp_date']?></span>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="rate" name="exp_date" placeholder="expiredate ..." required>
                    </div>
                </div>
            </div>
            </div>
            <div class=" col-sm-6   col-sm-offset-2">
                            <button type="submit" class="btn btn-primary btn-flat" name="update_store"><i class="fa fa-save   pull-right"></i> Save</button>
                          </div>
              </form></div>


        <?php  } else{  ?>
              <table id="example1" class="table table-bordered">
                <thead>
                   <th>Item-Name</th>
                  <th>Item-Type</th>
                  <th>Item-amount(#)</th>
                  <th>Quantity</th>
                  <th>Measure</th>
                  <th>Size</th>
                  <th>Exp-date</th>
                  <th>Addedby</th>
                  <th>date</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                   $obj = new DBH;
                $conn= $obj->Connect();

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
                             <td><?php echo $emrow['Quantity'].' '.$emrow['Size']; ?></td>
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
                               <td><?php echo $emrow['Addedby']; ?></td>
                          <td><?php echo $emrow['Datetimes'] ?></td>
                          <td>
                            <a class='btn btn-success btn-sm  btn-flat' href='store.php?update_store=<?php echo $id ?>' ><i class='fa fa-edit'></i> Edit</a>
                  <a  class='btn btn-danger btn-sm  btn-flat' onclick='return confirm("are you sure you want to delete?");' href='../class/process/staff-delete.php?del_store=<?php echo $id ?>' ><i class='fa fa-trash'></i> Delete</a>

                          </td>
                        </tr>
                      <?php
                    }  }
                  ?>
                </tbody>
              </table>
                 <?php   }?>

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
  $('#item_name').change(function(){
    window.location.href = 'store.php?item='+$(this).val();
  });
});
</script>

</body>
</html>
