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
       echo   $addedby = $first.$last;

if (isset($_POST['add_position'])) {

  $Designation=$_POST['title'];
   $Salary=$_POST['rate'];
  $hsalary = $Salary/29;
 echo ceil($hsalary) ;
$det=date_default_timezone_set("Africa/Lagos");
$time= time();
 
 $date = Date("Y:m:d",$time);
 // grab connection
 $obj = new Main;
$conn= $obj->Connect();

              $sql=$conn->query("SELECT  * FROM position WHERE  Designation= '$Designation'");
               $row = $sql->fetch();
              if ($row >  0) {
             	
   header("location:".base_url("admin/position.php"));
   $_SESSION['error']=  "this position already exist !";          
                }else{



$value = array('Designation' =>':Designation', 'Salary' =>':Salary', 'Salary_hour' =>':Salary_hr' , 'Addedby' =>':Addedby', 'Datetime' =>':Datetime');
$execute =array(':Designation' =>$Designation, ':Salary' =>$Salary ,':Salary_hr' =>ceil($hsalary),  ':Addedby' =>$addedby, ':Datetime' =>$date);
$insert = $obj->Insert_record('position',$value,$execute);

if ($insert) {
		header("location:".base_url("admin/position.php"));
		$_SESSION['success'] = "inserted successful";

}else {
	
   header("location:".base_url("admin/position.php"));
   $_SESSION['error']=  "something went wrong!";
}
}

// trim($table);
}
?>