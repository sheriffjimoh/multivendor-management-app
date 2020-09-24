
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
    <style type="text/css">
    
    .list-group-item :hover{
      color: navy;
    }  
  .list-group-item{
    font-weight: bolder;

  }.pull-center{
    text-align: center;
    margin-left: 30%;
  }.prodiv{
    width: 45%;
    padding: 4px;
    border: 1px solid green;
    border-radius: 10px;
  }.today{
    padding: 2rem;  font-weight: bolder; font-size: 20px; 
  }

    </style>
  <section class="content-header">
      <h1>
     sale List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>employee</li>
        <li class="active">Salessheet</li>
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
              
            <h3 class="text-info ">Watch  sales grow<span id="eye"> <i class="fa fa-eye"></span></i></h3>
            <?php if (isset($_GET['name'])  && isset($_GET['size'])) {
               echo '<a  href="salessheet.php" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i>Back</a> ';
 echo "<br>";
              $timestamp =time();
            $date = date("Y-m-d", $timestamp);
                $yesterday = date("Y-m-d", strtotime("-1 day", $timestamp));
               $daysago = date("Y-m-d", strtotime("-2 day", $timestamp));
                  $name = $_GET['name'];
                  $size = $_GET['size'];
                    $totalrem = 0;
                     $totalrer = 0;
                         $sql =$conn->query("SELECT *,production.Prod_peices AS ppeices FROM production LEFT JOIN supply ON  production.Prod_name =supply.Prod_name AND production.prod_size = supply.Prod_size   where production.Prod_name='$name' and production.Prod_size='$size' and Datetimes='$date'"); 
                          if ($sql->rowCount() > 0){
              $row = $sql->fetch(); 
                 $pname = $row['Prod_name'];
                 $psize = $row['prod_size'];
                   $peices =$row['ppeices']; 
                     $price = $row['Prod_price']; 
                    $tamount = $row['Prod_amount'];
                    $updatep = $row['update_peices'];
                                  
                 if ($row['Remain'] !=='off') {
                      $totalrem =$row['Remain'];
                                       }
                         if ($row['Returned'] !=='off'  && is_numeric($row['Returned'])) {
                           $totalrer =$row['Returned']; }

                                 ?> 
                    <ul class="list-group">
                        <h3  class="lead" style="font-family: timenewroman; font-size: 27px; font-weight: bolder;"><?php if ($date) { echo "Todays  sheeet for <span class='text-primary'>".$name." of ".$size."</span>"; } ?> --- <span class="text-info">&nbsp;Producer&nbsp;&nbsp;</span><?php $empid = $row['Supplier'];
                                    $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last;?></h3>
                      <li class="list-group-item text-info today" style="">peices produced <span class="label label-success pull-right"><?php echo  $row['ppeices']; ?></span> </li>
                       <li class="list-group-item text-info today">Price per peices <span class="label label-success pull-right"><?php echo     number_format($price, 2); ?></span></li>
                        <li class="list-group-item text-info today">Total price <span class="label label-success pull-right"><?php echo number_format($tamount,2); ?></span></li>

                          <li class="list-group-item text-info today">Total Remain<span class="label label-success pull-right"><?php echo $totalrem; ?></span></li>
                           <li class="list-group-item text-info today">Update peices<span class="label label-success pull-right"><?php   echo (!empty($updatep)) ? $updatep : 0;   ?></span></li>
                          <li class="list-group-item text-info today">Total Returnd <span class="label label-success pull-right"><?php if (empty($totalrer)) { 
                           echo 0;
                         }else{echo  $totalrer; } ?></span></li>



                          <li class="list-group-item  text-info today">
                            <?php 
                  $sql =$conn->query("SELECT COUNT(*) FROM supply  WHERE Prod_name='$name' and Prod_size='$size' and Date='$date' and Status='off' and Payment='off'");
                  $row = $sql->fetch();
                 $arrsifht = array_shift($row);
                

                            ?>
                             Total unpaid offer<span class="label label-success pull-right"><?php echo $arrsifht; ?></span>
                          </li>
                           <?php }else{ echo "<br><h3  class=' text-danger lead'> seem this product as not been added to production bulk Today.</h3>";}?>
                        </ul>
                        <hr>
                      <?php   
                     $totalrem = 0;
                     $totalrer = 0;
                         $sql =$conn->query("SELECT *,production.Prod_peices AS ppeices FROM production LEFT JOIN supply ON  production.Prod_name =supply.Prod_name AND production.prod_size = supply.Prod_size   where production.Prod_name='$name' and production.Prod_size='$size' and Datetimes='$yesterday'");
          if ($sql->rowCount() > 0) {
                        while ($row = $sql->fetch()) {
                  $pname = $row['Prod_name'];
                 $psize = $row['prod_size'];
                $peices = $row['ppeices'];
                  $price = $row['Prod_price'];
                  $updatep =$row['update_peices'];
                  $updated =$row['update_date'];
                    $pamount = $row['Prod_amount'];

                 if ($row['Remain'] !=='off') {
                      $totalrem =$row['Remain'];
                                       }
                         if ($row['Returned'] !=='off'  && is_numeric($row['Returned'])) {
                           $totalrer =$row['Returned']; }

           
}  ;

                   ?> 
                    <ul class="list-group">
                        <h3  class="lead" style="font-family: timenewroman; font-size: 27px; font-weight: bolder;"><?php if ($yesterday) { echo "yesterday sheeet for <span class='text-primary'>".$name." of ".$size."</span>"; } ?> --- <span class="text-info">&nbsp;Producer&nbsp;&nbsp;</span><?php $empid = $row['Supplier'];
                                    $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last;?></h3>
                      <li class="list-group-item text-info today" style="">peices produced <span class="label label-success pull-right"><?php echo  $peices; ?></span> </li>
                        <li class="list-group-item text-info today">Price per peices <span class="label label-success pull-right"><?php echo     number_format($price, 2); ?></span></li>
                        <li class="list-group-item text-info today">Total price <span class="label label-success pull-right"><?php echo number_format($pamount,2); ?></span></li>
                          <li class="list-group-item text-info today">Total Remain<span class="label label-success pull-right"><?php echo $totalrem; ?></span></li>
                           <li class="list-group-item text-info today">Update peices<span class="label label-success pull-right"><?php   echo (!empty($updatep)) ? $updatep : 0;   ?></span></li>
                          <li class="list-group-item text-info today">Total Returnd <span class="label label-success pull-right"><?php echo (!empty($totalrer)) ? $totalrer : 0;  ?></span></li>

                          <li class="list-group-item  text-info today">
                            <?php 
                  $sql =$conn->query("SELECT COUNT(*) FROM supply  where Prod_name='$name' and Prod_size='$size' and Date='$yesterday' and Status='off' and Payment='off'");
                  $row = $sql->fetch();
                 $arrsifht = array_shift($row);
                 $numrow = $sql->rowCount();

                            ?>
                             Total unpaid offer<span class="label label-success pull-right"><?php echo ceil($arrsifht); ?></span>
                          </li>  <?php }else{ ?>
                            <br><h3  class='lead text-danger'> seem this product was not  added to production bulk yesterday.</h3>
                            <br>
                          <?php }?>
                       
                        </ul><hr>
                                              <?php   
        $totalrer =0;
         $totalrem =0;
                         $sql =$conn->query("SELECT * FROM production LEFT JOIN supply ON  production.Prod_name =supply.Prod_name AND production.prod_size = supply.Prod_size   where production.Prod_name='$name' and production.Prod_size='$size' and Datetimes='$daysago'");
                         if ($sql->rowCount() > 0) {
                          
                  while ($row = $sql->fetch()) {
                 $pname = $row['Prod_name'];
                 $psize = $row['prod_size'];
                  $ppeices = $row['Prod_peices'];
                    $pprice = $row['Prod_price'];
                    $tamount =  $row['Prod_amount'];
                 if ($row['Remain'] !=='off') {
                      $totalrem +=$row['Remain'];
                                       }
                         if ($row['Returned'] !=='off'  && is_numeric($row['Returned'])) {
                           $totalrer +=$row['Returned']; }

           
}  ;

                   ?> 
                    <ul class="list-group">
                        <h3  class="lead" style="font-family: timenewroman; font-size: 27px; font-weight: bolder;"><?php if ($date) { echo "2 days ago  sheeet for <span class='text-primary'>".$name." of ".$size."</span>"; } ?> --- <span class="text-info">&nbsp;Producer&nbsp;&nbsp;</span><?php $empid = $row['Supplier'];
                                    $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");$STH = $sql->execute();$prow = $sql->fetch();$first = $prow['firstname'];$last = $prow['lastname'];
                                  echo  $addedby = $first.$last;?></h3>
                      <li class="list-group-item text-info today" style="">peices produced <span class="label label-success pull-right"><?php echo  $row['Prod_peices']?></span> </li>
                       <li class="list-group-item text-info today">Price per peices <span class="label label-success pull-right"><?php echo   number_format($row['Prod_price'], 2 )?></span></li>
                        <li class="list-group-item text-info today">Total price <span class="label label-success pull-right"><?php echo number_format($row['Prod_amount'], 2); ?></span></li>

                          <li class="list-group-item text-info today">Total Remain<span class="label label-success pull-right"><?php echo $totalrem; ?></span></li>
                          <li class="list-group-item text-info today">Total Returnd <span class="label label-success pull-right"><?php if (empty($totalrer)) { 
                           echo 0;
                         }else{echo  $totalrer; } ?></span></li>

                          <li class="list-group-item  text-info today">
                            <?php 
                  $sql =$conn->query("SELECT COUNT(*) FROM supply  where Prod_name='$name' and Prod_size='$size' and Date='$daysago' and Status='off' and Payment='off'");
                  $row = $sql->fetch();
                 $arrsifht = array_shift($row);
                 $numrow = $sql->rowCount();

                            ?>
                             Total unpaid offer<span class="label label-success pull-right"><?php echo ceil($arrsifht); ?></span>
                          </li>
                          <?php }else{ echo "<br><h3  class=' text-danger lead'> seem this product was not  added to production bulk 2days ago.<br></h3>";}?>
                       

                        </ul>

 <!--$ -->

           <?php }else{?>
          <ul class="list-group">
            <?php
            $time =time();
            $date =date('Y-m-d', $time);
            $obj = new DBH;
             $peices = 0;
             $remain =0;
        $obj= new Main;
                   $data = $obj->Read_record('product'); 
                   if ($data > 0) {
                    foreach ($data as $row) {
     $size =$row['P_size'];  $name = $row['P_name'];?>
             
                 <li class="list-group-item"><a href="salessheet.php?name=<?php echo $row['P_name'] ?>&&size=<?php echo $row['P_size'] ?>"><?php echo $name ?> .............<?php echo  $size ?> &nbsp;&nbsp;&nbsp;<span class="label label-primary">view</span>
<?php 

    $sql =$conn->query("SELECT * FROM production WHERE  Prod_name='$name'  AND Prod_size ='$size' and Datetimes ='$date'");
                 while ($row = $sql->fetch()) { 
                $peices =$row['Prod_peices'];
              $remain =$row['Remain'];
                 }

$percent = progressbar($peices,$remain);?>
             <div class="pull-center ">
                    <div class="prodiv">
                     <div class="progressbar" style="background-color: green; margin: 0px;  width:<?php echo $percent; ?>">
                        <span class="text-default" style="text-align: center; margin-left: 68px;"><?php echo $percent; ?></span>
                     </div>
                  </div>
              </div>
 <span class="label label-success pull-right" style="margin-top: -25px; padding: 10px; border-radius: 10px;">  <?php echo (!empty($remain)) ? $remain : 0;?></span></a>  </li> <?php } }?> </ul> <?php } ?>

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

  $('.list-group-item').hover(function(e){
    e.preventDefault();
     var eye = $("#eye").css('color','red');;
  });
  $('.list-group-item').mouseleave(function(e){
    e.preventDefault();
     var eye = $("#eye").css('color','blue');;
  });
});

</script>

</body>
</html>
