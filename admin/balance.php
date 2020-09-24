
<?php include 'includes/header.php'; ?>
<?php include '../class/login.php'; ?>
<?php login_attempt();?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <style type="text/css">
      
    .new-btn {
      padding-right: 15rem;
      text-align: center;
      font-size: 20px;
      font-weight: bolder;
    }.f-22{
      font-size: 22px;
    }
   
    </style>
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
       Work balance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>inventory</li>
        <li class="active">work balance</li>
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
            <div class='alert alert-info alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-bullhorn'></i> NOTICE!</h4>
             Hi, Your work balance  appears here!
            
            </div>   
         <div class="card">
          <ul class="list-group">
          <?php   if (isset($_GET['name'])) {
             echo '<a href="balance.php" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> &nbsp; Back</a> ';
            echo "<br>";  echo "<br>";

            echo "<span class='lead text-success'>just today</span>";

            $time =time();
            $date = date("Y-m-d", $time);
      $name = $_GET['name'];
      $Total =0;
      $total =0;
        $return = 0;
            $balance =0;
            $Expenses = 0;
            $result =0;
           $sql=$conn->query("SELECT  * FROM supply where Prod_name='$name' and  Status='on' and Payment='on' and  Date='$date' order by id desc ");
           if ($sql->rowCount() >0) {
           while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {
          $pricees[]= number_format($row['Prod_price'],2);
          $sizee[] = $row['Prod_size'];
          // echo $row['Prod_size'];
           $return += $row['Returned'];
            $balance +=$row['Balance'];
            $Expenses += $row['Expenses'];
            $total +=$row['Total'] ;
            $price = $row['Prod_price'];
            $trprice = $price*$return;
           $result =  $balance + $Expenses + $trprice ;

           $gtotal = $total  - $result; } 

          $implodeprice =  implode('---', $pricees);
          $implodesize =  implode('---', $sizee);
          }?>
          <h3 class="text-info"><?php  echo $name;   ?> Produced</h3>

   
<?php 

  $proamount =0;
  $sql=$conn->query("SELECT  * FROM production where Prod_name='$name' and  Status='on'  and  Datetimes='$date' order by id desc ");
           if ($sql->rowCount() >0) {
           while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {
            if (!empty($row['update_peices'])) {
             $Allpeices= $row['Prod_peices']+ $row['update_peices'];
             $poamount = $row['Prod_price']*$Allpeices;
             $proamount +=$poamount;
            }else{
           $proamount += $row['Prod_amount'];
}
        }?>
 
           
    

     <li class="list-group-item">Production-grant-amount<span class="text-info leade pull-right"><?php  echo number_format($proamount,2) ;?></span></li>


   <h3 class="text-info"><?php  echo $name;   ?> Supplied</h3>
          <hr>
    <!--    <li class="list-group-item">Prod-name<span class="text-info lead pull-right"><?php echo $row['Prod_name']; ?></span></li> --> 
       <li class="list-group-item">Prod-price<span class="text-info leade pull-right"><?php  echo (!empty($implodeprice))? $implodeprice:0 ;?></span></li>     
       <li class="list-group-item">Prod-size<span class="text-info leade pull-right"><?php   echo (!empty($implodesize)) ? $implodesize :0; ?></span></li>   
     
      <li class="list-group-item">Gross-amount<span class="text-info leade pull-right"><?php echo (!empty($total)) ? number_format($total,2):0;  ?></span></li>
  <li class="list-group-item">Returned<span class="text-info leade pull-right"><?php echo (!empty($return)) ?  $return :0; ?></span></li>
  <li class="list-group-item">Returned-price<span class="text-info leade pull-right"><?php echo (!empty($trprice)) ? number_format($trprice,2) :0 ; ?></span></li>
  <li class="list-group-item">Balance<span class="text-info leade pull-right"><?php echo (!empty($balance)) ? number_format($balance,2) :0; ?></span></li>
   <li class="list-group-item">Expenses<span class="text-info leade pull-right"><?php echo (!empty($Expenses)) ? number_format($Expenses,2) :0 ;?></span></li>   <li class="list-group-item">Amount-payable<span class="text-info leade pull-right"><?php echo (!empty($gtotal)) ?  number_format($gtotal,2) :0; ?></span></li>                       
 <?php } else{ echo '<h2 class="text-danger text-center lead">  <i class="ion ion-alert-circled"></i>  No production and sales for this product today</h2>';}?>
            

         <?php } else if (isset($_POST['check']) &&  $_POST['check']=='Check') {
            echo '<a href="balance.php" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> &nbsp; Back</a> ';
            echo "<br>";  echo "<br>";
                  $pname = $_POST['pname'];
                 $psize = $_POST['psize'];
                echo  $perdate = $_POST['date'];

                 if (!empty($pname) && !empty($psize) && !empty($perdate)  ) {
                     $obj = new DBH;
                     $Expenses = 0;
                     $Returned = 0;
                     $balance = 0;
                $conn= $obj->Connect();
               $userid = $_SESSION['USeR_id'];
    $sql=$conn->query("SELECT  * FROM production where Prod_name='$pname' and Prod_size='$psize' and Datetimes='$perdate' order by id desc "); $data=$sql->fetch();
           if ($sql->rowCount() > 0) {
           

                    ?>


         <li class="list-group-item">Prod-name<span class="label label-info pull-right"><?php echo $data['Prod_name']; ?></span></li> 
     <li class="list-group-item">Prod-price<span class="label label-info pull-right"><?php echo $data['Prod_price']; ?></span></li>     
       <li class="list-group-item">Prod-size<span class="label label-info pull-right"><?php echo $data['prod_size']; ?></span></li>   
       <li class="list-group-item">All-peices<span class="label label-info pull-right"><?php echo  $data['Prod_peices']; ?></span></li>
       <li class="list-group-item">update-peices<span class="label label-info pull-right"><?php echo  $data['update_peices']; ?></span></li><li class="list-group-item">Total-remain<span class="label label-info pull-right"><?php echo  $data['Remain']; ?></span></li>
           <?php 
            $returnprice=0;
           $proamount = $data['Prod_amount'];
   $sql=$conn->query("SELECT  * FROM supply where Prod_name='$pname' and Prod_size='$psize' and Date='$perdate' order by id desc ");
             while ($row = $sql->fetch()) {
              $price = $row['Prod_price'];
               $newreturn =$row['Returned'];
               $bewbalance = $row['Balance'];
               $newexpenses= $row['Expenses'];
               if (empty($newexpenses)) {
                $newexpenses= 0;
               }elseif (empty($bewbalance)) {
                 $bewbalance = 0;
               }elseif (empty($newreturn )) {
                $newreturn  = 0;
               }
              if (is_numeric($row['Returned']) || is_numeric($row['Expenses'])  || is_numeric($row['Balance'])) {
                 $Returned += $newreturn;
                  $Expenses += $newexpenses;
                  $balance +=  $bewbalance;
                 $returnprice = $price*$Returned;
                }
                   $Expenses=0;
                
           $expandbal = $balance + $Expenses;
         $num =  $proamount - $expandbal;
          $Totalamount =$num-$returnprice;
          if (empty($newexpenses) &&  empty($newbalance)  && empty($newexpenses)) {
               // $Totalamount =  
               $proamount;
          }
       }    
 ?>

         <li class="list-group-item">Returned-peices<span class="label label-info pull-right"><?php echo (!empty($Returned))? $Returned : 0; ?></span></li>
         <li class="list-group-item">Total-Expenses<span class="label label-info pull-right"><?php echo (!empty($Expenses))? number_format($Expenses,2)  :0;    ?></span></li>
         <li class="list-group-item">Remain-balance<span class="label label-info pull-right"><?php echo (!empty($balance))? number_format($balance,2)  :0; ?></span></li>
             <li class="list-group-item">Total-amount<span class="label label-info pull-right"><?php echo (!empty($proamount))? number_format($proamount,2)  :0;   ?></span></li>
       <li class="list-group-item">Amount-payable<span class="label label-info pull-right"><?php echo  (!empty($Totalamount))? number_format($Totalamount , 2)  :0; ?></span></li>  
        <li class="list-group-item">Date<span class="label label-info pull-right"><?php echo date('M d, Y', strtotime($row['Date']))?></span></li> 

                     
        <?php  echo "</ul>"; }else {
         echo ' <h3 class="text-warning">Seems no record for '.$pname.' of size '.$psize.' on '.$perdate.'</h3>';
         echo '<p class="lead"> NOTE: if you could not found any result here , it means no produtcion was made on this particular product.';
        }

         }else{
                  echo "field the input";
                 }
          }else{?>
           <form class="form-group" method="POST"  action="balance.php">
             <div class="input-group col-sm-12" >
                <div class="form-group col-sm-3">
                   <select class="form-control"  name="pname" id="pname" required>
                     <option disabled selected>Select---Productname</option>
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
                <div class="form-group col-sm-3">
                   <select class="form-control"  name="psize" id="psize" required>
                     <option disabled selected>Select---Productsize</option>
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
                <div class="form-group col-sm-3">
                   <input type="date" name="date" class="form-control" id="perdate" required>
                </div>
                <div class="form-group col-sm-3">
                  <!-- <br> -->
                   <input type="submit" name="check" class="btn btn-success btn-flat btn-block " id="check"  value="Check">
                </div>
             </div>
           </form>
       
         </div>
            <div class="text-info col-sm-10 col-sm-offset-4" ><i style="font-size: 10rem;" class="fa fa-briefcase"></i></div>
 
         <h3 class="text-info">Sight the work balance  for each day , choose prod-name , prod-size and date to view </h3>            
     
              <?php
                     $obj= new Main;
                   $data = $obj->Read_record('product');
                    foreach ($data as $row) {
                       $pname[]=$row['P_name']; }
                       $name = array_unique($pname);
                       foreach ($name as $value) {?>
                  <div class="btn-group "> 
                    <a class="btn btn-info  btn-flat new-btn" href="balance.php?name=<?php echo $value ?>"> <?php echo $value ;?></a>
                  </div>

                      <?php }?>
            <ul class="list-group"> 

             <?php 
             $time = time();
                $date = date("Y-m-d", $time);
                 // $date = "2020-04-24";
               $prodamount =0;
  $sql=$conn->query("SELECT  * FROM production where  Status='on'  and  Datetimes='$date' order by id desc ");
           if ($sql->rowCount() >0) {
           while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {
            if (!empty($row['update_peices'])) {
             $Allpeices= $row['Prod_peices']+ $row['update_peices'];
             $poamount = $row['Prod_price']*$Allpeices;
             $prodamount +=$poamount;
            }else{
           $prodamount += $row['Prod_amount'];
}
        } ?>
 
           
    

     <li class="list-group-item">Production-grant-amount<span class="text-info f-22 pull-right">#<?php  echo number_format($prodamount,2) ;?></span></li>
<hr>

                 <?php  
  $sql=$conn->query("SELECT  * FROM expenses where  Date='$date'");
  if ($sql->rowCount() > 0) {
    $row = $sql->fetch();
          $adminexpense =$row['Expenses'];
          $adminaddedby = $row['Addedby'];
}else{
          $adminexpense = 0;
}
            

                $Returned = 0;
                $Expenses =0;
                $balance = 0;
            $returnprice=0;
            $proamount = 0;
   $sql=$conn->query("SELECT  * FROM supply where  Date='$date' order by id desc ");
             while ($row = $sql->fetch()) {
              $price = $row['Prod_price'];
               $newreturn =$row['Returned'];
               $bewbalance = $row['Balance'];
               $newexpenses= $row['Expenses'];
               $proamount  += $row['Total'];
              if (is_numeric($row['Returned']) || is_numeric($row['Expenses'])  || is_numeric($row['Balance'])) {
                 $Returned += $newreturn;
                  $Expenses += $newexpenses;
                  $balance +=  $bewbalance;
                 $returnprice = $price*$Returned;
                }
                
           $expandbal = $balance + $Expenses+$adminexpense;
         $num =  $proamount - $expandbal;
          $Totalamount =$num-$returnprice ; }



          ?>
              <li class="list-group-item"> Balance-holding<span class=" text-info f-22 pull-right"># <?php  echo (!empty($balance)) ? number_format( $balance,2) :0;  ?></span></li>
             <li class="list-group-item"> Total-expense<span class=" text-info f-22  pull-right"># <?php  echo  (!empty($Expenses)) ? number_format($Expenses)  :0;  ?></span></li>
               <li class="list-group-item">Total-retured<span class=" text-info  f-22 pull-right"><?php  echo (!empty($Returned)) ? $Returned :0;?></span></li>
                 <li class="list-group-item">Total-retured-amount<span class=" text-info f-22 pull-right"># <?php  echo (!empty($returnprice )) ? $returnprice  :0;?></span></li>
                  <li class="list-group-item">Total-amount<span class="text-info f-22 pull-right"># <?php  echo (!empty($proamount)) ? number_format( $proamount,2):0;?></span></li>
                 <li class="list-group-item">General-expenses<span class="text-info f-22  pull-right"># <?php  echo (!empty($adminexpense)) ? number_format($adminexpense,2)  :0; ?></span></li>
                 <li class="list-group-item"> Amount payable<span class="lead text-info   pull-right"># <?php  echo (!empty($Totalamount)) ? number_format($Totalamount,2)  :0;  ?></span></li>
                         <?php 

                        $sql=$conn->query("SELECT  * FROM history where  Datetime='$date' order by id desc ");
                 if ($sql->rowCount()>0) {
                   # code...
                 }else{

                          ?>
                        <form method="POST"  action="expenses_action.php"  >
                               <input type="hidden" name="prodamount" value="<?php  echo $prodamount ?>">
                               <input type="hidden" name="balance" value="<?php  echo $balance ?>">
                               <input type="hidden" name="expenses" value="<?php  echo $Expenses ?>">
                               <input type="hidden" name="returned" value="<?php  echo $Returned ?>">
                               <input type="hidden" name="tamount" value="<?php  echo $proamount ?>">
                               <input type="hidden" name="gexpenses" value="<?php  echo $adminexpense ?>">
                                <input type="hidden" name="payamount" value="<?php  echo $Totalamount ?>">
                                   
                                <input type="submit" name="submit"  value="Save"  class="btn btn-primary btn-block">
                        </form>

                      <?php  } ?>
                </ul>
  <?php }else{
    echo "<h2 class='lead text-danger' > No production today </h2>";
  }  } ?>
                 
            

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

  // $('#check').click(function(e){
  //   e.preventDefault();
  //   // var pname = $('#pname').val();
  //   // var psize = $('#psize').val();
  //   var date = $('#perdate').vale();
  //    alert("date");
  
  // });

});



</script>

</body>
</html>
