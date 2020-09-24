<?php

require '../controller.php';

   $time = time();
   $date = date("Y-m-d", $time);
if (isset($_POST['upload'])) {
  $id= $_POST['id'];
$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			 $base = '../../images/';
			move_uploaded_file($_FILES['photo']['tmp_name'], $base.$filename);	
     $obj=new DBH;
     $conn = $obj->Connect();
			$sql =$conn->prepare("UPDATE employees SET photo=:photo WHERE employee_id=:empid");
			$rsult = $sql->execute(array(':photo' => $filename, ':empid'=>$id));
			if ($rsult) {
				header("location:".base_url("admin/employee.php"));
		        $_SESSION['success'] = "image updated  successful";
		    	}else{

   header("location:".base_url("admin/employee.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}

		}else{

			 header("location:".base_url("admin/employee.php"));
   $_SESSION['error']=  "no file was choosen";
		}
}



if (isset($_GET['clear'])) {
  $clear = $_GET['clear'];

   $obj=new DBH;
     $conn = $obj->Connect();

                 $sql= $conn->query("SELECT * FROM supply  where id='$clear'  and Status='on' ");
                  $row=$sql->rowCount();
                  if ($row > 0) {
     header("location:".base_url("admin/unclear.php"));
   $_SESSION['error']=  "this trip is already cleared!";
                  } else {
                  	                  

    			$sql =$conn->prepare("UPDATE supply SET Status=:status WHERE id=:id");
			$rsult = $sql->execute(array(':status' => 'on', ':id'=>$clear));
			if ($rsult) {
				header("location:".base_url("admin/unclear.php"));
		        $_SESSION['success'] = "trip cleared  successful";
		    	}else{

   header("location:".base_url("admin/unclear.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}

		}  }


        if (isset($_GET['paid'])) {
  $paid = $_GET['paid'];
                        	 
     $obj=new DBH;
     $conn = $obj->Connect();     
                 $sql= $conn->query("SELECT * FROM supply  where id='$paid'  and Payment='on' ");
                  $row=$sql->rowCount();
                  if ($row > 0) {
     header("location:".base_url("admin/unclear.php"));
   $_SESSION['error']=  "this trip is already Paid!";
                  } else {
     
			$sql =$conn->prepare("UPDATE supply SET Payment=:payment WHERE id=:id");
			$rsult = $sql->execute(array(':payment'=> 'on', ':id'=>$paid));
			if ($rsult) {
				header("location:".base_url("admin/unclear.php"));
		        $_SESSION['success'] = "payment cleared   successful";
		    	}else{

   header("location:".base_url("admin/unclear.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}

		}   }








                        
     $obj=new DBH;
     $conn = $obj->Connect(); 

        if (isset($_GET['update_pay'])) {
  $date = $_GET['update_pay'];
                           
     $obj=new DBH;
     $conn = $obj->Connect();     
                 $sql= $conn->query("SELECT * FROM payroll  where date='$date' and Status='paid'  ");
                  $row=$sql->rowCount();
                  if ($row > 0) {
     header("location:".base_url("admin/home.php"));
   $_SESSION['error']=  "this salaries  already marked Paid!";
                  } else {
     
      $sql =$conn->prepare("UPDATE payroll  SET Status=:status WHERE date=:date");
      $rsult = $sql->execute(array(':status'=> 'paid', ':date'=>$date));
      if ($rsult) {
        header("location:".base_url("admin/home.php"));
            $_SESSION['success'] = "payment cleared   successful";
          }else{

   header("location:".base_url("admin/pay.php"));
   $_SESSION['error']=  "something went wrong!";
          }

    }   }


    if (isset($_POST['save'])) {
          $type = $_POST['type'];
          $value = $_POST['value'];
          $id = $_POST['id'];
    if ($value == 'Expenses') {
      $sql =$conn->prepare("UPDATE supply  SET Expenses=:expenses WHERE id=:id");
      $rsult = $sql->execute(array(':expenses'=>$type, ':id'=>$id));
        if ($rsult) {
        header("location:".base_url("admin/unclear.php"));
            $_SESSION['success'] = "Expenses added";
          }else{
       header("location:".base_url("admin/unclear.php"));
            $_SESSION['error']=  "something went wrong!";
          }
    }elseif ($value == 'Balance') {
       $sql =$conn->prepare("UPDATE supply  SET Balance=:balance WHERE id=:id");
      $rsult = $sql->execute(array(':balance'=>$type, ':id'=>$id));
        if ($rsult) {
        header("location:".base_url("admin/unclear.php"));
            $_SESSION['success'] = "Balance added";
          }else{
       header("location:".base_url("admin/unclear.php"));
            $_SESSION['error']=  "something went wrong!";
          }    }elseif ($value == 'Returned') {
       $sql =$conn->prepare("UPDATE supply  SET Returned=:return WHERE id=:id");
      $rsult = $sql->execute(array(':return'=>$type, ':id'=>$id));
        if ($rsult) {
           $sql=$conn->query("SELECT * FROM supply where  id='$id'");
           $row =$sql->fetch();
           $remain =0;
             $pname = $row['Prod_name'];
             $prods_size= $row['Prod_size'];
               $sql=$conn->query("SELECT * FROM production WHERE  Prod_name='$pname' and Prod_size='$prods_size'");
          while ($row =$sql->fetch()) {
            $remain +=$row['Remain'];}
            $total = $remain+$type; 
         $sql=$conn->prepare("UPDATE production  SET  Remain =:remain, Prod_peices=:ppeices, Datetimes=:dates  WHERE  prod_name=:p_name and  prod_size=:p_size ");
         $execute =array(':remain' =>$total, ':ppeices' =>$total,':dates' =>$date,  ':p_name' =>$pname, ':p_size' =>$prods_size );
           $result =$sql->execute($execute); 
       header("location:".base_url("admin/unclear.php"));
            $_SESSION['success'] = "Returned added";
          }else{
       header("location:".base_url("admin/unclear.php"));
            $_SESSION['error']=  "something went wrong!";
          }    }


      
    }


            if (isset($_GET['cancel_supply'])) {
             $id = $_GET['cancel_supply'];
            $sql=$conn->query("SELECT * FROM supply where  id='$id'");
           $row =$sql->fetch();
           $remain =0;
             $pname = $row['Prod_name'];
             $prods_size= $row['Prod_size'];
              $prods_peices= $row['Prod_peices'];
                $sql=$conn->query("SELECT * FROM production WHERE  Prod_name='$pname' and Prod_size='$prods_size'");
          while ($row =$sql->fetch()) {
            $remain +=$row['Remain'];}
            $total = $remain+$prods_peices; 
             $sql=$conn->prepare("UPDATE production  SET  Remain=:remain   WHERE  Prod_name=:p_name and  prod_size=:p_size and Datetimes='$date'");
         $execute =array(':remain' =>$total,  ':p_name' =>$pname, ':p_size' =>$prods_size );
           $result =$sql->execute($execute); 
           if ($result) {
              $sql=$conn->prepare("DELETE  FROM supply WHERE id=:id");
            $result= $sql->execute(array(':id' =>$id));
               header("location:".base_url("supplier/outgoing.php"));
           echo  $_SESSION['success'] = "this order as been cancelled and evicted";
          }else{
       header("location:".base_url("supplier/outgoing.php"));
            $_SESSION['error']=  "something went wrong!";
          }  

            }



