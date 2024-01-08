<title>Cebu & Co. | Request records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Request</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Request records</li>
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
              <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#create"><i class="fa-sharp fa-solid fa-square-plus"></i> New Request</button>
              <div class="card-tools mr-1 mt-3">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
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
                  $sql = mysqli_query($conn, "SELECT * FROM requisition r JOIN products p ON r.prod_ID=p.prod_ID JOIN users s ON r.emp_ID=s.user_Id JOIN suppliers sup ON p.supplier_ID=sup.supplier_ID WHERE r.emp_ID=$id AND r.status = 0 ORDER BY r.request_date");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
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
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#restock<?= $row['req_ID'] ?>" <?php if($row['status'] == 0) { echo 'disabled'; } ?>><i class="fas fa-clipboard-list"></i> Restock</button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update-user<?= $row['req_ID'] ?>" <?php if($row['status'] == 1) { echo 'disabled'; } ?>><i class="fas fa-pencil-alt"></i> Edit </button>
                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-user<?= $row['req_ID'] ?>" <?php if($row['status'] == 1) { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>

                  <!-- UPDATE MODAL -->
                  <div class="modal fade" id="update-user<?= $row['req_ID'] ?>">
                      <form role="form" method="POST" action="process_update.php">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                  <input type="hidden" class="form-control" name="req_ID" value="<?= $row['req_ID'] ?>">
                                  <input type="hidden" class="form-control" value="<?= $id ?>" name="emp_ID" required>
                                  <div class="modal-header">
                                      <h4 class="modal-title">Update request</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Product name</label>
                                      <select name="prod_ID" id="" class="form-control" required>
                                        <option value="" selected disabled>Select product</option>
                                        <?php 
                                          $editedProductID = $row['prod_ID'];
                                          $logged_in_user = $id;
                                          $new_sql = mysqli_query($conn, "
                                                SELECT * 
                                                FROM products 
                                                WHERE prod_qty != 0 AND prod_ID NOT IN (
                                                    SELECT prod_ID 
                                                    FROM requisition 
                                                    WHERE emp_ID = $logged_in_user
                                                ) 
                                                UNION 
                                                SELECT * 
                                                FROM products 
                                                WHERE prod_ID = $editedProductID
                                                ORDER BY prod_name ASC
                                            ");
                                          if(mysqli_num_rows($new_sql) > 0) {
                                            while ($row2 = mysqli_fetch_array($new_sql)) {
                                             echo '<option value="' . $row2['prod_ID'] . '" ' . ($row['prod_ID'] == $row2['prod_ID'] ? 'selected' : '') . '>' . $row2['prod_name'] . '</option>';
                                            }
                                          } else {
                                            echo '<option value="" selected disabled>No record found</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Quantity</label>
                                      <input type="number" class="form-control" placeholder="Enter number of products to request" name="req_qty" value="<?= $row['req_qty'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Special requirements</label>
                                        <textarea class="form-control" placeholder="Enter Special requirements" name="requirements" id="" cols="30" rows="1" required><?= $row['requirements'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Reason for requisition</label>
                                        <textarea class="form-control" placeholder="Enter Reason for requisition" name="reason" id="" cols="30" rows="1" required><?= $row['reason'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Additional notes</label>
                                        <textarea class="form-control" placeholder="Enter Additional notes" name="notes" id="" cols="30" rows="1"><?= $row['notes'] ?></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                      <button type="submit" class="btn btn-primary" name="update_request"><i class="fas fa-edit"></i> Submit</button>
                                  </div>
                              </div>
                            </div>
                      </form>
                  </div>



                  <!-- RESTOCK MODAL -->
                  <div class="modal fade" id="restock<?= $row['req_ID'] ?>">
                      <form role="form" method="POST" action="process_save.php">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                  <input type="hidden" class="form-control" name="emp_ID" value="<?= $id ?>">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Restock product</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Product name</label>
                                      <select name="prod_ID" id="" class="form-control" required>
                                        <option value="" selected disabled>Select product</option>
                                        <?php 
                                          $new_sql = mysqli_query($conn, "SELECT * FROM products WHERE prod_ID = ".$row['prod_ID']." AND prod_qty != 0 ORDER BY prod_name ASC ");
                                          if(mysqli_num_rows($new_sql) > 0) {
                                            while ($row2 = mysqli_fetch_array($new_sql)) {
                                             echo '<option value="' . $row2['prod_ID'] . '" ' . ($row['prod_ID'] == $row2['prod_ID'] ? 'selected' : '') . '>' . $row2['prod_name'] . '</option>';
                                            }
                                          } else {
                                            echo '<option value="" selected disabled>No record found</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Quantity</label>
                                      <input type="number" class="form-control" placeholder="Enter number of products to request" name="req_qty" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Special requirements</label>
                                        <textarea class="form-control" placeholder="Enter Special requirements" name="requirements" id="" cols="30" rows="1" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Reason for requisition</label>
                                        <textarea class="form-control" placeholder="Enter Reason for requisition" name="reason" id="" cols="30" rows="1" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Additional notes</label>
                                        <textarea class="form-control" placeholder="Enter Additional notes" name="notes" id="" cols="30" rows="1"></textarea>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                      <button type="submit" class="btn btn-primary" name="restock_request"><i class="fas fa-edit"></i> Submit</button>
                                  </div>
                              </div>
                            </div>
                      </form>
                  </div>



                  <!-- DELETE MODAL -->
                  <div class="modal fade" id="delete-user<?= $row['req_ID'] ?>">
                      <form role="form" method="POST" action="process_delete.php">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <input type="hidden" class="form-control" name="req_ID" value="<?= $row['req_ID'] ?>">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Delete request</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                     <h5>Are you sure you want to delete this record?</h5>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                      <button type="submit" class="btn btn-danger" name="delete_request"><i class="fas fa-trash-alt"></i> Delete</button>
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

        <!-- ADD MODAL -->
        <div class="modal fade" id="create">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="POST" action="process_save.php">
                      <input type="hidden" class="form-control" value="<?= $id ?>" name="emp_ID" required>
                        <div class="modal-header">
                            <h4 class="modal-title"><b>Create request</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Product name</label>
                            <select name="prod_ID" id="" class="form-control" required>
                              <option value="" selected disabled>Select product</option>
                              <?php 
                                $logged_in_user = $id;
                                $new_sql = mysqli_query($conn, "SELECT * 
                                FROM products 
                                WHERE prod_qty != 0 AND prod_ID NOT IN (SELECT prod_ID FROM requisition WHERE emp_ID = $logged_in_user) 
                                ORDER BY prod_name ASC");
                                if(mysqli_num_rows($new_sql) > 0) {
                                  while ($row2 = mysqli_fetch_array($new_sql)) {
                                    echo '<option value="'.$row2['prod_ID'].'">'.$row2['prod_name'].'</option>';
                                  }
                                } else {
                                  echo '<option value="" selected disabled>No record found</option>';
                                }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" placeholder="Enter number of products to request" name="req_qty" required>
                          </div>
                          <div class="form-group">
                              <label>Special requirements</label>
                              <textarea class="form-control" placeholder="Enter Special requirements" name="requirements" id="" cols="30" rows="1" required></textarea>
                          </div>
                          <div class="form-group">
                              <label>Reason for requisition</label>
                              <textarea class="form-control" placeholder="Enter Reason for requisition" name="reason" id="" cols="30" rows="1" required></textarea>
                          </div>
                          <div class="form-group">
                              <label>Additional notes</label>
                              <textarea class="form-control" placeholder="Enter Additional notes" name="notes" id="" cols="30" rows="1"></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary" name="create_request"><i class="fas fa-check"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>