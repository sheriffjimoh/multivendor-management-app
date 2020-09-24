
<?php
   session_start();
    
         function base_url($value)
	 		 {
	 		 	$url="http://localhost/IMS/".$value;
	 		 	return  $url;	 		 
	 		 }

	 		  function message()
	 		 {
	 		 if (isset( $_SESSION['errormessage'])) {
	 		 	$output =" <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>";
              $output .= htmlentities($_SESSION['errormessage']);
              $output .="</div>";
	 		     $_SESSION['errormessage']=null;
                   return   $output;                     }
	 		 }

        

	 		  function successmessage()
	 		 {
	 		 	if (isset($_SESSION['successmessage'])) {
	 		 	
	 		 $output =" <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4";
              $output.= htmlentities($_SESSION['successmessage']);
              $output .= "</div>";	              
                $_SESSION['successmessage']=null;
                return   $output;                    
                    }
              }
                  


                  function NOW()
                  {
             date_default_timezone_set('africa/Lagos');
                 $time = time();
                 $date= date( "Y-m-d " , $time);

                 return $date;
                
                  }

                  function progressbar($peceices,$remain)
                  {
                   
            $percent = 0;
                $qty = $peceices;
               $qty100 =$qty;
                 $qty50 =ceil($qty/2);
                 $qty75  =ceil($qty/1.3);
                 $qty65 =ceil($qty/1.6);
                   $qty45 = ceil( $qty/2.2);
                  $qty35 =ceil($qty/3);
                $qty25 = ceil($qty/4);

                   if ($remain==0) {
                      $percent = "0%";
                          
                  }else if ($remain == $qty100) {
                   $percent = "100%";
                   }else if ($remain== $qty50) {
                   $percent = "50%";
                  }elseif ($remain < $qty100 &&  $remain > $qty75 ) {
                    $percent = "75%";
                  }elseif ($remain < $qty75 && $remain > $qty65) {
                          $percent = "65%";
                  }elseif ($remain < $qty65 && $remain > $qty45) {
                          $percent = "45%";
                  } elseif ($remain < $qty45 && $remain > $qty35) {
                          $percent = "35%";
                  } elseif ($remain < $qty35 && $remain > $qty25) {
                          $percent = "25%";
                     } elseif ($remain < $qty25 ) {
                          $percent = "10%";
                      }
                        return  $percent;
                  }


                
	 		 ?>