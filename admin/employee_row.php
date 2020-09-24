<?php 
	include '../class/controller.php';

	if(isset($_POST['id'])  && isset($_POST['date'])){
		$id = $_POST['id'];
		$date = $_POST['date'];
		 $obj= new DBH;
		 $conn = $obj->Connect();
   	$sql="UPDATE employees  SET   Start =:start   WHERE id =".$id;
 	  $STH=$conn->prepare($sql);
 	  $execute =array(':start' =>$date);
 	$result= $STH->execute($execute);
		echo json_encode($result);
	}
?>