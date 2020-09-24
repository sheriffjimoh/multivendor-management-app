<?php
 include '../login.php';
  ob_start();

     $obj= new Main;
     $conn=$obj->Connect();
	if(isset($_GET['del_position'])){
		$id = $_GET['del_position'];
		$sql = "DELETE FROM position WHERE id = '$id'";
		if($conn->query($sql)){
			
				header("location:".base_url("admin/position.php"));
		      $_SESSION['success'] = '1 item  deleted successfully';

		}
		else{
				header("location:".base_url("admin/position.php"));

			$_SESSION['error'] = $conn->error;
		}
	}
	else{
			header("location:".base_url("admin/position.php"));

		$_SESSION['error'] = 'Select item to delete first';
	}

	
?>