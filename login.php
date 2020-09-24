<?php
  require 'class/controller.php';
  
  $obj = new DBH;
$conn =$obj->Connect(); 
  if (isset($_POST['login'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
      if (empty($username) || empty($password)) {

         header("location:".base_url("index.php"));
       $_SESSION['error']=  "this fields can't be empty!";
}else{
      $sql = $conn->prepare("SELECT * FROM panel where username = :user and Password =:pass"); 
       $STH =$sql->execute(array(':user' =>$username, ':pass' =>$password ));
        $numrows = $sql->rowCount();
        if ($numrows == 1 ) {
        $row =  $sql->fetch();
            echo $type =trim($row['User_type']);
           echo   $lastname = "mr  ".$row['username'];
            
           $_SESSION['USeR_id']= $row['User_id'];
           if ($type == 'super manager') {
            header("location:".base_url("admin/home.php"));
             $_SESSION['success'] = " welcome    ".$lastname;
            } else if ($type ==' $staff') {
             header("location:".base_url("staff/home.php"));
             $_SESSION['success'] = " welcome   ".$lastname;
            } else if ($type == 'Supplier') {
               header("location:".base_url("supplier/home.php"));
             $_SESSION['success'] = " welcome   ".$lastname;
            }  else if ($type == 'production manager') {
               header("location:".base_url("producer/home.php"));
             $_SESSION['success'] = " welcome   ".$lastname;
            }  else if ($type == 'stock manager') {
               header("location:".base_url("stock/home.php"));
             $_SESSION['success'] = " welcome   ".$lastname;
            }  else if ($type == 'distributor') {
               header("location:".base_url("distributor/home.php"));
             $_SESSION['success'] = " welcome   ".$lastname;
            } 
             
                  }else{
                    header("location:".base_url("index.php"));
                        $_SESSION['error']=  "incorrect password or username!";
                  }

  }
      }


  


             function login_attempt()
       {
        if (!isset($_SESSION['USeR_id'])) { 

          header("location:".base_url("index.php?error"));
  $_SESSION['error']= "login is required please!";

         return  $_SESSION['error'];
        }
       }


