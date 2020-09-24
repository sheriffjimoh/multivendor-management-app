<?php include '../class/login.php'; 

 $date = NOW();
  $obj = new Main;
$conn= $obj->Connect();

       $sql=$conn->prepare("UPDATE supply  SET  Prod_peices=:tpeceis , Total=:totalaamount  WHERE  Prod_name=:p_name and Prod_size=:p_size and Supplier=:addedby and Status='off'");
    $update =array( ':p_name' =>'bread', ':p_size' =>'23kg', ':tpeceis' =>'900',':totalaamount' =>'233000',  ':addedby' =>'ZQD516892073' );
            // print_r($update);
              $result =$sql->execute($update);
              if ($result) {
               echo $_SESSION['success'] = "book updated successful ,  kindly  meet any of our staff for visual clearification";
                // header("location:".base_url("supplier/outgoing.php")); 
             } 















?>