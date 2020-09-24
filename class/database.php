<?php



/**
database .
 */
class DBH
{

	  private $driver;
	  private $user;
	  private $pass;
		function Connect(){
			$this->driver ="mysql:host=localhost;dbname=mis; charset=utf8";
			$this->user="root";
			$this->pass ="";
		
	try {
		  $DBH = new PDO ($this->driver, $this->user,$this->pass);
		  $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $DBH->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		   return $DBH ;

	  } catch (Exception $e) {
		return  $e->getmessage();
	}

	}
}

?>

