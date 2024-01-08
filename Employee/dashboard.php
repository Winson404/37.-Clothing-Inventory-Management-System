<title>Cebu & Co. | Dashboard</title>
<?php require_once 'sidebar.php'; ?>
  
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Contact us</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Contact us</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
                $prod = mysqli_query($conn, "SELECT prod_ID FROM products");
                $row_prod = mysqli_num_rows($prod);
              ?>
              <h3><?php echo $row_prod; ?></h3>
              <p>Product</p>
            </div>
            <div class="icon">
              <i class="fas fa-box"></i>
            </div>
            <a href="product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
                $requests = mysqli_query($conn, "SELECT req_ID FROM requisition WHERE emp_ID=$id AND status=1");
                $row_requests = mysqli_num_rows($requests);
              ?>
              <h3><?php echo $row_requests; ?></h3>
              <p>Purchased orders</p>
            </div>
            <div class="icon">
              <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="transactions.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>
    </div>
  </section>


<?php include '../includes/footer.php'; ?>
