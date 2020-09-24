

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
               $empname = $row['firstname'].' '.$row['lastname'];
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
            <li><a href="history.php"><i class="fa fa-folder-open"></i><span>Store</span> </a></li>
             <li><a href="item.php"><i class="fa fa-book"></i><span>Item</span> </a></li>
            <li><a href="daily.php"><i class="fa fa-plus"></i><span>daily used</span> </a></li>
            <li><a href="remain.php"><i class="fa fa-briefcase"></i><span>available  stock</span>   </a></li>
       
                  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>