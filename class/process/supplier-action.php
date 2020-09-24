<?php 


require '../controller.php';
  
 $addedby= $_SESSION['USeR_id'];


  $date = NOW();
  $obj = new Main;
$conn= $obj->Connect();

           




//   /// add   supply
if(isset($_POST['add_supply'])){ 

    $prods_size =   $_POST['prod_size'];
           $pname =  $_POST['prod_name'] ;
        $peices =   $_POST['prod_peices'];
       $total = 0;

     
   $sql=$conn->query("SELECT  * FROM product  WHERE  P_name='$pname' and P_size='$prods_size'");
          $prodrow =$sql->fetch();
         if ($sql->rowCount() > 0) {
             $price = $prodrow['P_price'];
              $amount =  $peices * $price;
            $amount;


          $sql=$conn->query("SELECT  * FROM production  WHERE  Prod_name='$pname' and prod_size='$prods_size' and Datetimes='$date'");
          $numrow =$sql->rowCount();
          if ($numrow > 0) { 
                  while ($value = $sql->fetch()) {
                                       $proremain = $value['Remain'];
                    $total += $proremain;
    }
              // echo   $total; 
              echo "<br>"; 
             // echo    $peices;
            $remainpieces = $total - $peices;
             if ($value['Status'] =='off') {
                      header("location:".base_url("supplier/outgoing.php"));
                   $_SESSION['error']=  "oops: this product is underclearance , you can only book product that is  cleared, please wait some minute ";
                           }else{
   
 if ( $peices < $total) {
    
         $sql=$conn->prepare("UPDATE production  SET  Remain=:remain   WHERE Prod_name=:p_name AND prod_size=:p_size and Datetimes='$date'");
            $update =array(':remain' =>$remainpieces, ':p_name' =>$pname, ':p_size' =>$prods_size);
              $result =$sql->execute($update); 
             //
          if ($result) {
   
              $sqln=$conn->query("SELECT  * FROM supply  WHERE  Prod_name='$pname' and Prod_size='$prods_size' and Supplier='$addedby' and Status='off' ");
          $numrow =$sqln->rowCount();
          if ($numrow > 0) { 
                   $peices;
                     $value =$sqln->fetch();
                     
                   $propremain = $value['Prod_peices'];
                      $tpeceis = $propremain+$peices;
                       echo $tpeceis ;
                      $neamount =  $tpeceis *$price; 
                       $amount;
                        echo "<br>"; 
                         $totalaamount = $neamount+$amount;
                         echo $totalaamount;


       $sql=$conn->prepare("UPDATE supply  SET  Prod_peices=:tpeceis , Total=:totalaamount , Status='off', Payment='off'  WHERE  Prod_name=:p_name and Prod_size=:p_size and Supplier=:addedby and Status='off' AND  Payment='off'");
    $update =array( ':p_name' =>$pname, ':p_size' =>$prods_size, ':tpeceis' =>$tpeceis,':totalaamount' =>$totalaamount,  ':addedby' =>$addedby );
           
              $result =$sql->execute($update);
              if ($result) {
               echo $_SESSION['success'] = "book updated successful ,  kindly  meet any of our staff for visual clearification";
                header("location:".base_url("supplier/outgoing.php")); 
             }  
              }else{ 
   echo  $price = $prodrow['P_price'];
$value_insert = array('Prod_name' =>':p_name','Prod_price' =>':p_price', 'Prod_size' =>':p_size',  'Prod_peices' =>':p_peices', 'Total' =>':p_amount', 'Date' =>':datetimes'  ,  'Supplier' =>':addedby' );  
  
         $execute_insert =array(':p_name' =>$pname ,':p_size' => $prods_size, ':p_price' =>$price, ':p_peices' => $peices, ':p_amount' =>$amount ,':addedby' =>$addedby, ':datetimes' =>$date);
       print_r($execute_insert);
         $insert = $obj->Insert_record('supply',$value_insert, $execute_insert);
          header("location:".base_url("supplier/outgoing.php"));  

           $_SESSION['success'] = "booked successful ,  kindly  meet any of our staff for visual clearification";} }

 }elseif ($peices == $total) {
            $sql=$conn->prepare("UPDATE production  SET  Remain =:remain WHERE prod_name=:p_name and  Prod_size=:p_size and Datetimes='$date'");
            $execute_item =array(':remain' =>0, ':p_name' =>$pname, ':p_size' =>$prods_size  );
           $result =$sql->execute($execute_item); 
                  if ($result) {
   
    $sql=$conn->query("SELECT  * FROM supply  WHERE  Prod_name='$pname' and Prod_size='$prods_size' and Supplier='$addedby' and Status='off'");
       $numrow =$sql->rowCount();
       if ($numrow > 0) { 
                  
                     while($value = $sql->fetch()){
                     $propremain = $value['Prod_peices'];
                     $tpeceh = $propremain+$peices;
                     echo  $amount =  $tpeceh *$price;}    
                          $tpeceh;
   $sqlpre=$conn->prepare("UPDATE supply  SET  Prod_peices=:p_peices , Total=:amount  WHERE  Prod_name='$pname' and Prod_size='$prods_size' and Supplier='$addedby' and Status='off'");
            $update =array(':amount' =>$amount, ':p_peices' =>$tpeceh);
            
            $result =$sqlpre->execute($update);
                   header("location:".base_url("supplier/outgoing.php"));
               $_SESSION['success'] = "book updated successful ,  kindly  meet any of our staff for visual clearification";
              }else{ 

             $value_insert = array('Prod_name' =>':p_name','Prod_price' =>':p_price', 'Prod_size' =>':p_size',  'Prod_peices' =>':p_peices', 'Total' =>':p_amount', 'Date' =>':datetimes'  ,  'Supplier' =>':addedby' );  
  
         $execute_insert =array(':p_name' =>$pname ,':p_size' => $prods_size, ':p_price' => $price, ':p_peices' => $peices, ':p_amount' =>$amount ,':addedby' =>$addedby, ':datetimes' =>$date);

         $insert = $obj->Insert_record('supply',$value_insert, $execute_insert);
          header("location:".base_url("supplier/outgoing.php"));  

           $_SESSION['success'] = "booked successful ,  kindly  meet any of our staff for visual clearification";}}
}elseif ( $total ==0) {
           
           header("location:".base_url("supplier/outgoing.php"));
        $_SESSION['error']=  "oops: seems ".$pname." of ".$prods_size."  as finished , try choose other size!";
}elseif ($peices > $total) {
           
           header("location:".base_url("supplier/outgoing.php"));
        $_SESSION['error']=  "oops! seems ".$pname." of ".$prods_size."  remain not upto that , try choose less!";
          }
                   
 }
      } else{

         header("location:".base_url("supplier/outgoing.php"));
        $_SESSION['error']=  "oops! seems product  remain not upto that , try choose some other product !";
      } 
      } else{
  header("location:".base_url("supplier/outgoing.php"));
        $_SESSION['error']=  "oops: seems ".$pname." of ".$prods_size."  not exist  , try choose other size with this product!";
         }
  
}

