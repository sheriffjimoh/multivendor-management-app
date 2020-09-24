<?php 
  require '../login.php';
ob_start();




if (isset($_SESSION['USeR_id']) ) {
	
	header("location:".base_url("index.php?lgts"));
    $_SESSION['success'] = "you have successfully logout";
 $_SESSION['USeR_id']= null;
 session_destroy();
}








?>