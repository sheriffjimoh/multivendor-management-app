<?php
 include '../login.php';
  

$obj=new DBH;
$conn= $obj->Connect();
 $obj = new Main;
     $date=NOW();
         $addedby= $_SESSION['USeR_id'];
     // $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");
     //   $STH = $sql->execute();
     //   $row = $sql->fetch();
     //     $first = $row['firstname'];
     //     $last = $row['lastname'];
     //    $empid   = $first.$last;
    

              // process store item 
    
         $item_name = $_POST['item_name'];
		$item_type = $_POST['item_type'];
		$item_amount = $_POST['item_amount'];
		$quantity = $_POST['quantity'];
		$measure = $_POST['measure'];
		$size = $_POST['size'];
		$exp_date = $_POST['exp_date'];

     	$value_store = array('Item_name' =>':item_name', 'Item_type' =>':item_type', 'Item_amount' =>':item_amount', 'Quantity' =>':quantity', 'Size' =>':size',  'Measure' =>':measure','Exp_date' =>':exp_date', 'Datetimes' =>':datetimes' , 'Addedby' =>':addedby');
 
$execute_store =array(':item_name' =>$item_name,':item_type' =>$item_type ,':item_amount' =>$item_amount, ':quantity' =>$quantity ,':size' =>$size, ':measure' =>$measure,':exp_date' =>$exp_date, ':datetimes' =>$date ,':addedby' =>$addedby );
     if(isset($_POST['add_store'])){
 


              $sql=$conn->query("SELECT  * FROM item WHERE  Item_name= '$item_name' and  Category='$item_type'");
               $row = $sql->fetch();
              if ($row >  0) {
     header("location:".base_url("stock/history.php"));
   $_SESSION['error']=  "oops! item with this name and category doesnot  exist";
            }else{

                 $sql=$conn->query("SELECT  * FROM store WHERE  Item_name= '$item_name' and  Item_type='$item_type' and Status='on'");
               $row = $sql->fetch();
              if ($row > 0) {
               $qty =  $row['Quantity'];
               $remain =$row['Remain'];
               if ($remain =='off') {
                $newremain ='off';
                 $newQuantity = $qty +  $quantity;
               }else{
               $newremain =  $quantity + $remain;
               $newQuantity = $qty +  $quantity;}
   $sql="UPDATE store  SET  Quantity =:quantity, Remain=:remain, Size=:size, Item_amount=:item_amount,  Exp_date =:exp_date, Datetimes=:datetimes, Addedby=:addedby WHERE Item_name =:item_name and Item_type =:item_type and Status='on'  ";
 
  $execute_store =array(':item_name' =>$item_name, ':item_type' =>$item_type ,':remain' =>$newremain,':item_amount' =>$item_amount, ':quantity' =>$newQuantity ,':size' =>$size,':exp_date' =>$exp_date, ':datetimes' =>$date ,':addedby' =>$addedby );
    $STH=$conn->prepare($sql);
  $result= $STH->execute($execute_store);
  header("location:".base_url("stock/history.php"));
    $_SESSION['success'] = "Stock updated successful";
   }else{

   $insert = $obj->Insert_record('store',$value_store,$execute_store);

if ($insert) {
	 header("location:".base_url("stock/history.php"));
		$_SESSION['success'] = "Got New Item To The Store";

}else { 
	
 header("location:".base_url("stock/history.php"));
   $_SESSION['error']=  "something went wrong!";
}   
    }
        }
}elseif (isset($_POST['update_store'])) {

 	$id = $_POST['id'];
 	// update store 
 	$sql="UPDATE store  SET  Item_name =:item_name, Item_type =:item_type, Item_amount =:item_amount, Quantity =:quantity,  Size =:size,  Measure=:measure, Exp_date =:exp_date, Datetimes=:datetimes, Addedby=:addedby WHERE id =".$id;
 
 	$execute_store =array(':item_name' =>$item_name,':item_type' =>$item_type ,':item_amount' =>$item_amount, ':quantity' =>$quantity ,':size' =>$size, ':measure' =>$measure,':exp_date' =>$exp_date, ':datetimes' =>$date ,':addedby' =>$addedby );
 	  $STH=$conn->prepare($sql);
 	$result= $STH->execute($execute_store);
  $result;
 	if ($result) {
     header("location:".base_url("stock/store.php"));
		$_SESSION['success'] = "1 item updated  successful";
 	}else{
 		header("location:".base_url("stock/store.php"));
       $_SESSION['error']=  "something went wrong!";
 	}

 }







       /// new item 
 


         $item = $_POST['item_name'];
		$category = $_POST['category'];
     	$value_item = array('Item_name' =>':item_name', 'Category' =>':category',  'Datetimes' =>':datetimes' , 'Addedby' =>':addedby');
  
$execute_item =array(':item_name' =>$item , ':category' =>$category ,':datetimes' =>$date ,':addedby' =>$addedby );
  // print_r($execute_item);
     if(isset($_POST['add_item'])){
   // grab connection
 $obj = new Main;
$conn= $obj->Connect();

              $sql=$conn->query("SELECT  * FROM item WHERE  Item_name= '$item'");
               $row = $sql->fetch();
              if ($row >  0) {
    header("location:".base_url("staff/item.php"));
   $_SESSION['error']=  "oops! item with this name already exist";


              }else{



   $insert = $obj->Insert_record('item',$value_item,$execute_item);
if ($insert) {
		header("location:".base_url("staff/item.php"));
		$_SESSION['success'] = "1 more item added successful";

}else {
	
   header("location:".base_url("staff/item.php"));
   $_SESSION['error']=  "something went wrong!";
} }

}elseif (isset($_POST['update_item'])) {

 	$id = $_POST['id'];
 	// update store 
 	$sql="UPDATE item  SET  Item_name =:item_name, Category =:category,  Datetimes =:datetimes , Addedby =:addedby WHERE id =".$id;
 $execute_item =array(':item_name' =>$item , ':category' =>$category ,':datetimes' =>$date ,':addedby' =>$addedby );
 	  $STH=$conn->prepare($sql);
 	$result= $STH->execute($execute_item);
  echo  $result;
 	if ($result) {
      header("location:".base_url("staff/item.php"));
		$_SESSION['success'] = "1 item updated  successful";
 	}else{
 		  header("location:".base_url("staff/item.php"));
   $_SESSION['error']=  "something went wrong!";
 	}

 }






    // daily item use      


                $item = $_POST['item_name'];
  echo  $quantity = $_POST['quantity'];
    $sizedaily = $_POST['size'];

     if(isset($_POST['add_daily_item'])){
                         if ($sizedaily =="bag") {
                           $quantity = $_POST['quantity'];
                       }elseif ($sizedaily=="h-bag") {
                           $quantity = $_POST['quantity']/2;
                       }elseif ($sizedaily=="q-bag") {
                          $quantity = $_POST['quantity']/3;
                       }elseif ($sizedaily=="p-rubber") {
                         $quantity=$_POST['quantity']/6;
                       }elseif ($sizedaily=="shachet") {
                           $quantity =$_POST['quantity']/8;
                       }elseif ($sizedaily=="tin") {
                           $quantity = $_POST['quantity']/10;
                       }
                       $value__daily_item = array('Item_name' =>':item_name', 'Quantity' =>':quantity', 'size' =>':size', 'Datetimes' =>':datetimes' , 'Addedby' =>':addedby');
$execute_daily_item =array(':item_name' =>$item , ':quantity' =>$quantity ,':size' =>$sizedaily ,':datetimes' =>$date ,':addedby' =>$addedby );
                       $objdb = new DBH;
                $conn= $objdb->Connect();
                    $total = 0;
             $sql=$conn->query("SELECT * FROM store WHERE  Item_name= '$item' AND Status='on'");
               
                 $row= $sql->rowCount();
                 if ( $row > 0) {
                                
                    while($value = $sql->fetch()){
                      $Remain = $value['Remain'];
                      $status = $value['Status'];
                      $qty = $value['Quantity'];
                       $item_name = $value['Item_name'];
                  
                       $total += $qty;

             } 
             echo "total quantity in the store : ".ceil($total)."<br>";
             echo  "quantity new daily quantity :" .ceil($quantity). "<br>";
             $counttotal = $total-$quantity;
            echo "total remain value : ". ceil($counttotal);


 $sql=$conn->query("SELECT * FROM store WHERE  Item_name='$item' AND Status='on' ");
                           while($value = $sql->fetch()){
                      echo $Remainoff = $value['Remain'];
                      echo $Remainoff = $value['Quantity'];}

if ($Remain == 'off') {

  if ($quantity > $total) {
      header("location:". base_url("stock/daily.php"));
          echo $_SESSION['error']=  "oops! sems item in the store not upto that!";

   }else if ($Remainoff == 0) {
       header("location:". base_url("stock/daily.php"));
   echo  $_SESSION['error']=  "no item in the store!";

   } else {
   

    $sql="UPDATE store  SET  Remain =:remain  WHERE Item_name = '$item' AND Status='on'";
 $execute_item =array(':remain' =>ceil($counttotal)  );
    $STH=$conn->prepare($sql);
  $result= $STH->execute($execute_item);
if ($result) {
  $insert = $obj->Insert_record('daily',$value__daily_item,$execute_daily_item);

 header("location:". base_url("stock/daily.php"));
    $_SESSION['success'] = "1 more item added successful";

}else {
  
 header("location:". base_url("stock/daily.php"));
   $_SESSION['error']=  "something went wrong!";
} 
   }


            } else if ( $quantity < $Remain  &&  $status =='on'  ) {

             
   $sql=$conn->query("SELECT * FROM store WHERE  Item_name= '$item' AND Status='on'");
    while($value = $sql->fetch()){$Remain = $value['Remain'];}
      $counttotal = $Remain-$quantity;
    $sql="UPDATE store  SET  Remain =:remain WHERE Item_name = '$item' AND Status='on'";
     $execute_item =array(':remain' =>ceil($counttotal) );
    $STH=$conn->prepare($sql);
    $result= $STH->execute($execute_item);
  

if ($result) {
  $insert = $obj->Insert_record('daily',$value__daily_item,$execute_daily_item);

    header("location:". base_url("stock/daily.php"));
    $_SESSION['success'] = "1 more item added successful";

}else {
  header("location:". base_url("stock/daily.php"));
   $_SESSION['error']=  "something went wrong!";
} 
   

            }elseif ( $quantity > $Remain) {

  header("location:". base_url("stock/daily.php"));
  $_SESSION['error']=  "oops!  seems item remain not upto that  !";   

 

            }else if ($Remain == $quantity) {

     $sql="UPDATE store  SET  Remain =:remain , Status='off' WHERE Item_name = :item AND Status=:status";
     $execute_item =array(':remain' =>0 ,':status' =>'on' , ':item' =>$item  );
    $STH=$conn->prepare($sql);
  $result= $STH->execute($execute_item);

if ($result) {
  $insert = $obj->Insert_record('daily',$value__daily_item,$execute_daily_item);
   header("location:". base_url("stock/daily.php"));
    $_SESSION['success'] = "1 more item added successful";
      }else {
   header("location:". base_url("stock/daily.php"));
   $_SESSION['error']=  "something went wrong!";}
 
   }


    }else{                  


   header("location:". base_url("stock/daily.php"));
      $_SESSION['error']=  "no item in the store !";  

   }
}






 //add product ....
                         


       $p_name = $_POST['p_name'];
		   $p_size = $_POST['p_size'];
       $p_price = number_format($_POST['p_price'],2);
     	$value_item = array('P_name' =>':p_name', 'P_size' =>':p_size',  'Datetimes' =>':datetimes' , 'P_price' =>':p_price');
  
$execute_item =array(':p_name' =>$p_name , ':p_size' =>$p_size ,':p_price' =>$p_price , ':datetimes' =>$date);
  // print_r($execute_item);
     if(isset($_POST['add_product'])){
   // grab connection
 
              $sql=$conn->query("SELECT  * FROM product WHERE  P_name= '$p_name' AND P_price ='$p_price'");
               $num = $sql->fetch();
               
              if ($num >  0) {
    header("location:".base_url("staff/product.php"));
   $_SESSION['error']=  "oops! product with this name and price already exist";


              }else{



   $insert = $obj->Insert_record('product',$value_item,$execute_item);
if ($insert) {
		header("location:".base_url("staff/product.php"));
		$_SESSION['success'] = "1 more item added successful";

}else {
	header("location:".base_url("staff/product.php"));
   $_SESSION['error']=  "something went wrong!";
} }

}elseif (isset($_POST['update_product'])) {

 	$id = $_POST['id'];
 	// update store 
 	$sql="UPDATE product  SET  P_name =:p_name, P_price =:p_price,  P_size=:p_size, Datetimes=:datetimes WHERE id =".$id;
$execute_item =array(':p_name' =>$p_name , ':p_size' =>$p_size ,':p_price' =>$p_price , ':datetimes' =>$date);
 	  $STH=$conn->prepare($sql);
 	$result= $STH->execute($execute_item);
  echo  $result;
 	if ($result) {
     header("location:".base_url("staff/product.php"));
		$_SESSION['success'] = "1 item updated  successful";
 	}else{
 		 header("location:".base_url("staff/product.php"));
   $_SESSION['error']=  "something went wrong!";
 	}

 }











         //add production......

echo $date = NOW();
     if(isset($_POST['add_prod'])){

          $pname = $_POST['prod_name'];
           $prods_size = $_POST['prod_size'];
           $p_peicies = $_POST['prod_peices'];
         $sql=$conn->query("SELECT  * FROM product WHERE  P_name='$pname' and P_size='$prods_size'");
               $row = $sql->fetch();
              
     if ($row >  0){
              $price = $row['P_price'];
              $amount =  $p_peicies * $price;
            
           $sql=$conn->query("SELECT  * FROM production  WHERE  Prod_name='$pname' and Prod_size='$prods_size' ");
          $numrow =$sql->rowCount();
                   while($value = $sql->fetch()){
                      $proremain = $value['Remain'];
                         echo  $pupdate = $value['update_peices'];
                    echo  $total += $proremain;
                     echo  $update =$p_peicies+$pupdate ;}//closing loop. 


              if ($total > 0) {
                 // update production
                $totalall = $total+$p_peicies;
$sql=$conn->prepare("UPDATE production  SET  Remain =:remain, update_date=:dates, Addedby =:addedby, update_peices='$update' WHERE  prod_name=:p_name and  Prod_size=:p_size ");
$execute =array(':remain' =>$totalall, ':dates' =>$date, ':p_name' =>$pname , ':addedby' =>$addedby ,':p_size' =>$prods_size );
           $result =$sql->execute($execute); 

          if ($result) {
        
   
       header("location:".base_url("producer/add.php"));
           $_SESSION['success'] = "production updated  successful";} //closing result

         }else{

  $value_item = array('Prod_name' =>':p_name', 'Prod_size' =>':p_size', 'Prod_peices' =>':p_peices','Prod_price' =>':p_price', 'Prod_amount' =>':p_amount', 'Datetimes' =>':datetimes'  ,'Remain' =>':remain',  'Addedby' =>':addedby' );  
  $execute_item =array(':p_name' =>$pname , ':p_size' =>$prods_size,':p_peices' =>$p_peicies, ':p_amount' =>$amount ,':addedby' =>$addedby, ':p_price' =>$price, ':datetimes' =>$date , ':remain' =>$p_peicies);
      echo "string";
$insert = $obj->Insert_record('production',$value_item,$execute_item);
if ($insert) {
  header("location:".base_url("producer/add.php"));
    $_SESSION['success'] = "1 more production added successful";

}else {
  
 header("location:".base_url("producer/add.php"));
   $_SESSION['error']=  "something went wrong!";
} 
       }
               }else{
        header("location:".base_url("producer/add.php"));
   $_SESSION['error']=  "oops! product with this name and size not  exist";
 }
       
  
   
}elseif (isset($_POST['update_production'])) {

  $id = $_POST['id'];


   $p_name = $_POST['prod_name'];
           $p_size = $_POST['prod_size'];
           $p_peicies = $_POST['prod_peices'];
        
$sql=$conn->query("SELECT  * FROM product WHERE  P_name='$p_name' and P_size='$p_size'");
               $row = $sql->fetch();
               // print_r($row);
     if ($row >  0){
         $price = $row['P_price'];
              $amount =  $p_peicies * $price;
      echo "string";
                // update production
  $sql="UPDATE production  SET  Prod_name =:p_name, Prod_price = :p_price,  prod_size =:p_size, Prod_peices =:p_peices,  Datetimes =:datetimes, Prod_amount=:p_amount, Addedby=:addedby , Remain=:remain   WHERE id =" .$id;
  print_r($sql);
 $execute_item =array(':p_name' =>$p_name, ':remain'=>$p_peicies,':p_size'=>$p_size, ':p_peices' =>$p_peicies, ':p_amount' =>$amount, ':addedby' =>$addedby, ':p_price' =>$price, ':datetimes' =>$date);
    $STH=$conn->prepare($sql);
  $result= $STH->execute($execute_item);

  if ($result) {
  header("location:".base_url("producer/unclear.php"));
          $_SESSION['success'] = "1 item updated  successful";
  }else{
  header("location:".base_url("producer/unclear.php"));
   $_SESSION['error']=  "something went wrong!";
  }  

}else{
  echo "string";
header("location:".base_url("producer/unclear.php"));
   $_SESSION['error']=  "oops! product with this name and size not  exist";}}








//   /// add   supply
  if(isset($_POST['add_supply'])){
              
             $prods_size =   $_POST['prod_size'];
           $pname =  $_POST['prod_name'] ;
         $peices =   $_POST['prod_peices'];
             $sql=$conn->query("SELECT  * FROM product WHERE  P_name='$pname'");
          while ($row = $sql->fetch()) {
                   $price = $row['P_price'];
              $amount =  $peices * $price;
          echo  $amount = number_format($amount, 2);  }
    
      $value_item = array('Prod_name' =>':p_name','Prod_price' =>':p_price', 'Prod_size' =>':p_size',  'Prod_peices' =>':p_peices', 'Total' =>':p_amount', 'Date' =>':datetimes'  ,  'Supplier' =>':addedby' );  
  
     $execute_item =array(':p_name' =>$pname  ,':p_size' => $prods_size, ':p_price' => $price, ':p_peices' => $peices, ':p_amount' =>$amount ,':addedby' =>$addedby,':datetimes' =>$date);

   $insert = $obj->Insert_record('supply',$value_item,$execute_item);
if ($insert) {
    header("location:".base_url("staff/supply.php"));
    $_SESSION['success'] = "1 more item added successful";

}else {
  
   header("location:".base_url("staff/supply.php"));
   $_SESSION['error']=  "something went wrong!";
} 
          
}
  












      




       


                    //user account 

             if (isset($_POST['add_staff_acct'])) {
           $user_id=$_POST['user-id'];
           $user_name=$_POST['user-name'];
           $password=$_POST['password'];
           $cpassword=$_POST['cpassword'];
        $usertype=$_POST['usertype'];

         $sql=$conn->query("SELECT  * FROM employees WHERE employee_id='$user_id' ");
        $rowcount  = $sql->fetch();
     
          echo "string";    
              if ($rowcount > 0) {
                 $sql=$conn->query("SELECT  * FROM  panel WHERE User_id='$user_id'");
        $rowcount  = $sql->fetch();
      if ($rowcount > 0) {
           header("location:".base_url("staff/staff-admin.php"));
          $_SESSION['error']=  "sorry,user with this account alread exist!";
      } else if ($cpassword !== $password) {
           header("location:".base_url("staff/staff-admin.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{

      $value_item = array('user_id' =>':user_id' , 'Username' =>':username', 'Password' =>':password' , 'User_type' =>':user_type');  
  
     $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' => $usertype);
  
   $insert = $obj->Insert_record('panel',$value_item,$execute_item);

     header("location:".base_url("staff/staff-admin.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
            }else{
                 
                   header("location:".base_url("staff/staff-admin.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";
                     }
                                                       
  }






   if (isset($_POST['add_admin_acct'])) {
           $user_id=$_POST['user-id'];
           $user_name=$_POST['user-name'];
           $password=$_POST['password'];
           $cpassword=$_POST['cpassword'];
        $usertype=$_POST['usertype'];

         $sql=$conn->query("SELECT  * FROM employees WHERE employee_id='$user_id' ");
        $rowcount  = $sql->fetch();
     
              
              if ($rowcount > 0) {
                 $sql=$conn->query("SELECT  * FROM  panel WHERE User_id='$user_id'");
        $rowcount  = $sql->fetch();
      if ($rowcount > 0) {
           header("location:".base_url("staff/super-admin.php"));
          $_SESSION['error']=  "sorry,user with this account alread exist!";
      } else if ($cpassword !== $password) {
           header("location:".base_url("staff/super-admin.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{

      $value_item = array('user_id' =>':user_id' , 'Username' =>':username', 'Password' =>':password' , 'User_type' =>':user_type');  
  
     $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' => $usertype);
  
   $insert = $obj->Insert_record('panel',$value_item,$execute_item);

    header("location:".base_url("staff/super-admin.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
            }else{
                 
                    header("location:".base_url("staff/super-admin.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";
                     }
                                                       
  }
 
 

















          //user account 

             if (isset($_POST['add_supp_acct'])) {
           $user_id=$_POST['user-id'];
           $user_name=$_POST['user-name'];
           $password=$_POST['password'];
           $cpassword=$_POST['cpassword'];
        $usertype=$_POST['usertype'];

         $sql=$conn->query("SELECT  * FROM employees WHERE employee_id='$user_id' ");
        $rowcount  = $sql->fetch();
     
              
              if ($rowcount > 0) {
                 $sql=$conn->query("SELECT  * FROM  panel WHERE User_id='$user_id'");
        $rowcount  = $sql->fetch();
      if ($rowcount > 0) {
           header("location:".base_url("staff/Supplier.php"));
          $_SESSION['error']=  "sorry,user with this account alread exist!";
      } else if ($cpassword !== $password) {
           header("location:".base_url("staff/Supplier.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{

      $value_item = array('user_id' =>':user_id' , 'Username' =>':username', 'Password' =>':password' , 'User_type' =>':user_type');  
  
     $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' => $usertype);
  
   $insert = $obj->Insert_record('panel',$value_item,$execute_item);

    header("location:".base_url("staff/supplier.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
            }else{
                 
                   header("location:".base_url("staff/Supplier.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";
                     }
                                                       
  
    } 



///update user account

     if (isset($_POST['update_supplier'])) {
       $user_id=$_POST['user-id'];
           $user_name=$_POST['user-name'];
           $password=$_POST['password'];
           $cpassword=$_POST['cpassword'];
          $id=$_POST['id'];
          $usertype=$_POST['usertype'];

         $sql=$conn->query("SELECT  * FROM employees WHERE employee_id='$user_id' ");
        $rowcount  = $sql->fetch();
     
              
              if ($rowcount <  0) {
               
            header("location:".base_url("staff/Supplier.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";

      } else if ($cpassword !== $password) {
           header("location:".base_url("staff/Supplier.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{
  

    
 $sql="UPDATE panel  SET user_id =:user_id, Username =:username, Password=:password , User_type =:user_type   WHERE id =" .$id;
  print_r($sql);
  $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' =>$usertype);
      $STH=$conn->prepare($sql);
  $result= $STH->execute($execute_item);

    header("location:".base_url("staff/supplier.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
         
         }

       ?>



