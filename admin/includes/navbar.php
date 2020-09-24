<header class="main-header" >
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Management App</b>  </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top navbar-fixed-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
 <?php 
         $obj = new DBH;
         $conn  = $obj->Connect();
          $empid = $_SESSION['USeR_id'];

         $sql =$conn->query("SELECT * FROM employees WHERE employee_id ='$empid'");
           $unirow = $sql->fetch();
                $firstname = $unirow['firstname'];
              $lastname = $unirow['lastname'];
     
           ?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo (!empty($unirow['photo'])) ? '../images/'.$unirow['photo'] : '../images/profile.jpg'; ?>"  class="user-image" alt="my img"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo (!empty($unirow['photo'])) ? '../images/'.$unirow['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">

                <p>
                <?php echo $firstname."".$lastname; ?>
                  <small>Member since <?php echo $unirow['created_on'] ?></small>
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
    </nav>
  </header>
