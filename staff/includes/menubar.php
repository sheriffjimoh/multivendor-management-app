<aside class="main-sidebar"  style="background-color: #78487348;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
       
     <?php 
         $obj = new DBH;
         $conn  = $obj->Connect();
           echo $empid = $_SESSION['USeR_id'];

         $sql =$conn->query("SELECT * FROM employees WHERE employee_id ='$empid'");
           $unirow = $sql->fetch();
                $firstname = $unirow['firstname'];
              $lastname = $unirow['lastname'];
     
           ?>

       ?>
      <div class="user-panel">
        <div class="pull-left image">
        <img src="<?php echo (!empty($unirow['photo'])) ? '../images/'.$unirow['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $firstname."".$lastname; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">MANAGE</li>
        
        <li><a href="product.php"><i class="fa fa-fa fa-files-o"></i> <span>Product</span></a></li>
      
        <li class="treeview"><a href="#">
            <i class="fa fa-briefcase"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="production.php"><i class="fa fa-circle-o"></i>Production</a></li>
             <li><a href="purchase.php"><i class="fa fa-circle-o"></i>Purchased order</a></li>
             <li><a href="outgoing.php"><i class="fa fa-circle-o"></i>outgoing order </a></li>
            <li><a href="supply.php"><i class="fa fa-circle-o"></i>supply List</a></li>
            <li><a href="unclear.php"><i class="fa fa-circle-o"></i>unclear trip</a></li>
            <li><a href="overdue.php"><i class="fa fa-circle-o"></i>overdue payment</a></li>
          </ul>
        </li>
         <li class="treeview"><a href="#">
            <i class="fa fa-th"></i>
            <span>Stock management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="store.php"><i class="fa fa-circle-o"></i>Store</a></li>
             <li><a href="item.php"><i class="fa fa-circle-o"></i>Item</a></li>
            <li><a href="daily.php"><i class="fa fa-circle-o"></i>daily used</a></li>
            <li><a href="remain.php"><i class="fa fa-circle-o"></i>available  stock</a></li>
          </ul>
        </li>
           <li><a href="supplier.php"><i class="fa fa-user-circle"></i> <span>Supplier</span></a></li>
       <li><a href="Staff-admin.php"><i class="fa fa-user"></i> <span>Staff-admin</span></a></li>
    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>