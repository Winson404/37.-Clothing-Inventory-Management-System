<title>Cebu & Co. | Product records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Product records</li>
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
              <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#create"><i class="fa-sharp fa-solid fa-square-plus"></i> New Product</button>
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
                    <th>SUPPLIER NAME</th>
                    <th>PRODUCT NAME</th>
                    <th>SIZE</th>
                    <th>COLOR</th>
                    <th>STOCK LEFT/MAIN STOCK</th>
                    <th>PRICE</th>
                    <th>DATE ADDED</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM products p JOIN suppliers s ON p.supplier_ID=s.supplier_ID");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?= ucwords($row['f_name'].' '.$row['l_name']) ?></td>
                    <td><?php echo ucwords($row['prod_name']); ?></td>
                    <td><?php echo $row['prod_size']; ?></td>
                    <td><?php echo ucwords($row['prod_color']); ?></td>
                    <td><?php echo $row['prod_qty'].'/'.$row['prod_qty_orig']; ?></td>
                    <td>&#8369; <?php echo number_format($row['prod_price'], 2); ?></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></td>
                    <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update-user<?= $row['prod_ID'] ?>"><i class="fas fa-pencil-alt"></i> Edit </button>
                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-user<?= $row['prod_ID'] ?>"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>

                  <!-- UPDATE MODAL -->
                  <div class="modal fade" id="update-user<?= $row['prod_ID'] ?>">
                      <form role="form" method="POST" action="process_update.php">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                  <input type="hidden" class="form-control" name="prod_ID" value="<?= $row['prod_ID'] ?>">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Update Product</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label>Product name</label>
                                          <input type="text" class="form-control" placeholder="Enter Product name" name="prod_name" value="<?= $row['prod_name'] ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label>Supplier name</label>
                                        <select name="supplier_ID" id="" class="form-control" required>
                                          <option value="" selected disabled>Select supplier</option>
                                          <?php 
                                            $new_sql = mysqli_query($conn, "SELECT * FROM suppliers ORDER BY f_name ");
                                            if(mysqli_num_rows($new_sql) > 0) {
                                              while ($row2 = mysqli_fetch_array($new_sql)) {
                                               echo '<option value="' . $row2['supplier_ID'] . '" '.($row2['supplier_ID'] == $row['supplier_ID'] ? 'selected' : '').' >'.$row2['f_name'].' '.$row2['m_name'].' '.$row2['l_name'].'</option>';
                                              }
                                            } else {
                                              echo '<option value="" selected disabled>No record found</option>';
                                            }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                              <label>Product size</label>
                                              <input type="text" class="form-control" placeholder="Enter Product size" name="prod_size" value="<?= $row['prod_size'] ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                              <label>Product color</label>
                                              <input type="text" class="form-control" placeholder="Enter Product color" name="prod_color" value="<?= $row['prod_color'] ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                              <label>Product stock</label>
                                              <input type="number" class="form-control" placeholder="Enter Product Stock" name="prod_qty" value="<?= $row['prod_qty'] ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                              <label>Original product stock</label>
                                              <input type="number" class="form-control" placeholder="Enter Original Product Stock" name="prod_qty_orig" value="<?= $row['prod_qty_orig'] ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                              <label>Product price</label>
                                              <input type="number" class="form-control" placeholder="Enter Product Price" name="prod_price" value="<?= $row['prod_price'] ?>" required>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label>Description</label>
                                          <textarea class="form-control" placeholder="Enter Description" name="prod_desc" id="" cols="30" rows="3"><?= $row['prod_desc'] ?></textarea>
                                      </div>
                                  </div>
                                </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                      <button type="submit" class="btn btn-primary" name="update_product"><i class="fas fa-edit"></i> Submit</button>
                                  </div>
                            </div>
                        </div>
                      </form>
                  </div>



                  <!-- DELETE MODAL -->
                  <div class="modal fade" id="delete-user<?= $row['prod_ID'] ?>">
                      <form role="form" method="POST" action="process_delete.php">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <input type="hidden" class="form-control" name="prod_ID" value="<?= $row['prod_ID'] ?>">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Delete Product</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                     <h5>Are you sure you want to delete this record?</h5>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                      <button type="submit" class="btn btn-danger" name="delete_product"><i class="fas fa-trash-alt"></i> Delete</button>
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
                            <h4 class="modal-title"><b>Create Product</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Product name</label>
                            <input type="text" class="form-control" placeholder="Enter Product name" name="prod_name" required>
                          </div>
                          <div class="form-group">
                            <label>Supplier name</label>
                            <select name="supplier_ID" id="" class="form-control" required>
                              <option value="" selected disabled>Select supplier</option>
                              <?php 
                                $new_sql = mysqli_query($conn, "SELECT * FROM suppliers ORDER BY f_name ");
                                if(mysqli_num_rows($new_sql) > 0) {
                                  while ($row2 = mysqli_fetch_array($new_sql)) {
                                   echo '<option value="' . $row2['supplier_ID'] . '" >'.$row2['f_name'].' '.$row2['m_name'].' '.$row2['l_name'].'</option>';
                                  }
                                } else {
                                  echo '<option value="" selected disabled>No record found</option>';
                                }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                  <label>Product size</label>
                                  <input type="text" class="form-control" placeholder="Enter Product size" name="prod_size" required>
                                </div>
                              </div>
                              <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                  <label>Product color</label>
                                  <input type="text" class="form-control" placeholder="Enter Product color" name="prod_color" required>
                                </div>
                              </div>
                              <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                  <label>Product stock</label>
                                  <input type="number" class="form-control" placeholder="Enter Product Stock" name="prod_qty" required>
                                </div>
                              </div>
                              <div class="col-ld-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                  <label>Product price</label>
                                  <input type="number" class="form-control" placeholder="Enter Product Price" name="prod_price" required>
                                </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" placeholder="Enter Description" name="prod_desc" id="" cols="30" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary" name="create_product"><i class="fas fa-check"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>