<?php
  require_once '../config.php';
  if(isset($_SESSION['admin_Id']) && isset($_SESSION['login_time'])) {
    $id = $_SESSION['admin_Id'];
    $users = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
    $row = mysqli_fetch_array($users);
    $fullname = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'];
    $logged_in_user_email = $row['email'];

    $login_time = $_SESSION['login_time'];
    $logout_time = date('Y-m-d h:i A');
    // RECORD TIME LOGGED IN TO BE USED IN AUTO LOGOUT - CODE CAN BE FOUND ON ../INCLUDES/FOOTER.PHP
    $_SESSION['last_active'] = time();
    require_once '../includes/header.php';
    require_once 'announcement_add.php'; 
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="dashboard.php" class="brand-link">
    <img src="../images/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Cebu & Co.</span>
    <br>
    <span class="text-sm ml-5 font-weight-light mt-2">&nbsp;&nbsp;Chatswood Center A.S Fortuna St.</span>
  </a>
  
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> -->
    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'admin.php' ||
            basename($_SERVER['PHP_SELF']) == 'admin_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'admin_view.php' ||
            basename($_SERVER['PHP_SELF']) == 'users.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_view.php'
            ) ? 'active' : '';
            ?>
            ">
            <i class="fa-solid fa-users-gear"></i>
            <p>&nbsp;&nbsp;System Users<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview"
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'admin.php' ||
            basename($_SERVER['PHP_SELF']) == 'admin_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'admin_view.php' ||
            basename($_SERVER['PHP_SELF']) == 'users.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_mgmt.php' ||
            basename($_SERVER['PHP_SELF']) == 'users_view.php'
            ) ? 'style="display: block;"' : '';
            ?>
            >
            <li class="nav-item">
              <a href="admin.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['admin.php', 'admin_mgmt.php', 'admin_view.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>&nbsp;&nbsp; Administrators</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="users.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['users.php', 'users_mgmt.php', 'users_view.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>&nbsp;&nbsp; Employee</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="suppliers.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['suppliers.php']) ? 'active' : ''; ?>">
            <i class="fas fa-truck nav-icon"></i>
            <p>Supplier</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="product.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['product.php']) ? 'active' : ''; ?>">
            <i class="fas fa-box"></i>
            <p>&nbsp;&nbsp; Product</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="requisition.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['requisition.php']) ? 'active' : ''; ?>">
            <i class="fas fa-clipboard-list"></i>
            <p>&nbsp;&nbsp; Pending requisitions</p>
          </a>
        </li>
        
        <!-- <li class="nav-item">
          <a href="announcement.php" class="nav-link <?php //echo (basename($_SERVER['PHP_SELF']) == 'announcement.php') ? 'active' : ''; ?>">
            <i class="fa-solid fa-bell"></i>
            <p>&nbsp;&nbsp; Announcement</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="#" class="nav-link
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'transactions.php' ||
            basename($_SERVER['PHP_SELF']) == 'transactions_print.php' ||
            basename($_SERVER['PHP_SELF']) == 'purchased.php' ||
            basename($_SERVER['PHP_SELF']) == 'purchased_print.php' ||
            basename($_SERVER['PHP_SELF']) == 'product_print.php'
            ) ? 'active' : '';
            ?>
            ">
            <i class="fas fa-file-alt"></i>
            <p>&nbsp;&nbsp;Transaction reports<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview"
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'transactions.php' ||
            basename($_SERVER['PHP_SELF']) == 'transactions_print.php' ||
            basename($_SERVER['PHP_SELF']) == 'purchased.php' ||
            basename($_SERVER['PHP_SELF']) == 'purchased_print.php' ||
            basename($_SERVER['PHP_SELF']) == 'product_print.php'
            ) ? 'style="display: block;"' : '';
            ?>
            >
            <li class="nav-item">
              <a href="product_print.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['product_print.php', 'transactions_print.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Inventory</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="transactions.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['transactions.php', 'transactions_print.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Approved requisitions</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="purchased.php" class="nav-link <?php echo in_array(basename($_SERVER['PHP_SELF']), ['purchased.php', 'purchased_print.php']) ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Orders</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="log_history.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'log_history.php') ? 'active' : ''; ?>">
            <i class="fas fa-list-alt"></i>
            <p>&nbsp;&nbsp; Log history</p>
          </a>
        </li>
        <li class="nav-header text-secondary" style="margin-bottom: -10px;">DATABASE MGMT</li>
        <li class="nav-item">
          <a href="#" class="nav-link
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'backup.php' ||
            basename($_SERVER['PHP_SELF']) == 'restore.php'
            ) ? 'active' : '';
            ?>
            ">
            <i class="fa-solid fa-database"></i>
            <p>&nbsp;&nbsp;Manage Database<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview"
            <?php
            echo (
            basename($_SERVER['PHP_SELF']) == 'backup.php' ||
            basename($_SERVER['PHP_SELF']) == 'restore.php'
            ) ? 'style="display: block;"' : '';
            ?>
            >
            <li class="nav-item">
              <a href="backup.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'backup.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>&nbsp; Back-up database</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="restore.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'restore.php') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>&nbsp;&nbsp; Restore database</p>
              </a>
            </li>
          </ul>
        </li>
        
      </ul>
    </nav>
    <br>
    <br>
  </div>
</aside>
<?php
  } else {
    header('Location: ../login.php');
  }
?>