<title>Cebu & Co. | Orders history records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Orders history</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Orders history records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <button class="btn btn-success float-sm-right m-1 btn-sm" id="printButton"><i class="fa-solid fa-print"></i> Print</button>
                <a class="btn btn-dark float-sm-right m-1 btn-sm" href="purchased.php"><i class="fa-solid fa-backward"></i> Back</a>
            </div>
            <div class="card-body">
              <div class="container"id="printElement">
                <div class="row invoice-info d-flex p-0 m-0" style="line-height: 18px;">
                  <!-- <div class="col-sm-2">
                    <img src="../images/stii.png"  alt="" style="margin-left: 90px;"  width="75">
                  </div> -->
                  <div class="col-sm-8 invoice-col text-center d-block m-auto">
                    <address>
                      <!-- Republic of the Philippines<br> -->
                      <strong>6014 Cebu, Mandaue City,</strong><br>
                      GF09, Chatswood Drive, Chatswood Center, <br>
                      A.S Fortuna St
                    </address>
                  </div>
                  <div class="col-sm-12">
                    <!-- <center>
                    <small>Multi-Purpose Barangay Hall Pildera II, Pasay City 1300, MM, Phil's, Telefax: 8853-6275; email:brgy193@gmail.com</small>
                    </center> -->
                    <div class="dropdown-divider"></div>
                  </div>
                  <div class="col-12">
                    <p class="text-center text-bold">CEBU & CO. <br> ORDER HISTORY</p>
                    <p class="float-right" style="margin-top: -30px;"><?php echo date("d/m/Y"); ?></p>
                  </div>
                  
                  <table id="" class="table table-bordered table-hover text-sm mt-2 table-sm">
                <thead>
                  <tr>
                    <th>REQUESTOR NAME</th>
                    <th>SUPPLIER NAME</th>
                    <th>PRODUCT NAME</th>
                    <th>SIZE</th>
                    <th>COLOR</th>
                    <th>REQUESTED QTY</th>
                    <th>PRICE</th>
                    <th>DELIVERY DATE</th>
                    <th>REQUEST DATE</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM requisition r JOIN products p ON r.prod_ID=p.prod_ID JOIN users s ON r.emp_ID=s.user_Id JOIN suppliers sup ON p.supplier_ID=sup.supplier_ID WHERE r.status = 1 AND r.is_deleted=0");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                    <td><?= ucwords($row['f_name'].' '.$row['l_name']) ?></td>
                    <td><?php echo $row['prod_name']; ?></td>
                    <td><?php echo $row['prod_size']; ?></td>
                    <td><?php echo $row['prod_color']; ?></td>
                    <td><?php echo $row['req_qty']; ?></td>
                    <td>&#8369; <?php echo number_format($row['prod_price'], 2); ?></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['delivery_date'])); ?></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['request_date'])); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

                  <div class="col-md-12 d-flex">
                    <p class="text-sm ml-auto">Printed by: <br> <span class="text-muted"><?php echo ucwords($fullname); ?></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  <script src="../includes/print.js"></script> 
  <?php require_once '../includes/footer.php'; ?>
  <script>
   $(window).on('load', function() {
    document.getElementById("printButton").click();
   })
 </script>