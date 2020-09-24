<?php
	require '../controller.php';
require '../session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));
 
               $obj= new DBH;
              $conn= $obj->Connect();

              if ($time_in == $time_out) {

header("location:".base_url("admin/schedule.php"));
$_SESSION['error']=  "Time-in and Time-out can't be  same!";
}else{
		$sql = "UPDATE schedule SET time_in = '$time_in', time_out = '$time_out' WHERE id = '$id'";
		if($conn->query($sql)){
			header("location:".base_url("admin/schedule.php"));
			$_SESSION['success'] = 'Schedule updated successfully';
		}
		else{
			header("location:".base_url("admin/schedule.php"));
			$_SESSION['error'] = $conn->error;
		}
	} }
	else{
		header("location:".base_url("admin/schedule.php"));
		$_SESSION['error'] = 'Fill up edit form first';
	}


?>