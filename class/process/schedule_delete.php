<?php
 include '../login.php';
  ob_start();

     $obj= new Main;
     $conn=$obj->Connect();
	if(isset($_GET['del_schedule'])){
		$id = $_GET['del_schedule'];
		$sql = "DELETE FROM schedule WHERE id = '$id'";
		if($conn->query($sql)){
			
				header("location:".base_url("admin/schedule.php"));
		      $_SESSION['success'] = '1 item  deleted successfully';

		}
		else{
				header("location:".base_url("admin/schedule.php"));

			$_SESSION['error'] = $conn->error;
		}
	}
	else{
			header("location:".base_url("admin/schedule.php"));

		$_SESSION['error'] = 'Select item to delete first';
	}

	
?>