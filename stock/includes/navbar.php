<style type="text/css">
  
 .sidebar-toggle ,  .sr-only :hover{
   background: transparent;
 }
.dropdown-menu{
  background: transparent !important;
  width: 900px;
}.user-haeder{
  background: #737584 !important;
}.user-footer{
  background:#85867585 !important;
}

</style>



<header class="main-header"  style="background-color:#85867585;">
    <!-- Logo -->
    <a href="home.php" class="logo" style="background-color:#85867585;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Danjuma Bakery <b>Distributor Board</b>   </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar   navbar-fixed-top" style="background-color:#85867585; ">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
   <!-- <h3 class="text-info lead">Production manager</h3> -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
                    <?php 

     $userid = $_SESSION['USeR_id'];
              $obj = new DBH;
                $conn= $obj->Connect();
                $sql = "SELECT * FROM employees where employee_id ='$userid'";
                $query = $conn->query($sql);
                  $row = $query->fetch();
               if ($query->rowCount() > 0) {
                  $empname = $row['firstname'].$row['lastname'];
                 $photo = $row['photo'];
                $date = $row['created_on'];
               }
?>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="user-image" alt="jimoh sherifdeen"></span>
            </a>
            <ul class="dropdown-menu" >
              <!-- User image -->
                      <li class="user-header" style="background:rgba(3,90,34,56);" >
                 <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">

                <p >
                  <?php  echo (!empty($empname))  ? $empname : 'my username';?>
                  <small>Member since <?php  echo (!empty($date))  ? $date : 'started date';?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">view profile</a>
                </div>
                <div class="pull-right">
                  <a href="../class/process/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav><br><br><br>
  </header>

