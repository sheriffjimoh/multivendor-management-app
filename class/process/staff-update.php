<?php

 include '../login.php';
	
ob_start();
$obj=new DBH;
$conn= $obj->Connect();
 $obj = new Main;
     $date=NOW();
         $userid = $_SESSION['USeR_id'];


// if (isset($_POST['upload'])) {
//   $id= $_POST['id'];
// $filename = $_FILES['photo']['name'];
// 		if(!empty($filename)){
// 			 $base = '../../images/';
// 			move_uploaded_file($_FILES['photo']['tmp_name'], $base.$filename);	
  
// 			$sql =$conn->prepare("UPDATE employees SET photo=:photo WHERE employee_id=:empid");
// 			$rsult = $sql->execute(array(':photo' => $filename, ':empid'=>$id));
// 			if ($rsult) {
// 				header("location:".base_url("staff/employee.php"));
// 		        $_SESSION['success'] = "image updated  successful";
// 		    	}else{

//    header("location:".base_url("staff/employee.php"));
//    $_SESSION['error']=  "something went wrong!";
// 		    	}

// 		}else{

// 			 header("location:".base_url("admin/employee.php"));
//    $_SESSION['error']=  "no file was choosen";
// 		}
// }

 
    if (isset($_POST['save'])) {
          $type = $_POST['type'];
          $value = $_POST['value'];
          $id = $_POST['id'];
    if ($value == 'Expenses') {
      $sql =$conn->prepare("UPDATE supply  SET Expenses=:expenses WHERE id=:id");
      $rsult = $sql->execute(array(':expenses'=>$type, ':id'=>$id));
        if ($rsult) {
        header("location:".base_url("distributor/unclearp.php"));
            $_SESSION['success'] = "Expenses added";
          }else{
            header("location:".base_url("distributor/unclearp.php"));
            $_SESSION['error']=  "something went wrong!";
          }
    }elseif ($value == 'Balance') {
       $sql =$conn->prepare("UPDATE supply  SET Balance=:balance WHERE id=:id");
      $rsult = $sql->execute(array(':balance'=>$type, ':id'=>$id));
        if ($rsult) {
              header("location:".base_url("distributor/unclearp.php"));
            $_SESSION['success'] = "Balance added";
          }else{
          header("location:".base_url("distributor/unclearp.php"));
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
             header("location:".base_url("distributor/unclearp.php"));
            $_SESSION['success'] = "Returned added";
          }else{
            header("location:".base_url("distributor/unclearp.php"));
            $_SESSION['error']=  "something went wrong!";
          }    }


      
    }













if (isset($_GET['clear_supply'])) {
  $clear = $_GET['clear_supply'];

                 $sql= $conn->query("SELECT * FROM supply  where id='$clear'  and Status='on' ");
                  $row=$sql->rowCount();
                  if ($row > 0) {
     header("location:".base_url("distributor/unclearo.php"));
   $_SESSION['error']=  "this trip is already cleared!";
                  } else {
                  	                  

    			$sql =$conn->prepare("UPDATE supply SET Status=:status, Cleared_by=:clear WHERE id=:id");
			$rsult = $sql->execute(array(':status' => 'on', ':clear' => $userid,':id'=>$clear));
			if ($rsult) {
				 header("location:".base_url("distributor/unclearo.php"));
		        $_SESSION['success'] = "trip cleared  successful";
		    	}else{
 header("location:".base_url("distributor/unclearo.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}

		}  }// prod_clear_id


if (isset($_GET['prod_clear_id'])) {
  $clear = $_GET['prod_clear_id'];

			$sql =$conn->prepare("UPDATE production SET Status=:status , Cleared_by=:clear WHERE id=:id");
			$rsult = $sql->execute(array(':status' => 'on',':clear' => $userid, ':id'=>$clear));
			if ($rsult) {
				header("location:".base_url("distributor/newprod.php"));
		        $_SESSION['success'] = "production cleared  successful";
		    	}else{

   header("location:".base_url("distributor/newprod.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}

		}


        if (isset($_GET['paid_supply'])) {
  $clear = $_GET['paid_supply'];
  $obj=new DBH;
     $conn = $obj->Connect();     
                 $sql= $conn->query("SELECT * FROM supply  where id='$paid'  and Payment='on' ");
                  $row=$sql->rowCount();
                  if ($row > 0) {
     header("location:".base_url("distributor/unclearp.php"));
   $_SESSION['error']=  "this trip is already Paid!";
                  } else {
			$sql =$conn->prepare("UPDATE supply SET Payment=:payment , Paid_to=:paidto WHERE id=:id");
			$rsult = $sql->execute(array(':payment'=> 'on', ':paidto'=> $userid, ':id'=>$clear));
			if ($rsult) {
			 header("location:".base_url("distributor/unclearp.php"));
		        $_SESSION['success'] = "payment cleared   successful";
		    	}else{

  header("location:".base_url("distributor/unclearp.php"));
   $_SESSION['error']=  "something went wrong!";
		    	}

		}
	}
  
           
                   if (isset($_POST['update_profile_producer'])) {
        echo  $opassword = $_POST['opassword'];
         $npassword = $_POST['npassword'];
         $cpassword = $_POST['cpassword'];
         echo $username = $_POST['username'];
          $obj=new DBH;
     $conn = $obj->Connect();     
                 $sql= $conn->query("SELECT * FROM panel  where User_id='$userid' and username='$username'");
                  $rowcount=$sql->rowCount();
                   $row=$sql->fetch();
                  if ($rowcount >0) {
                  
                  if ($opassword!=$row['Password']) {
               header("location:".base_url("producer/profile.php"));
          $_SESSION['error']=  "your old Password does not match!";
                  }elseif ($cpassword!=$npassword) {
               header("location:".base_url("producer/profile.php"));
          $_SESSION['error']=  "your  Password does not match!";
                  }else{
                    $sql =$conn->query("UPDATE panel SET username='$username',Password='$cpassword' where  User_id='$userid'");
                     header("location:".base_url("producer/profile.php"));
            $_SESSION['success'] = "profile updated   successful";
                  }
                    } else {
     header("location:".base_url("producer/profile.php"));
   $_SESSION['error']=  "this account does not exist!";
                

      }
    }






         if (isset($_POST['update_profile_stock'])) {
        echo  $opassword = $_POST['opassword'];
         $npassword = $_POST['npassword'];
         $cpassword = $_POST['cpassword'];
         echo $username = $_POST['username'];
          $obj=new DBH;
     $conn = $obj->Connect();     
                 $sql= $conn->query("SELECT * FROM panel  where User_id='$userid' and username='$username'");
                  $rowcount=$sql->rowCount();
                   $row=$sql->fetch();
                  if ($rowcount >0) {
                  
                  if ($opassword!=$row['Password']) {
               header("location:".base_url("stock/profile.php"));
          $_SESSION['error']=  "your old Password does not match!";
                  }elseif ($cpassword!=$npassword) {
               header("location:".base_url("stock/profile.php"));
          $_SESSION['error']=  "your  Password does not match!";
                  }else{
                    $sql =$conn->query("UPDATE panel SET username='$username',Password='$cpassword' where  User_id='$userid'");
                     header("location:".base_url("stock/profile.php"));
            $_SESSION['success'] = "profile updated   successful";
                  }
                    } else {
     header("location:".base_url("stock/profile.php"));
   $_SESSION['error']=  "this account does not exist!";
                

      }
    }


           
        if (isset($_POST['update_profile_distri'])) {
        echo  $opassword = $_POST['opassword'];
         $npassword = $_POST['npassword'];
         $cpassword = $_POST['cpassword'];
         echo $username = $_POST['username'];
          $obj=new DBH;
     $conn = $obj->Connect();     
                 $sql= $conn->query("SELECT * FROM panel  where User_id='$userid' and username='$username'");
                  $rowcount=$sql->rowCount();
                   $row=$sql->fetch();
                  if ($rowcount >0) {
                  
                  if ($opassword!=$row['Password']) {
               header("location:".base_url("distributor/profile.php"));
          $_SESSION['error']=  "your old Password does not match!";
                  }elseif ($cpassword!=$npassword) {
               header("location:".base_url("distributor/profile.php"));
          $_SESSION['error']=  "your  Password does not match!";
                  }else{
                    $sql =$conn->query("UPDATE panel SET username='$username',Password='$cpassword' where  User_id='$userid'");
                     header("location:".base_url("distributor/profile.php"));
            $_SESSION['success'] = "profile updated   successful";
                  }
                    } else {
     header("location:".base_url("distributor/profile.php"));
   $_SESSION['error']=  "this account does not exist!";
                

      }
    }








        if (isset($_POST['update_profile'])) {
        echo  $opassword = $_POST['opassword'];
         $npassword = $_POST['npassword'];
         $cpassword = $_POST['cpassword'];
         echo $username = $_POST['username'];
          $obj=new DBH;
     $conn = $obj->Connect();     
                 $sql= $conn->query("SELECT * FROM panel  where User_id='$userid' and username='$username'");
                  $rowcount=$sql->rowCount();
                   $row=$sql->fetch();
                  if ($rowcount >0) {
                  
                  if ($opassword!=$row['Password']) {
               header("location:".base_url("supplier/profile.php"));
          $_SESSION['error']=  "your old Password does not match!";
                  }elseif ($cpassword!=$npassword) {
               header("location:".base_url("supplier/profile.php"));
          $_SESSION['error']=  "your  Password does not match!";
                  }else{
                    $sql =$conn->query("UPDATE panel SET username='$username',Password='$cpassword' where  User_id='$userid'");
                     header("location:".base_url("supplier/profile.php"));
            $_SESSION['success'] = "profile updated   successful";
                  }
                    } else {
     header("location:".base_url("supplier/profile.php"));
   $_SESSION['error']=  "this account does not exist!";
                

      }
    }




      if (isset($_GET['clear_bal'])) {
       
       $id =  $_GET['clear_bal']; 
              
      $sql =$conn->query("UPDATE supply SET Balance=0 where id='$id'");
      if ($sql) {
        header("location:".base_url("distributor/balance.php"));
            $_SESSION['success'] = "balance paid  successful";
      } else {
   header("location:".base_url("distributor/balance.php"));
       $_SESSION['error']=  "something went wrong!";
                

      }
    }