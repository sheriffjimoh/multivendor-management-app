<?php 
 include '../class/controller.php'; 

	if(isset($_POST['id'])){

		         $id = $_POST['id'];
	               $obj= new Main;
                   $data = $obj->Read_single_record('schedule', $id );
                   echo json_encode($data)
	               };
?>