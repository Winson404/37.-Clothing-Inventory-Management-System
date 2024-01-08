<title>Cebu & Co. | Purchased orders records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Purchased orders</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Purchased orders records</li>
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
              <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#create"><i class="fa-sharp fa-solid fa-square-plus"></i> New order</button>
              <a class="btn btn-secondary float-sm-right btn-sm mr-3" href="purchased_print.php"><i class="fa-solid fa-print"></i> Print</a>
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
                    <th>DELIVERY DATE</th>
                    <th>REQUEST DATE</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM requisition r JOIN products p ON r.prod_ID=p.prod_ID JOIN users s ON r.emp_ID=s.user_Id JOIN suppliers sup ON p.supplier_ID=sup.supplier_ID WHERE r.status = 1 AND r.is_deleted=0");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                    <td><?php echo $row['prod_name']; ?></td>
                    <td><?php echo $row['prod_size']; ?></td>
                    <td><?php echo $row['prod_color']; ?></td>
                    <td><?php echo $row['req_qty']; ?></td>
                    <td>&#8369; <?php echo number_format($row['prod_price'], 2); ?></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['delivery_date'])); ?></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['request_date'])); ?></td>
                    <td>
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view<?= $row['req_ID'] ?>"><i class="fas fa-eye"></i> View</button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update-user<?= $row['req_ID'] ?>"><i class="fas fa-pencil-alt"></i> Edit </button>
                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-user<?= $row['req_ID'] ?>"><i class="fas fa-trash"></i> Delete</button>
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
                            <div>
                              <strong>Delivery Date:</strong> <?= $row['delivery_date'] ?>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                          </div>
                        </div>
                      </div>
                  </div>

                  <!-- UPDATE MODAL -->
                  <div class="modal fade" id="update-user<?= $row['req_ID'] ?>">
                      <form role="form" method="POST" action="process_update.php">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                  <input type="hidden" class="form-control" name="req_ID" value="<?= $row['req_ID'] ?>">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Update request</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Employee name</label>
                                      <select name="emp_ID" id="" class="form-control" required>
                                        <option value="" selected disabled>Select employee</option>
                                        <?php 
                                          $new_query = mysqli_query($conn, "SELECT * FROM users WHERE user_type='Employee'");
                                          if(mysqli_num_rows($new_query) > 0) {
                                            while ($emp = mysqli_fetch_array($new_query)) {
                                              echo '<option value="'.$emp['user_Id'].'" ' . ($emp['user_Id'] == $row['user_Id'] ? 'selected' : '') . '>'.$emp['firstname'].' '.$emp['middlename'].' '.$emp['lastname'].' '.$emp['suffix'].'</option>';
                                            }
                                          } else {
                                            echo '<option value="" selected disabled>No record found</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
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


                  <!-- DELETE MODAL -->
                  <div class="modal fade" id="delete-user<?= $row['req_ID'] ?>">
                      <form role="form" method="POST" action="process_update.php">
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
                        <div class="modal-header">
                            <h4 class="modal-title"><b>Create order</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Employee name</label>
                            <select name="emp_ID" id="" class="form-control" required>
                              <option value="" selected disabled>Select employee</option>
                              <?php 
                                $new_sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type='Employee'");
                                if(mysqli_num_rows($new_sql) > 0) {
                                  while ($row = mysqli_fetch_array($new_sql)) {
                                    echo '<option value="'.$row['user_Id'].'">'.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].'</option>';
                                  }
                                } else {
                                  echo '<option value="" selected disabled>No record found</option>';
                                }
                              ?>
                            </select>
                          </div>
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