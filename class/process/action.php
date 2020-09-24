<?php
 include '../login.php';
	
ob_start();
$obj=new DBH;
$conn= $obj->Connect();
 $obj = new Main;
     $date=NOW();
         $addedby = $_SESSION['USeR_id'];




	// error_reporting(false);
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		$filename = $_FILES['photo']['name'];
     $filetype1 = $_FILES['photo']['type'];


      //guarantor 

      $gfname = $_POST['gfname'];
      $gprofession = $_POST['gprofession'];
      $gaddress = $_POST['gaddress'];
      $gphone = $_POST['gphone'];
      $filename2 = $_FILES['gphoto']['name'];
    echo   $filetype2 = $_FILES['gphoto']['type'];
			//creating employeeid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$employee_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
  if(!empty($filename) && !empty($filename2)){
       $base = '../../images/';
      move_uploaded_file($_FILES['photo']['tmp_name'], $base.$filename);  
      move_uploaded_file($_FILES['gphoto']['tmp_name'], $base.$filename2);  
    }

	$value = array('employee_id' =>':employee_id','firstname' =>':firstname' ,'lastname' =>':lastname', 'address' =>':address' ,'birthdate' =>':birthdate', 'contact_info' =>':contact_info','gender' =>':gender', 'position_id' =>':position_id','schedule_id' =>':schedule_id','photo' =>':photo', 'created_on' =>':created_on','gFullname' =>':gfname', 'gProfession' =>':gprofession',  'gAddress' =>':gaddr', 'gPhone' =>':gphone', 'gPhoto' =>':gphoto',);

    $execute =array(':employee_id' =>$employee_id,':firstname' =>$firstname ,':lastname' =>$lastname, ':address' =>$address ,':birthdate' =>$birthdate, ':contact_info' =>$contact,'gender' =>$gender, ':position_id' =>$position,':schedule_id' =>$schedule,':photo' =>$filename, ':created_on' =>$date, ':gfname' =>$gfname,':gaddr' =>$gaddress,  ':gprofession' =>$gprofession, ':gphone' =>$gphone, ':gphoto' =>$filename2);
      print_r($execute);
     $arrimg = array("image/png","image/jpg","image/jpeg");
     if(isset($_POST['add_employee'])){

     if (!in_array($filetype1 ,  $arrimg) || !in_array($filetype2 ,$arrimg)) {
      
        header("location:".base_url("admin/employee.php"));
   $_SESSION['error']='this type image is not allowed  use "png" ,"jpeg" ,"jpg"!';
     }else{ 

          

if ($insert) {
  

		header("location:".base_url("admin/employee.php"));
		$_SESSION['success'] = "inserted successful";

}else {
	
   header("location:".base_url("admin/employee.php"));
   $_SESSION['error']=  "something went wrong!";
}
     }elseif (isset($_POST['update_employee'])) {

 	$id = $_POST['id'];
 	
 	$sql="UPDATE employees  SET   employee_id =:employee_id, firstname =:firstname ,lastname =:lastname, address =:address , birthdate =:birthdate, contact_info =:contact_info, gender =:gender, position_id =:position_id, schedule_id =:schedule_id, photo =:photo,  created_on =:created_on, gFullname =:gfname, gProfession=:gprofession, gAddress=:gaddr, gPhone=:gphone, gPhoto=:gphoto  WHERE id =".$id;
 	  $STH=$conn->prepare($sql);
 	$result= $STH->execute($execute);
  // echo  $result;
 	if ($result) {
    
      header("location:".base_url("admin/employee.php"));
		$_SESSION['success'] = "1 item updated  successful";
 	}else{
 		  header("location:".base_url("admin/employee.php"));
   $_SESSION['error']=  "something went wrong!";
 	}

 }


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
     header("location:".base_url("admin/store.php"));
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
header("location:".base_url("admin/store.php"));
    $_SESSION['success'] = "Stock updated successful";
   }else{

   $insert = $obj->Insert_record('store',$value_store,$execute_store);

if ($insert) {
 header("location:".base_url("admin/store.php"));
    $_SESSION['success'] = "Got New Item To The Store";

}else { 
  
header("location:".base_url("admin/store.php"));
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
   header("location:".base_url("admin/store.php"));
    $_SESSION['success'] = "1 item updated  successful";
  }else{
   header("location:".base_url("admin/store.php"));
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
$sql=$conn->query("SELECT  * FROM item WHERE  Item_name= '$item'");
               $row = $sql->fetch();
              if ($row >  0) {
    header("location:".base_url("admin/item.php"));
   $_SESSION['error']=  "oops! item with this name already exist";


              }else{



   $insert = $obj->Insert_record('item',$value_item,$execute_item);
if ($insert) {
		header("location:".base_url("admin/item.php"));
		$_SESSION['success'] = "1 more item added successful";

}else {
	
   header("location:".base_url("admin/item.php"));
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
      header("location:".base_url("admin/item.php"));
		$_SESSION['success'] = "1 item updated  successful";
 	}else{
 		  header("location:".base_url("admin/item.php"));
   $_SESSION['error']=  "something went wrong!";
 	}

 }










    // daily item use      
         $item = $_POST['item_name'];
	echo 	$quantity = $_POST['quantity'];
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
      header("location:". base_url("admin/daily.php"));
          echo $_SESSION['error']=  "oops! sems item in the store not upto that!";

   }else if ($Remainoff == 0) {
      header("location:". base_url("admin/daily.php"));
   echo  $_SESSION['error']=  "no item in the store!";

   } else {
   

    $sql="UPDATE store  SET  Remain =:remain  WHERE Item_name = '$item' AND Status='on'";
 $execute_item =array(':remain' =>ceil($counttotal)  );
 	  $STH=$conn->prepare($sql);
 	$result= $STH->execute($execute_item);
if ($result) {
	$insert = $obj->Insert_record('daily',$value__daily_item,$execute_daily_item);

		header("location:".base_url("admin/daily.php"));
		$_SESSION['success'] = "1 more item added successful";

}else {
	
   header("location:".base_url("admin/daily.php"));
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

		header("location:".base_url("admin/daily.php"));
		$_SESSION['success'] = "1 more item added successful";

}else {
	
   header("location:".base_url("admin/daily.php"));
   $_SESSION['error']=  "something went wrong!";
} 
   

            }elseif ( $quantity > $Remain) {
 
   	  header("location:".base_url("admin/daily.php"));
  $_SESSION['error']=  "oops!  seems item remain not upto that  !";   

 

            }else if ($Remain == $quantity) {

     $sql="UPDATE store  SET  Remain =:remain , Status='off' WHERE Item_name = :item AND Status=:status";
     $execute_item =array(':remain' =>0 ,':status' =>'on' , ':item' =>$item  );
 	  $STH=$conn->prepare($sql);
 	$result= $STH->execute($execute_item);

if ($result) {
	$insert = $obj->Insert_record('daily',$value__daily_item,$execute_daily_item);
		header("location:".base_url("admin/daily.php"));
		$_SESSION['success'] = "1 more item added successful";
      }else {
	 header("location:".base_url("admin/daily.php"));
   $_SESSION['error']=  "something went wrong!";}
 
   }


    }else{                 	


   header("location:".base_url("admin/daily.php"));
      $_SESSION['error']=  "no item in the store !";  

   }
}

  






                 ///add product ....

     if(isset($_POST['add_product'])){
  
              $sql=$conn->query("SELECT  * FROM product WHERE  P_name= '$p_name' AND P_price ='$p_price'");
               $num = $sql->fetch();  

              if ($sql->rowCount() >  0) {
    header("location:".base_url("admin/product.php"));
   $_SESSION['error']=  "oops! product with this name and price already exist";


              }else{

    $p_name = $_POST['p_name'];
         $p_size = $_POST['p_size'];
          $p_price =$_POST['p_price'];
      $value_item = array('P_name' =>':p_name', 'P_size' =>':p_size',  'Datetimes' =>':datetimes' ,'Addedby' =>':addedby', 'P_price' =>':p_price');
      $execute_item =array(':p_name' =>$p_name , ':p_size' =>$p_size ,':p_price' =>$p_price ,':addedby' =>$addedby, ':datetimes' =>$date);

   $insert = $obj->Insert_record('product',$value_item,$execute_item);
if ($insert) {
		header("location:".base_url("admin/product.php"));
		$_SESSION['success'] = "1 more item added successful";

}else {
	
   header("location:".base_url("admin/product.php"));
   $_SESSION['error']=  "something went wrong!";
} }

}elseif (isset($_POST['update_product'])) {


      $p_name = $_POST['p_name'];
         $p_size = $_POST['p_size'];
          $p_price = $_POST['p_price'];

 	$id = $_POST['id'];
 	// update store 
 	$sql="UPDATE product  SET  P_name =:p_name, P_price =:p_price,  P_size=:p_size, Datetimes=:datetimes, Addedby=:addedby WHERE id =".$id;
$execute_item =array(':p_name' =>$p_name , ':p_size' =>$p_size ,':p_price' =>$p_price ,':addedby' =>$addedby, ':datetimes' =>$date);

 	  $STH=$conn->prepare($sql);
 	$result= $STH->execute($execute_item);
   $result;
 	if ($result) {
      header("location:".base_url("admin/product.php"));
		$_SESSION['success'] = "1 item updated  successful";
 	}else{
 		  header("location:".base_url("admin/product.php"));
   $_SESSION['error']=  "something went wrong!";
 	}

 }



         //add production......

     if(isset($_POST['add_prod'])){

          $pname = $_POST['prod_name'];
           $prods_size = $_POST['prod_size'];
           $p_peicies = $_POST['prod_peices'];
         $sql=$conn->query("SELECT  * FROM product WHERE  P_name='$pname' and P_size='$prods_size'");
               $row = $sql->fetch();
              
     if ($row >  0){
              $price = $row['P_price'];
              $amount =  $p_peicies * $price;
              }else{
 header("location:".base_url("admin/production.php"));
   $_SESSION['error']=  "oops! product with this name and price not  exist";

              }

           $sql=$conn->query("SELECT  * FROM production  WHERE  Prod_name='$pname' and Prod_size='$prods_size'");
          $numrow =$sql->rowCount();
                   while($value = $sql->fetch()){
                      $proremain = $value['Remain'];
                         echo  $pupdate = $value['update_peices'];
                    echo  $total += $proremain;
                     echo  $update =$p_peicies+$pupdate ;}//closing loop. 


              if ($total > 0) {
                 // update production
                $totalall = $total+$p_peicies;
$sql=$conn->prepare("UPDATE production  SET  Remain =:remain, update_date=:dates, Addedby =:addedby, update_peices='$update' WHERE  prod_name=:p_name and  Prod_size=:p_size  and Datetimes ='$date'");
$execute =array(':remain' =>$totalall, ':dates' =>$date, ':p_name' =>$pname , ':addedby' =>$addedby ,':p_size' =>$prods_size );
           $result =$sql->execute($execute); 

          if ($result) {
        
   
          header("location:".base_url("admin/production.php"));
           $_SESSION['success'] = "production updated  successful";} //closing result

         }else{

  $value_item = array('Prod_name' =>':p_name', 'Prod_size' =>':p_size', 'Prod_peices' =>':p_peices','Prod_price' =>':p_price', 'Prod_amount' =>':p_amount', 'Datetimes' =>':datetimes'  ,'Remain' =>':remain',  'Addedby' =>':addedby' );  
  $execute_item =array(':p_name' =>$pname , ':p_size' =>$prods_size,':p_peices' =>$p_peicies, ':p_amount' =>$amount ,':addedby' =>$addedby, ':p_price' =>$price, ':datetimes' =>$date , ':remain' =>$p_peicies);
      echo "string";
$insert = $obj->Insert_record('production',$value_item,$execute_item);
if ($insert) {
    header("location:".base_url("admin/production.php"));
    $_SESSION['success'] = "1 more production added successful";

}else {
  
   header("location:".base_url("admin/production.php"));
   $_SESSION['error']=  "something went wrong!";
} 
       }       
  
   
}elseif (isset($_POST['update_production'])) {

  $id = $_POST['id'];


   $p_name = $_POST['prod_name'];
           $p_size = $_POST['prod_size'];
           $p_peicies = $_POST['prod_peices'];
        
$sql=$conn->query("SELECT  * FROM product WHERE  P_name='$p_name'");
               $row = $sql->fetch();
               // print_r($row);
     if ($row >  0){
         $price = $row['P_price'];
              $amount =  $p_peicies * $price;
      
              }else{
 header("location:".base_url("admin/production.php"));
   $_SESSION['error']=  "oops! product with this name and price not  exist";

              }
  // update production
  $sql="UPDATE production  SET  Prod_name =:p_name, Prod_price = :p_price,  prod_size =:p_size, Prod_peices =:p_peices,  Datetimes =:datetimes, Prod_amount=:p_amount, Addedby=:addedby , Remain=:remain   WHERE id =" .$id;
  print_r($sql);
 $execute_item =array(':p_name' =>$p_name, ':remain'=>$p_peicies,':p_size'=>$p_size, ':p_peices' =>$p_peicies, ':p_amount' =>$amount, ':addedby' =>$addedby, ':p_price' =>$price, ':datetimes' =>$date);
    $STH=$conn->prepare($sql);
  $result= $STH->execute($execute_item);

  if ($result) {
      header("location:".base_url("admin/production.php"));
          $_SESSION['success'] = "1 item updated  successful";
  }else{
   header("location:".base_url("admin/production.php"));
   $_SESSION['error']=  "something went wrong!";
  }

  }










  /// add   supply

  if(isset($_POST['add_supply'])){ 

    $prods_size =   $_POST['prod_size'];
           $pname =  $_POST['prod_name'] ;
        echo  $peices =   $_POST['prod_peices'];
       $total = 0;

     
   $sql=$conn->query("SELECT  * FROM product  WHERE  P_name='$pname' and P_size='$prods_size'");
          $row =$sql->fetch();

                $price = $row['P_price'];
              $amount =  $peices * $price;
        


          $sql=$conn->query("SELECT  * FROM production  WHERE  Prod_name='$pname' and Prod_size='$prods_size' ");
          $numrow =$sql->rowCount();
          if ($numrow > 0) { 
                  while ($value = $sql->fetch()){
                      $proremain = $value['Remain'];
                    $total += $proremain;}
  
               $total;  
               $peices;
            echo  $remainpieces = $total - $peices;
              if ($value['Status'] =='off') {
                      header("location:".base_url("admin/outgoing.php"));
                   $_SESSION['error']=  "oops: this product is underclearance , you can only book product that is  cleared, please wait some minute ";

                     }else{

   
 if ( $peices < $total) {
    
         $sql=$conn->prepare("UPDATE production  SET  Remain=:remain   WHERE Prod_name=:p_name AND prod_size=:p_size  AND Datetimes =:date ");
            $update =array(':remain' =>$remainpieces, ':p_name' =>$pname, ':p_size' =>$prods_size , ':date' =>$date);
              $result =$sql->execute($update); 

          if ($result) {
   
          $value_insert = array('Prod_name' =>':p_name','Prod_price' =>':p_price', 'Prod_size' =>':p_size',  'Prod_peices' =>':p_peices', 'Total' =>':p_amount', 'Date' =>':datetimes'  ,  'Supplier' =>':addedby' );  
  
         $execute_insert =array(':p_name' =>$pname ,':p_size' => $prods_size, ':p_price' => $price, ':p_peices' => $peices, ':p_amount' =>$amount ,':addedby' =>$addedby, ':datetimes' =>$date);

         $insert = $obj->Insert_record('supply',$value_insert, $execute_insert);  }

         if ($insert) {
          header("location:".base_url("admin/outgoing.php"));
           $_SESSION['success'] = "booked successful ,  kindly  meet any of our staff for visual clearification";}

 }elseif ($peices == $total) {

            $sql=$conn->prepare("UPDATE production  SET  Remain =:remain WHERE Prod_name=:p_name and  prod_size=:p_size ");
            $execute_item =array(':remain' =>0, ':p_name' =>$pname , ':p_size' =>$prods_size  );
           $result =$sql->execute($execute_item); 

           $value_insert = array('Prod_name' =>':p_name','Prod_price' =>':p_price', 'Prod_size' =>':p_size',  'Prod_peices' =>':p_peices', 'Total' =>':p_amount', 'Date' =>':datetimes'  ,  'Supplier' =>':addedby' );  
  
         $execute_insert =array(':p_name' =>$pname ,':p_size' => $prods_size, ':p_price' => $price, ':p_peices' => $peices, ':p_amount' =>$amount ,':addedby' =>$addedby, ':datetimes' =>$date);

         $insert = $obj->Insert_record('supply',$value_insert, $execute_insert);
        if ($insert) {

            header("location:".base_url("admin/outgoing.php"));
        $_SESSION['success'] = "booked successful ,  kindly  meet any of our staff for visual clearification";}

}elseif ( $total ==0) {
           
           header("location:".base_url("admin/outgoing.php"));
        $_SESSION['error']=  "oops: seems ".$pname." of ".$prods_size."  as finished , try choose other size!";
 }elseif ($peices > $total) {
           
           header("location:".base_url("admin/outgoing.php"));
        $_SESSION['error']=  "oops: seems ".$pname." of ".$prods_size."  remain not upto that , try choose less!";
          }
             
                   
 }   
      } else{

         header("location:".base_url("admin/outgoing.php"));
        $_SESSION['error']=  "oops:seems product  remain not upto that , try choose some other product !";
     }

      
}














    
                 
            if(isset($_POST['add_overdue'])){
              
             $date =   $_POST['date'];
       
      $value_item = array('Date' =>':datetimes' , 'Overdue' =>':overdue' );  
  
     $execute_item =array(':overdue' =>'overdue'  ,':datetimes' =>$date);
  
   $insert = $obj->Insert_record('overdue',$value_item,$execute_item);
if ($insert) {
    header("location:".base_url("admin/overdue.php"));
    $_SESSION['success'] = "1 more item added successful";

}else {
  
   header("location:".base_url("admin/overdue.php"));
   $_SESSION['error']=  "something went wrong!";
} 
          
}
            





          //user account 

             if (isset($_POST['add_supp_acct'])) {
           $user_id=$_POST['user-id'];
           $user_name=$_POST['user-name'];
           $password=$_POST['password'];
           $cpassword=$_POST['cpassword'];
       
         $sql=$conn->query("SELECT  * FROM employees WHERE employee_id='$user_id' ");
        $rowcount  = $sql->fetch();
              if ($rowcount > 0) {
      echo   $position =$rowcount['position_id'];
        $sql=$conn->query("SELECT  * FROM position WHERE id='$position' ");
        $row= $sql->fetch();
    echo   $usertype=$row['Designation'];

              
                 $sql=$conn->query("SELECT  * FROM  panel WHERE User_id='$user_id'");
        $rowcount  = $sql->fetch();
      if ($rowcount > 0) {
           header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry,user with this account alread exist!";
      } else if ($cpassword !== $password) {
      header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{

      $value_item = array('user_id' =>':user_id' , 'Username' =>':username', 'Password' =>':password' , 'User_type' =>':user_type');  
  
     $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' => $usertype);
  
   $insert = $obj->Insert_record('panel',$value_item,$execute_item);

    header("location:".base_url("admin/account.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
            }else{
                 
              header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";
                     }
                                                       
  
    } 



///update user account

     if (isset($_POST['update_acc'])) {
       $user_id=$_POST['user-id'];
           $user_name=$_POST['user-name'];
           $password=$_POST['password'];
           $cpassword=$_POST['cpassword'];
           $id=$_POST['id'];
         $sql=$conn->query("SELECT  * FROM employees WHERE employee_id='$user_id' ");
        $rowcount = $sql->fetch();
              if ($rowcount > 0) {
        $position =$rowcount['position_id'];
        $sql=$conn->query("SELECT  * FROM position WHERE id='$position' ");
        $row= $sql->fetch();
  echo  $usertype= $row['Designation'];

     if ($cpassword !== $password) {
           header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{
  

    
 $sql="UPDATE panel  SET user_id =:user_id, Username =:username, Password=:password , User_type =:user_type   WHERE id =".$id;
  print_r($sql);
  $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' =>$usertype);
      $STH=$conn->prepare($sql);
  $result= $STH->execute($execute_item);

     header("location:".base_url("admin/account.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
             }else{
                 
              header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";
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
     
              
              if ($rowcount > 0) {
                 $sql=$conn->query("SELECT  * FROM  panel WHERE User_id='$user_id'");
        $rowcount  = $sql->fetch();
      if ($rowcount > 0) {
           header("location:".base_url("admin/staff-admin.php"));
          $_SESSION['error']=  "sorry,user with this account alread exist!";
      } else if ($cpassword !== $password) {
           header("location:".base_url("admin/staff-admin.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{

      $value_item = array('user_id' =>':user_id' , 'Username' =>':username', 'Password' =>':password' , 'User_type' =>':user_type');  
  
     $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' => $usertype);
  
   $insert = $obj->Insert_record('panel',$value_item,$execute_item);

     header("location:".base_url("admin/staff-admin.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
            }else{
                 
                   header("location:".base_url("admin/staff-admin.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";
                     }
                                                       
  }






             if (isset($_POST['add_admin_acct'])) {
           $user_id=$_POST['user-id'];
           $user_name=$_POST['user-name'];
           $password=$_POST['password'];
           $cpassword=$_POST['cpassword'];
         $sql=$conn->query("SELECT  * FROM employees WHERE employee_id='$user_id' ");
        $rowcount  = $sql->fetch();
         
              if ($rowcount > 0) {
      echo   $position =$rowcount['position_id'];
        $sql=$conn->query("SELECT  * FROM position WHERE id='$position' ");
        $row= $sql->fetch();
    echo   $usertype=$row['Designation'];

                 $sql=$conn->query("SELECT  * FROM  panel WHERE User_id='$user_id'");
        $rowcount  = $sql->fetch();
      if ($rowcount > 0) {
           header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry,user with this account alread exist!";
      } else if ($cpassword !== $password) {
         header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry,  password does not match!";
      }else{

      $value_item = array('user_id' =>':user_id' , 'Username' =>':username', 'Password' =>':password' , 'User_type' =>':user_type');  
  
     $execute_item =array(':user_id' =>$user_id ,  ':username' =>$user_name , ':password' =>$cpassword , ':user_type' => $usertype);
  
   $insert = $obj->Insert_record('panel',$value_item,$execute_item);
 header("location:".base_url("admin/account.php"));
    $_SESSION['success'] = "1 more item added successful";
  
       }
            }else{
                  header("location:".base_url("admin/account.php"));
          $_SESSION['error']=  "sorry no user with this id , employee must be registered first!";
                     }
                                                       
  }
 




            //cashadvance

           $amount = $_POST['amount'];
         $employee_id = $_POST['employee_id'];


        if (isset($_POST['add_cashadvance'])) {
            
        $sql = $conn->query("SELECT  * FROM employees WHERE employee_id='$employee_id'");
         $rowcount = $sql->rowCount();

      if ($rowcount == 1) {
    $value_item = array('employee_id' =>':user_id' , 'date_advance' =>':date_add', 'amount' =>':amount' , 'Addedby' =>':addedby');  
  
     $execute_item =array(':user_id' =>$employee_id ,  ':date_add' =>$date , ':amount' =>$amount , ':addedby' => $addedby);
  
   $insert = $obj->Insert_record('cashadvance',$value_item,$execute_item);
       
         header("location:".base_url("admin/cashadvance.php"));
        $_SESSION['success'] = "1 more advance added successful";
          
      }else{
         $_SESSION['error']=  "sorry, no employee with this ID number !";
           header("location:".base_url("admin/cashadvance.php"));
      }  



            }elseif (isset($_POST['update_cash'])) {
                   $amount = $_POST['amount'];
             $employee_id = $_POST['employee_id'];
              $id =$_POST['id'];
             $sql = $conn->query("SELECT  * FROM employees WHERE employee_id='$employee_id'");
         $rowcount = $sql->rowCount();

      if ($rowcount == 1) {
    $sql=$conn->prepare("UPDATE cashadvance SET  employee_id =:user_id, date_advance=:date_add, amount=:amount, Addedby =:addedby   WHERE id =" .$id);
     $execute_item =array(':user_id' =>$employee_id ,  ':date_add' =>$date , ':amount' =>$amount , ':addedby' => $addedby);
        $sql->execute($execute_item);
         header("location:".base_url("admin/cashadvance.php"));
        $_SESSION['success'] = "1 more advance added successful";
          
      }else{
         $_SESSION['error']=  "sorry, no employee with this ID number !";
           header("location:".base_url("admin/cashadvance.php"));
      }              }





            //cash deduction

        if (isset($_POST['add_deduction'])) {
            
           $amount = $_POST['amount'];
         $employee_id = $_POST['employee_id'];
       $description = $_POST['description'];


        $sql = $conn->query("SELECT  * FROM employees WHERE employee_id='$employee_id'");
         $rowcount = $sql->rowCount();

      if ($rowcount == 1) {
    $value_item = array('employee_id' =>':user_id' , 'date' =>':date_add', 'amount' =>':amount' , 'description' =>':description' , 'addedby' =>':addedby');  
  
     $execute_item =array(':user_id' =>$employee_id ,  ':date_add' =>$date , ':amount' =>$amount, ':description' =>$description,
      ':addedby' => $addedby);
  
   $insert = $obj->Insert_record('deductions',$value_item,$execute_item);
       
         header("location:".base_url("admin/deduction.php"));
        $_SESSION['success'] = "deducted successful";
          
      }else{
         $_SESSION['error']=  "sorry, no employee with this ID number !";
           header("location:".base_url("admin/deduction.php"));
      }  



            }elseif (isset($_POST['update_deduct'])) {
                  $amount = $_POST['amount'];
         $employee_id = $_POST['employee_id'];
       $description = $_POST['description'];
             $id =$_POST['id'];
             $sql = $conn->query("SELECT  * FROM employees WHERE employee_id='$employee_id'");
         $rowcount = $sql->rowCount();

      if ($rowcount == 1) {
    $sql=$conn->prepare("UPDATE deductions SET  employee_id=:user_id, date=:date_add, amount=:amount, description=:description, addedby=:addedby  WHERE id =" .$id);
     $execute_item =array(':user_id' =>$employee_id, ':date_add' =>$date, ':amount' =>$amount, ':description' =>$description,
      ':addedby' => $addedby);
     $result = $sql->execute($execute_item);
 if ($result) {
     header("location:".base_url("admin/deduction.php"));
        $_SESSION['success'] = "updated successful";
         }  
      }else{
         $_SESSION['error']=  "sorry, no employee with this ID number !";
           header("location:".base_url("admin/deduction.php"));
      }              }

 



      ///send_pay

             $timestamp = time();
                $date = date("Y-m-d", $timestamp);
          echo   $employee_id = $_POST['employee_id'];
         $employee_name = $_POST['employee_name'];
          $gross = $_POST['gross'];
           $damount = $_POST['damount'];
           $camount = $_POST['camount'];
           $netpay = $_POST['netpay'];



if (isset($_POST['send_pay'])) {
       
$status = 'paid';   

     $sql = $conn->query("SELECT  * FROM payroll WHERE employee_id='$employee_id' and date ='$date' and type='single'  ");
         $rowcount = $sql->rowCount();
    if ($rowcount > 0) {
      $row = $sql->fetch();
       $row['Status'];
       if ($row['Status'] =='unpaid') {
           $sql=$conn->prepare("UPDATE payroll SET  employee_id =:user_id, employee_name =:employee_name, netpay=:gross, cashadvance =:camount, deduction=:damount, date=:date , addedby =:addedby , type =:single , Status =:status  WHERE employee_id ='$employee_id'");
    $execute_item =array(':user_id' =>$employee_id ,  ':employee_name' =>$employee_name , ':gross' =>$netpay , ':camount' =>$camount, ':damount' =>$damount,    ':date' =>$date,  ':addedby' => $addedby , ':single' => 'single',':status' => $status);
          $result = $sql->execute($execute_item);
              header("location:".base_url("admin/pay.php"));
        $_SESSION['success'] = "updated to paid successful";

       }elseif ($row['Status'] =='paid') {
            $_SESSION['error']=  "this salary already marked as paid !";
           header("location:".base_url("admin/pay.php"));
       }
    
          
      }else{

    $value_item = array('employee_id' =>':user_id' ,'employee_name' =>':employee_name' ,  'netpay' =>':gross', 'cashadvance' =>':camount' , 'deduction' =>':damount' , 'date' =>':date' , 'addedby' =>':addedby' , 'type' =>':single' , 'Status' => ':status');  
  
      $execute_item =array(':user_id' =>$employee_id ,  ':employee_name' =>$employee_name , ':gross' =>$netpay , ':camount' =>$camount, ':damount' =>$damount,    ':date' =>$date,  ':addedby' => $addedby , ':single' => 'single',':status' => $status);
   $insert = $obj->Insert_record('payroll', $value_item,$execute_item);
       
         header("location:".base_url("admin/pay.php"));
        $_SESSION['success'] = "paid successful";
          
      } 
 }elseif (isset($_POST['not_pay'])) {


    $status = 'unpaid';
  $sql = $conn->query("SELECT  * FROM payroll WHERE employee_id='$employee_id' and date ='$date' and type='single'  ");
         $rowcount = $sql->rowCount();
    if ($rowcount > 0) {
      $row = $sql->fetch();
      echo  $row['Status'];
       if ($row['Status'] =='paid') {
           $sql=$conn->prepare("UPDATE payroll SET  employee_id=:user_id, employee_name =:employee_name, netpay=:gross, cashadvance =:camount, deduction=:damount,  date=:date ,addedby =:addedby , type =:single , Status =:status  WHERE employee_id ='$employee_id'");
                 

    $execute_item =array(':user_id' =>$employee_id ,  ':employee_name' =>$employee_name , ':gross' =>$netpay, ':camount' =>$camount, ':damount' =>$damount,    ':date' =>$date,  ':addedby' => $addedby , ':single' => 'single', ':status' =>$status);
                $result = $sql->execute($execute_item);

              header("location:".base_url("admin/pay.php"));
        $_SESSION['success'] = "updated to unpaid successful";

       }elseif ($row['Status'] =='unpaid') {
            $_SESSION['error']=  "this salary already marked as unpaid !";
           header("location:".base_url("admin/pay.php"));
       }
      }else{
    $value_item = array('employee_id' =>':user_id' ,'employee_name' =>':employee_name' ,  'netpay' =>':gross', 'cashadvance' =>':camount' , 'deduction' =>':damount' , 'date' =>':date' , 'addedby' =>':addedby' , 'type' =>':single' , 'Status' => ':status');  
  
     $execute_item =array(':user_id' =>$employee_id ,  ':employee_name' =>$employee_name , ':gross' =>$netpay , ':camount' =>$camount, ':damount' =>$damount,    ':date' =>$date,  ':addedby' => $addedby , ':single' => 'single',':status' => $status);
  
   $insert = $obj->Insert_record('payroll', $value_item,$execute_item);
       
         header("location:".base_url("admin/pay.php"));
        $_SESSION['success'] = "paid successful";
          
      }
 }
             



       ?>



