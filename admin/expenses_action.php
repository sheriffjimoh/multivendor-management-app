<?php 
	include '../login.php';
	
ob_start();
$obj=new DBH;
$conn= $obj->Connect();
 $obj = new Main;
     $date=NOW();
         $addedby = $_SESSION['USeR_id'];
	if(isset($_POST['expenses'])){
		$expenses = $_POST['expenses'];
   	$sql="INSERT INTO  expenses  (Expenses,Date,Addedby) Values(:expenses,:date,:addedby)";
 	  $STH=$conn->prepare($sql);
 	  $execute =array(':expenses' =>$expenses, ':date' =>$date, ':addedby' =>$addedby,);
 	$result= $STH->execute($execute);
		echo json_encode($result);
	}


	if (isset($_POST['submit'])) {
		$expenses = $_POST['expenses'];
		$balance = $_POST['balance'];
		$returned = $_POST['returned'];
		$tamount = $_POST['tamount'];
		$gexpense = $_POST['gexpenses'];
	     $payamount = $_POST['payamount'];
		 $prodamount = $_POST['prodamount'];
		 $percent = $prodamount / 1.1;
          if ($payamount > $prodamount ) {
              	 $status = 'on';
          }elseif ($payamount >= $percent) {
                   $status = 'on';
          }elseif ($payamount == $prodamount) {
             $status = 'on';
          }elseif ($payamount < $prodamount) {
             $status = 'off';
          }
	
 	   $value = array('Returned' =>':returned', 'Balance' =>':balance', 'Expenses' =>':expenses', 'Prod_amount' =>':prodamount', 'Gexpenses' =>':gexpense',  'Payamount' =>':payamount','Totalamount' =>':tamount', ' Datetime' =>':date' , 'Addedby' =>':addedby','Status' =>':status');
 

 	  $execute =array(':returned' =>$returned,':balance' =>$balance,':expenses' =>$expenses, ':prodamount' =>$prodamount, ':gexpense' =>$gexpense, ':payamount' =>$payamount, ':tamount' =>$tamount,':date' =>$date, ':addedby' =>$addedby,':status' =>$status);

 	   $insert = $obj->Insert_record('history',$value,$execute);

 	    if ($insert) {
    header("location:".base_url("admin/balance.php"));
    $_SESSION['success'] = " history saved";

	}

}
?>