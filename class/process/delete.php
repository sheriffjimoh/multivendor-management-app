<?php 
 
 include '../login.php';
  ob_start();
       
       $obj=new DBH;
     $conn = $obj->Connect();

     if (isset($_GET['del_employee'])) {
     	
     	$id =$_GET['del_employee'];

     	$sql=$conn->prepare("DELETE  FROM employees WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("admin/employee.php"));
		        $_SESSION['success'] = "1 record deleted  successful";
		    	}else{
   header("location:".base_url("admin/employee.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }

     // delete  from store ......

     if (isset($_GET['del_store'])) {
     	
     	$id =$_GET['del_store'];

     	$sql=$conn->prepare("DELETE  FROM store WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("admin/store.php"));
		        $_SESSION['success'] = "1 item  deleted  successful";
		    	}else{

   header("location:".base_url("admin/store.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }

     //delete from item 

       if (isset($_GET['del_item'])) {
     	
     	$id =$_GET['del_item'];

     	$sql=$conn->prepare("DELETE  FROM item WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("admin/item.php"));
		        $_SESSION['success'] = "1 item  deleted  successful";
		    	}else{

   header("location:".base_url("admin/item.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }

      //delete from item 

       if (isset($_GET['del_daily_item'])) {
     	
     	$id =$_GET['del_daily_item'];

     	$sql=$conn->prepare("DELETE  FROM daily WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("admin/daily.php"));
		        $_SESSION['success'] = "1 record deleted  successful";
		    	}else{

   header("location:".base_url("admin/daily.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }


               //delete from item 

       if (isset($_GET['del_product'])) {
     	
     	$id =$_GET['del_product'];

     	$sql=$conn->prepare("DELETE  FROM product WHERE id=:id");
     	$result= $sql->execute(array(':id' =>$id));
     	if ($result) {
				header("location:".base_url("admin/product.php"));
		        $_SESSION['success'] = "1 record deleted  successful";
		    	}else{

   header("location:".base_url("admin/product.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}
     }  

     

      if (isset($_GET['del_production'])) {
      
      $id =$_GET['del_production'];

      $sql=$conn->prepare("DELETE  FROM production WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
        header("location:".base_url("admin/production.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("admin/production.php"));
   $_SESSION['error']=  "something went wrong!";
          }
     }


         if (isset($_GET['del_supply'])) {
      
      $id =$_GET['del_supply'];

      $sql=$conn->prepare("DELETE  FROM supply  WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
        header("location:".base_url("admin/supply.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("admin/supply.php"));
   $_SESSION['error']=  "something went wrong!";
          }
     }
             



         if (isset($_GET['del_supplier'])) {
      
      $id =$_GET['del_supplier'];
 $sql= $conn->query("SELECT * FROM supply  where id='$id'  and Status='on' and Payment='off' ");
                  $row=$sql->rowCount();
                  if ($row > 0) {
     header("location:".base_url("admin/account.php"));
   $_SESSION['error']=  "you can't delete this until you pay!";
   }else{
      $sql=$conn->prepare("DELETE  FROM panel WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
        header("location:".base_url("admin/account.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("admin/account.php"));
   $_SESSION['error']=  "something went wrong!";
          }}
     }


    
         if (isset($_GET['del_cash'])) {
      
      $id =$_GET['del_cash'];

      $sql=$conn->prepare("DELETE  FROM cashadvance WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
        header("location:".base_url("admin/cashadvance.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("admin/cashadvance.php"));
   $_SESSION['error']=  "something went wrong!";
          }
     }

           if (isset($_GET['del_deduct'])) {
      
      $id =$_GET['del_deduct'];

      $sql=$conn->prepare("DELETE  FROM deductions WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
        header("location:".base_url("admin/deduction.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("admin/deduction.php"));
   $_SESSION['error']=  "something went wrong!";
          }
     }

      if (isset($_GET['sup_del_supply'])) {
      
      $id =$_GET['sup_del_supply'];

  $sql=$conn->query("SELECT * FROM supply where  id='$id'");
           $row =$sql->fetch();
          echo   $status = $row['Status'];
           echo  $Payment = $row['Payment'];
            if ($status =='off'  || $Payment=='off') {
              
   header("location:".base_url("supplier/outgoing.php"));
   $_SESSION['error']=  "Sorry, you can't  delete pending  order,kindly  use cancel button!";
            }else{

      $sql=$conn->prepare("DELETE  FROM schedule WHERE id=:id");
      $result= $sql->execute(array(':id' =>$id));
      if ($result) {
        header("location:".base_url("supplier/outgoing.php"));
            $_SESSION['success'] = "1 record deleted  successful";
          }else{

   header("location:".base_url("admin/schedule.php"));
   $_SESSION['error']=  "something went wrong!";
          }
          }
     }
    
    
     ?>