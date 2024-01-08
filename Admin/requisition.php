<title>Cebu & Co. | Pending request records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pending request</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Pending request records</li>
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
            <div class="card-header p-2">
              <!-- <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#create"><i class="fa-sharp fa-solid fa-square-plus"></i> New Request</button> -->
              <div class="card-tools mr-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>REQUESTOR NAME</th>
                    <th>PRODUCT NAME</th>
                    <th>SIZE</th>
                    <th>COLOR</th>
                    <th>REQUESTED QTY</th>
                    <th>PRICE</th>
                    <th>STATUS</th>
                    <th>REQUEST DATE</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM requisition r JOIN products p ON r.prod_ID=p.prod_ID JOIN users s ON r.emp_ID=s.user_Id JOIN suppliers sup ON p.supplier_ID=sup.supplier_ID WHERE r.status != 1");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                    <td><?php echo $row['prod_name']; ?></td>
                    <td><?php echo $row['prod_size']; ?></td>
                    <td><?php echo $row['prod_color']; ?></td>
                    <td><?php echo $row['req_qty']; ?></td>
                    <td>&#8369; <?php echo number_format($row['prod_price'], 2); ?></td>
                    <td>
                      <?php if($row['status'] == 0): ?>
                      <span class="badge badge-warning p-1">Pending</span>
                      <?php elseif($row['status'] == 1): ?>
                      <span class="badge badge-info p-1">Approved</span>
                      <?php else: ?>
                      <span class="badge badge-danger p-1">Rejected</span>
                      <?php endif; ?>
                    </td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['request_date'])); ?></td>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view<?= $row['req_ID'] ?>"><i class="fas fa-eye"></i> View</button>
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#approve<?= $row['req_ID'] ?>" <?php if($row['status'] == 1) { echo 'disabled'; } ?>><i class="fas fa-check"></i> Approve</button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject<?= $row['req_ID'] ?>" <?php if($row['status'] == 2) { echo 'disabled'; } ?>><i class="fas fa-times"></i> Reject</button>
                    </td>
                  </tr>

                  <!-- VIEW -->
                  <div class="modal fade" id="view<?= $row['req_ID'] ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <input type="hidden" class="form-control" name="req_ID" value="<?= $row['req_ID'] ?>">
                          <input type="hidden" class="form-control" name="status" value="1">
                          <div class="modal-header">
                            <h4 class="modal-title">Requisition info</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div>
                              <strong>Requestor Name:</strong> <?= $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'] ?>
                            </div>
                            <div>
                              <strong>Supplier Name:</strong> <?= $row['f_name'].' '.$row['m_name'].' '.$row['l_name'] ?>
                            </div>
                            <div>
                              <strong>Product Name:</strong> <?= $row['prod_name'] ?>
                            </div>
                            <div>
                              <strong>Size:</strong> <?= $row['prod_size'] ?>
                            </div>
                            <div>
                              <strong>Color:</strong> <?= $row['prod_color'] ?>
                            </div>
                            <div>
                              <strong>Requested Quantity:</strong> <?= $row['req_qty'] ?>
                            </div>
                            <div>
                              <strong>Price:</strong> <?= $row['prod_price'] ?>
                            </div>
                            <div>
                              <strong>Additional requirements:</strong> <?= $row['requirements'] ?>
                            </div>
                            <div>
                              <strong>Requisition reason:</strong> <?= $row['reason'] ?>
                            </div>
                            <div>
                              <strong>Additional notes:</strong> <?= $row['notes'] ?>
                            </div>
                            <div>
                              <strong>Request Date:</strong> <?= $row['request_date'] ?>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                          </div>
                        </div>
                      </div>
                  </div>


                  <!-- APPROVE -->
                  <div class="modal fade" id="approve<?= $row['req_ID'] ?>">
                    <form role="form" method="POST" action="process_update.php">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <input type="hidden" class="form-control" name="req_ID" value="<?= $row['req_ID'] ?>">
                          <input type="hidden" class="form-control" name="status" value="1">
                          <div class="modal-header">
                            <h4 class="modal-title">Approve request</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Delivery date</label>
                              <input type="date" class="form-control" name="delivery_date" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary" name="update_status"><i class="fas fa-check"></i> Approve</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- REJECT -->
                  <div class="modal fade" id="reject<?= $row['req_ID'] ?>">
                    <form role="form" method="POST" action="process_update.php">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <input type="hidden" class="form-control" name="req_ID" value="<?= $row['req_ID'] ?>">
                          <input type="hidden" class="form-control" name="status" value="2">
                          <div class="modal-header">
                            <h4 class="modal-title">Reject request</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h5>Are you sure you want to reject this requisition?</h5>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-danger" name="update_status"><i class="fas fa-trash-alt"></i> Reject</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>