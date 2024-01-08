<title>Cebu & Co. | Supplier records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Supplier</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Supplier records</li>
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
              <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#create"><i class="fa-sharp fa-solid fa-square-plus"></i> New Supplier</button>
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
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    <th>CONTACT</th>
                    <th>DATE ADDED</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM suppliers ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $row['f_name'].' '.$row['m_name'].' '.$row['l_name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo '+63 '.$row['contact']; ?></span></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['date_added'])); ?></td>
                    <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update-user<?= $row['supplier_ID'] ?>"><i class="fas fa-pencil-alt"></i> Edit </button>
                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-user<?= $row['supplier_ID'] ?>"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>

                  <!-- UPDATE MODAL -->
                  <div class="modal fade" id="update-user<?= $row['supplier_ID'] ?>">
                      <form role="form" method="POST" action="process_update.php">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                  <input type="hidden" class="form-control" placeholder="Enter Username" name="supplier_ID" value="<?= $row['supplier_ID'] ?>">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Update Supplier</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label>First name</label>
                                          <input type="text" class="form-control" placeholder="Enter First name" name="f_name" required value="<?= $row['f_name'] ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Middle name</label>
                                          <input type="text" class="form-control" placeholder="Enter Middle name" name="m_name" required value="<?= $row['m_name'] ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Last name</label>
                                          <input type="text" class="form-control" placeholder="Enter Last name" name="l_name" required value="<?= $row['l_name'] ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Address</label>
                                          <input type="text" class="form-control" placeholder="Enter Address" name="address" required value="<?= $row['address'] ?>">
                                      </div>
                                      <div class="form-group">
                                          <label>Contact</label>
                                          <input type="text" class="form-control" placeholder="Enter Contact number" name="contact" required value="<?= $row['contact'] ?>">
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                      <button type="submit" class="btn btn-primary" name="update_supplier"><i class="fas fa-edit"></i> Submit</button>
                                  </div>
                            </div>
                        </div>
                      </form>
                  </div>



                  <!-- DELETE MODAL -->
                  <div class="modal fade" id="delete-user<?= $row['supplier_ID'] ?>">
                      <form role="form" method="POST" action="process_delete.php">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <input type="hidden" class="form-control" placeholder="Enter Username" name="supplier_ID" value="<?= $row['supplier_ID'] ?>">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Delete Supplier</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                     <h5>Are you sure you want to delete this record?</h5>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                      <button type="submit" class="btn btn-danger" name="delete_supplier"><i class="fas fa-trash-alt"></i> Delete</button>
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
                            <h4 class="modal-title"><b>Create Supplier</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control" placeholder="Enter First name" name="f_name" required>
                            </div>
                            <div class="form-group">
                                <label>Middle name</label>
                                <input type="text" class="form-control" placeholder="Enter Middle name" name="m_name" required>
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control" placeholder="Enter Last name" name="l_name" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Enter Address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" placeholder="Enter Contact number" name="contact" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary" name="create_supplier"><i class="fas fa-check"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>