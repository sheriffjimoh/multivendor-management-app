<?php 
include '../login.php';
  

$obj=new DBH;
$conn= $obj->Connect();
 $obj = new Main;
     $date=NOW();
         $empid = $_SESSION['USeR_id'];
     $sql =$conn->prepare("SELECT * FROM employees where employee_id='$empid'");
       $STH = $sql->execute();
       $row = $sql->fetch();
         $first = $row['firstname'];
         $last = $row['lastname'];
        $addedby = $first.$last;

if(isset($_POST['add'])){
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));
         $Addedby= 'jimoh sherifdeen';

$value = array('Time_in' =>':Time_in', 'Time_out' =>':Time_out' , 'Addedby' =>':Addedby');
$execute =array(':Time_in' =>$time_in, ':Time_out' =>$time_out , ':Addedby' =>$addedby);
if ($time_in == $time_out) {

header("location:".base_url("admin/schedule.php"));
$_SESSION['error']=  "Time-in and Time-out can't be  same!";
}else{
$insert = $obj->Insert_record('schedule',$value,$execute);

if ($insert) {
		header("location:".base_url("admin/schedule.php"));
		$_SESSION['success'] = "inserted successful";

}else {
	
   header("location:".base_url("admin/schedule.php"));
   $_SESSION['error']=  "something went wrong!";
   }
}
// trim($table);
}
?>