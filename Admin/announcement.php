<title>Cebu & Co. | Announcement records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Announcement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Announcement records</li>
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
                <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New Announcement</button>
                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="example11" class="table table-bordered table-hover text-sm">
                  <thead>
                      <th>DATE</th>
                      <th>ANNOUNCEMENT TITLE</th>
                      <th>DATE ADDED</th>
                      <th>ACTIONS</th>
                  </thead>
                  <tbody id="users_data">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM announcement WHERE actDate >= '$date_today' ORDER BY actDate");
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td class="<?php if($row['actDate'] == $date_today) { echo 'bg-white text-bold'; } else { echo 'bg-grey text-muted'; } ?>"><?php echo date("F d, Y", strtotime($row['actDate'])); ?></td>

                      <td class="<?php if($row['actDate'] == $date_today) { echo 'bg-white text-justify text-bold'; } else { echo 'bg-grey text-muted text-justify'; } ?>"><?php echo $row['actName']; ?></td>

                      <td class="<?php if($row['actDate'] == $date_today) { echo 'bg-white text-bold'; } else { echo 'bg-grey text-muted'; } ?>"><?php echo date("F d, Y h:i A", strtotime($row['date_added'])); ?></td>
                      
                      <td class="<?php if($row['actDate'] == $date_today) { echo 'bg-white'; } else { echo 'bg-grey text-muted'; } ?>">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['actId']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['actId']; ?>"><i class="fas fa-trash"></i> Delete</button>
                      </td>
                    
                    </tr>
                    <?php include 'announcement_update_delete.php'; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php require_once 'announcement_add.php'; require_once '../includes/footer.php'; ?>