<?php
 include '../login.php';
  ob_start();

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$rate = $_POST['rate'];
                   $obj= new Main;
                   $conn = $obj->Connect();

		$sql = "UPDATE position SET Designation = '$title', Salary = '$rate' WHERE id = '$id'";
		if($conn->query($sql)){
			header("location:".base_url("admin/position.php"));
			$_SESSION['success'] = 'Position updated successfully';
		}
		else{
			header("location:".base_url("admin/position.php"));
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		header("location:".base_url("admin/position.php"));
		$_SESSION['error'] = 'Fill up edit form first';
	}


?>
