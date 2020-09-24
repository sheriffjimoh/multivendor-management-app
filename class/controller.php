
<?php
 require "database.php";
 require 'session.php';
/**
 * main classs
 */
/**
 * 
 */
class Main extends DBH
{
	
	 public function Insert_record($table,$value,$execute)
	 {
	 	 // print_r($execute);
	 	 // $sql = "insert into table (..,..)values(:,:)"
	 	$sql = "INSERT INTO ".$table;
	 	$sql .= " (".implode(',', array_keys($value)).")";
	 	$sql .= "VALUES(".implode(",", array_values($value)).")";
	 	// print_r($sql);
	 	$STH=$this->Connect()->prepare($sql);
	 	$result= $STH->execute($execute);
	 	return $result;

	 		 }

	 	 public function Read_record($table)
	 	 	{
	 	 		try {
	 	 			
	 	 		$STH = $this->Connect()->query(" SELECT * FROM ".$table." order by id desc");

	 	 		if ($STH->rowCount() > 0) {
	 	 			
	 	 		
                 while ($row = $STH->fetch()) {
                 	$array[] = $row;
                 }
                 return $array;
             }
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}	


	 	 	public function Read_single_record($table, $value)
	 	 	{
	 	 			try {
	 	 			// $sql="select * from table where id=2"
	 	 		$STH = $this->Connect()->query(" SELECT * FROM ".$table." WHERE id=".$value);
                $row = $STH->fetch(); 
                 return $row;
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}

	 	 		public function Read_single_unique($table, $value)
	 	 	{
	 	 			try {
	 	 			// $sql="select * from table where id=2"
	 	 		$STH = $this->Connect()->query("SELECT * FROM ".$table." WHERE employee_id=".$value);
                $row = $STH->fetch(); 
                 return $row;
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}


          	public function Read_single_record_item($table,$value)
	 	 	{
	 	 			try {
	 	 			// $sql="select * from table where id=2"
	 	 		$STH = $this->Connect()->query(" SELECT * FROM ".$table." WHERE Item_name=".$value);
                $row = $STH->fetch(); 
                 return $row;
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}


	 	 public function Read_uncleard($table)
	 	 	{
	 	 		try {
	 	 			
	 	 		$STH = $this->Connect()->query(" SELECT  * FROM ".$table." WHERE  Payment='off' OR Status='off' order by id desc");

	 	 		if ($STH->rowCount() > 0) {
	 	 			
	 	 		
                 while ($row = $STH->fetch()) {
                 	$array[] = $row;
                 }
                 return $array;
             }
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}	


	 	 public function Read_cleard($table)
	 	 	{
	 	 		try {
	 	 			
	 	 		$STH = $this->Connect()->query(" SELECT  * FROM ".$table." WHERE  Payment='on' AND Status='on' order by id desc");

	 	 		if ($STH->rowCount() > 0) {
	 	 			
	 	 		
                 while ($row = $STH->fetch()) {
                 	$array[] = $row;
                 }
                 return $array;
             }
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}	
           public function Read_cash_advance()
	 	 	{
	 	 		try {
	 	 			
	 	 		$STH = $this->Connect()->query(" SELECT *, cashadvance.id AS caid FROM cashadvance  LEFT JOIN employees ON  employees.employee_id =cashadvance.employee_id   order by date_advance");

	 	 		if ($STH->rowCount() > 0) {
	 	 			
	 	 		
                 while ($row = $STH->fetch()) {
                 	$array[] = $row;
                 }
                 return $array;
             }
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}	


	 	 	//deduction

	 	 	public function Read_cash_deduction()
	 	 	{
	 	 		try {
	 	 			
	 	 		$STH = $this->Connect()->query("SELECT *, deductions.id AS deid FROM deductions  LEFT JOIN employees ON  employees.employee_id =deductions.employee_id   order by date");

	 	 		if ($STH->rowCount() > 0) {
	 	 			
	 	 		
                 while ($row = $STH->fetch()) {
                 	$array[] = $row;
                 }
                 return $array;
             }
                  } catch (Exception $e) {
	 	 			echo "Error:". $e->getmessage();
	 	 		}
	 	 	}	

              public function get_employeees_name($value)
                  {
                  $empid =$value; 
                 $sql =$this->Connect()->prepare("SELECT * FROM employees where employee_id='$empid'");
                 $STH = $sql->execute();
                 if ($STH) {
                   $prow = $sql->fetch();
                 $first = $prow['firstname'];
                 $last = $prow['lastname'];
                        $addedby = $first.' '.$last;

                        return $addedby;
                 }
                         }
}
