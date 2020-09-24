<?php 
 
require '../controller.php';

       
       $obj=new DBH;
     $conn = $obj->Connect();

     if (isset($_GET['del_employee'])) {
     	
     	$id =$_GET['del_employee'];

     	$sql=$conn->prepare("DELETE  FROM employees WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("staff/employee.php"));
		        $_SESSION['success'] = "1 record deleted  successful";
		    	}else{
   header("location:".base_url("staff/employee.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }

     // delete  from store ......

     if (isset($_GET['del_store'])) {
     	
     	$id =$_GET['del_store'];

     	$sql=$conn->prepare("DELETE  FROM store WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("staff/store.php"));
		        $_SESSION['success'] = "1 item  deleted  successful";
		    	}else{

   header("location:".base_url("staff/store.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }

     //delete from item 

       if (isset($_GET['del_item'])) {
     	
     	$id =$_GET['del_item'];

     	$sql=$conn->prepare("DELETE  FROM item WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("staff/item.php"));
		        $_SESSION['success'] = "1 item  deleted  successful";
		    	}else{

   header("location:".base_url("staff/item.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }

      //delete from item 

       if (isset($_GET['del_daily_item'])) {
     	
     	$id =$_GET['del_daily_item'];

     	$sql=$conn->prepare("DELETE  FROM daily WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("staff/daily.php"));
		        $_SESSION['success'] = "1 record deleted  successful";
		    	}else{

   header("location:".base_url("staff/daily.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }


               //delete from item 

       if (isset($_GET['del_product'])) {
     	
     	$id =$_GET['del_product'];

     	$sql=$conn->prepare("DELETE  FROM product WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("staff/product.php"));
		        $_SESSION['success'] = "1 record deleted  successful";
		    	}else{

   header("location:".base_url("staff/product.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }  

     

      if (isset($_GET['del_production'])) {
      
      $id =$_GET['del_production'];

      $sql=$conn->prepare("DELETE  FROM production WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
       
   header("location:".base_url("producer/unclear.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("producer/unclear.php"));
   $_SESSION['error']=  "something went wrong!";
          }
     }


         if (isset($_GET['del_supply'])) {
      
     echo  $id =$_GET['del_supply'];

      $sql=$conn->prepare("DELETE  FROM supply WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
         header("location:".base_url("staff/supply.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

  header("location:".base_url("staff/supply.php"));
   $_SESSION['error']=  "something went wrong!";
          }
     }
             



         if (isset($_GET['del_supplier'])) {
      
      $id =$_GET['del_supplier'];

      $sql=$conn->prepare("DELETE  FROM panel WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
        header("location:".base_url("admin/supplier.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("admin/supplier.php"));
   $_SESSION['error']=  "something went wrong!";
          }
     }





     ?>