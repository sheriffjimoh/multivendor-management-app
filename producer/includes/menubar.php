

<style type="text/css">
  
 a :hover{
    background: transparent;
 }

</style>
<aside class="main-sidebar"  style="background-color:#85867585; position: fixed;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->


      <div class="user-panel">
        <div class="pull-left image">
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
               }?>
         <img src="<?php echo (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">

        </div>
        <div class="pull-left info">
          <p><?php  echo (!empty($empname))  ? $empname : 'my username';?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class=""><a href="product.php"><i class="fa fa-briefcase"></i> <span>Our product</span> </a></li>
         <li class=""><a href="add.php"><i class="fa fa-plus"></i> <span>Add production</span> </a></li>
         <li class=""><a href="unclear.php"><i class="fa fa-spinner"></i> <span>Pendings</span> </a></li>
           <li class=""><a href="history.php"><i class="fa fa-folder-open"></i> <span>History</span>  </a></li>
                    <li class=""><a href="help.php"><i class="fa fa-cog"></i> <span>Help</span>  </a></li>

                  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>