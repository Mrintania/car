<?php //Page name 
?>
<?php $page = 'Cars';  ?>
<?php //include the header section 
?>
<?php include_once 'includes/header.php'; ?>

<body id="page-top">
  <?php
  //if delete button has been click
  if (isset($_POST['delete'])) {
    // decode the id 
    $id = base64_decode($_POST['id']);
    //select the cars by id to delete the image of the car
    $statement = $conn->prepare("SELECT * FROM cars WHERE id = ?");
    $statement->execute(array($id));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //delete the image of the car
    unlink('uploads/cars/' . $result['car_image']);

    //delete the selected car
    $stmt_delete = $conn->prepare('DELETE FROM cars WHERE id = ?');
    //execute the delete query
    $delete = $stmt_delete->execute(array($id));

    //if deleted
    if ($delete) {
      //create a session of the success message
      $_SESSION['success'] = "Car has been deleted";
      //redirect to the cars page
      header('location: cars.php');
      exit();
    }
  }
  ?>
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php //include the navigation bar section 
    ?>
    <?php include_once 'includes/nav.php'; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php //include the top bar section 
        ?>
        <?php include_once 'includes/topbar.php'; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php //if success message is set 
          ?>
          <?php if (isset($_SESSION['success'])) : ?>
            <div class="col-lg-12">
              <div class="alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Success</span>
                <?php //display the success message 
                ?>
                <?php echo $_SESSION['success']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            </div>
            <?php //unset the success message 
            ?>
            <?php unset($_SESSION['success']); ?>
          <?php endif; ?>
          <!-- DataTables Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Cars List</h6>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Car Name</th>
                      <th>Model</th>
                      <th>Manufacturer</th>
                      <th>License Plate No.</th>
                      <th>VIN No.</th>
                      <th>Insurance Company</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //for numbering
                    $i = 1;
                    //select all cars query
                    $stmt = $conn->prepare("SELECT * FROM cars ORDER BY id DESC");
                    //execute the query
                    $stmt->execute();
                    //fetch the cars data as associative array
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    //loop through the array            
                    foreach ($result as $row) : ?>
                      <tr>
                        <td><?php echo $i;
                            $i++; ?></td>
                        <td><?php echo $row['car_name']; ?></td>
                        <td><?php echo $row['car_model']; ?></td>
                        <td><?php echo $row['car_manufacturer']; ?></td>
                        <td><?php echo $row['license_plate_number']; ?></td>
                        <td><?php echo $row['vin_number']; ?></td>
                        <td><?php echo $row['insurance_company_name']; ?></td>



                        <td class="text-center">
                          <!-- View Car -->
                          <a href="view-car.php?v=<?php echo base64_encode($row['id']); ?>" class="btn btn-primary btn-circle btn-sm">
                            <i class="fas fa-eye"></i>
                          </a>
                          <!-- Edit Car -->
                          <a href="edit-car.php?e=<?php echo base64_encode($row['id']); ?>" class="btn btn-success btn-circle btn-sm">
                            <i class="fas fa-edit"></i>
                          </a>
                          <!-- Delete Car -->
                          <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteModal_<?php echo $row['id']; ?>">
                            <i class="fas fa-trash"></i>
                          </a>
                          <!-- Delete Modal-->
                          <div class="modal fade" id="deleteModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel_<?php echo $row['id']; ?>">Are you sure to Delete</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">Select "Delete" below if you are ready to delete the current Car.</div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                  <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo base64_encode($row['id']); ?>">
                                    <button class="btn btn-danger" type="submit" name="delete">Delete</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Download to pdf
                          <a href="./export-car.php" class="btn btn-info btn-circle btn-sm">
                          <i class="fas fa-download"></i> -->
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <?php //include the footer section 
      ?>
      <?php include_once 'includes/footer.php'; ?>