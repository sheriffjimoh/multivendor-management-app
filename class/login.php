<?php
  require 'controller.php';
  
  $obj = new DBH;
$conn =$obj->Connect(); 
  if (isset($_POST['login'])) {
  	 $username = $_POST['username'];
  	 $password = $_POST['password'];
     
  	  $sql = $conn->prepare("SELECT * FROM panel where username = :user and Password =:pass"); 
  	   $STH =$sql->execute(array(':user' =>$username, ':pass' =>$password ));
  	   	$numrows = $sql->rowCount();
  	   	if ($numrows > 0 ) {
  	   	$row =  $sql->fetch();
  	   	   $row['User_type'];
  	   	   $_SESSION['USeR_id']= $row['User_id'];
  	   	   if ($row['User_type']= 'admin') {
  	   	    header("location:".base_url("admin/home.php"));
             $_SESSION['success'] = " welcome admin ".$_SESSION['USeR_id'];
  	   	    } else if ($row['User_type']= 'staff') {
  	   	     header("location:".base_url("staff/home.php"));
             $_SESSION['success'] = " welcome staff".$_SESSION['USeR_id'];
  	   	    } else if ($row['User_type']= 'supplier') {
  	   	    	 header("location:".base_url("supplier/home.php"));
             $_SESSION['success'] = " welcome supplier".$_SESSION['USeR_id'];
  	   	    } 
  	   	     
  	   		  	   	}else{
  	   		  	   		header("location:".base_url("index.php"));
                        $_SESSION['error']=  "incorrect password or username!";
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


